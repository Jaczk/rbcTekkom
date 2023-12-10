<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\SpecDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['specialization', 'specDetail'])->get();

        $specDrop = Specialization::all();
        $specDetailDrop = SpecDetail::all();

        return view('admin.books.index', [
            'books' => $books,
            'specDrops' => $specDrop,
            'specDetailDrops' => $specDetailDrop,
        ]);
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
            'lib_book_code' => 'required|min:8|max:8|string|unique:books,lib_book_code',
            'spec_id' => 'required',
            'spec_detail_id' => 'required',
            'stock' => 'required|numeric',
            'desc' => 'nullable',
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
            $compressedImage->save(public_path('store/images/' . $ogImageName));

            $data['image'] = $ogImageName;
        }

        // Generate and store QR code
        $data['qr_code'] = $this->generateQRCode($data['lib_book_code']);

        // Create book record
        $book = new Book($data);
        $book->qr_code = $data['qr_code'];
        $book->save();

        return redirect()->route('admin.book')->with('success', 'Buku berhasil ditambahkan');
    }

    public function generateQRCode($libBookCode)
    {
        // Generate a random string with 6 characters
        $randomString = Str::random(6);

        $qrCodeData = $libBookCode;
        $filename = $randomString . $libBookCode . '.png';
        $filePath = public_path('store/qr-images/' . $filename);

        QrCode::size(500)->format('png')->generate($qrCodeData, $filePath);

        return $filename;
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

    public function show($id)
    {
        $book = Book::with(['specialization', 'specDetail'])->find($id);
        return response()->json($book);
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
            'lib_book_code' => 'required|min:8|max:8|string|unique:books,lib_book_code,' . $id,
            'spec_id' => 'required',
            'desc' => 'nullable',
            'spec_detail_id' => 'required',
            'stock' => 'required|numeric',
            'is_recommended' => 'nullable',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);

        $book = Book::find($id);

        if (!$book) {
            return back()->with('error', 'Buku tidak ditemukan');
        }

        // Check if lib_book_code is being updated
        if ($request->has('lib_book_code') && $request->lib_book_code !== $book->lib_book_code) {
            // Delete the old QR code
            if ($book->qr_code) {
                $oldQrCodePath = public_path('store/qr-images/' . $book->qr_code);
                if (file_exists($oldQrCodePath)) {
                    unlink($oldQrCodePath);
                }
            }

            // Generate and store new QR code
            $randomString = Str::random(6);
            $qrCodeData = $request->lib_book_code;
            $filename = $randomString . $request->lib_book_code . '.png';
            $filePath = public_path('store/qr-images/' . $filename);

            QrCode::size(300)->format('png')->generate($qrCodeData, $filePath);

            $data['qr_code'] = $filename;
        } elseif (!$book->qr_code) {
            // Generate and store QR code for the lib_book_code if it doesn't have one
            $randomString = Str::random(6);
            $qrCodeData = $book->lib_book_code;
            $filename = $randomString . $book->lib_book_code . '.png';
            $filePath = public_path('store/qr-images/' . $filename);

            QrCode::size(300)->format('png')->generate($qrCodeData, $filePath);

            $data['qr_code'] = $filename;
        }

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
            $compressedImage->save(public_path('store/images/' . $ogImageName));

            $data['image'] = $ogImageName;

            // Delete the old image
            File::delete(public_path('store/images/' . $book->image));
        }
        $data['is_recommended'] = $request->has('is_recommended') ? 1 : 0;

        $limitRecc = Book::where('is_recommended', 1)->count();

        if ($limitRecc > 5) { //check if the book is recommended only 5
            return back()->with('error', 'Buku Rekomendasi Maksimal 5')->withInput();
        } else {
            $book->update($data);

            $updatedLimitRecc = Book::where('is_recommended', 1)->count();

            if ($updatedLimitRecc > 5) {
                $data['is_recommended'] = 0; // Set the book as not recommended
                $book->update($data);
                return back()->with('error', 'Buku Rekomendasi Maksimal 5')->withInput();
            } else {
                return redirect()->route('admin.book')->with('success', 'Sukses Memperbarui Data Buku');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        // Check if any associated Loan records have is_returned = 0
        $hasActiveLoans = $book->loan()->where('is_returned', 0)->exists();

        if ($hasActiveLoans) {
            return redirect()->route('admin.book')
                ->with('error', 'Gagal menghapus item barang. Item barang masih dipinjam.');
        }

        // Delete the image
        $imagePath = public_path('images/' . $book->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the QR code
        $qrCodePath = public_path('qr-images/' . $book->qr_code);
        if (file_exists($qrCodePath)) {
            unlink($qrCodePath);
        }

        $book->forceDelete();

        return redirect()->route('admin.book')->with('success', 'Data berhasil dihapus');
    }
}
