<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\SpecDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['specialization', 'specDetail'])->get();

        return view('admin.books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $special = Specialization::all();
        $specDetail = SpecDetail::all();

        return view('admin.books.create', ['specialization' => $special, 'specDetail' => $specDetail]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'book_name' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'isbn_issn' => 'required',
            'condition' => ['required', 'string', 'in:new,normal,broken'],
            'lib_book_code' => 'required|string|unique:books,lib_book_code',
            'year_entry' => 'required|numeric',
            'spec_id' => 'required',
            'spec_detail_id' => 'required',
            'is_available' => 'nullable',
            'desc'=>'nullable',
            'is_recommended' => 'nullable',
            'image' => 'image|mimes:jpg,jpeg,png|nullable',
            
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ogImageName = Str::random(8) . $image->getClientOriginalName();
        
            // Compress and convert to WebP
            $compressedImage = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75); // Convert to WebP format
        
            // Save the compressed and converted image
            $compressedImage->save(storage_path('app/public/images/' . $ogImageName));
        
            $data['image'] = $ogImageName;
        }
        Book::create($data);
        Artisan::call('custom:storagelink');

        return redirect()->route('admin.book')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $books = Book::find($decryptId);
        $special = Specialization::all();
        $specDetail = SpecDetail::all();

        return view('admin.books.edit', [
            'books' => $books,
            'specDetails' => $specDetail,
            'specialization' => $special
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'book_name' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'isbn_issn' => 'required',
            'condition' => ['required', 'string', 'in:new,normal,broken'],
            'year_entry' => 'required|numeric',
            'lib_book_code' => 'required|string|unique:books,lib_book_code'. $id,
            'spec_id' => 'required',
            'desc'=>'nullable',
            'spec_detail_id' => 'required',
            'is_available' => 'nullable',
            'is_recommended' => 'nullable',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);

        $book = Book::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ogImageName = Str::random(8) . $image->getClientOriginalName();
        
            // Compress and convert to WebP
            $compressedImage = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75); // Convert to WebP format
        
            // Save the compressed and converted image
            $compressedImage->save(storage_path('app/public/images/' . $ogImageName));
        
            $data['image'] = $ogImageName;
        
            // Delete the old image
            Storage::delete('public/images/' . $book->image);
        }
        

        $data['is_recommended'] = $request->has('is_recommended') ? 1 : 0;

        $book->update($data);

        return redirect()->route('admin.book')->with('success', 'Sukses Memperbarui Data Buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        $book->forceDelete();

        return redirect()->route('admin.donate')->with('success', 'Data berhasil dihapus');
    }
}
