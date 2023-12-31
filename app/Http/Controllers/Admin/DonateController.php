<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DonateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donates = Donate::all();

        return view('admin.donate.index', ['donates' => $donates]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.donate.create');
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
            'price' => 'required|integer',
            'desc' => 'nullable',
            'is_fav' => 'nullable',
            'image' => 'image|mimes:jpg,jpeg,png|nullable',
        ]);

        // Set is_fav to 1 if the checkbox is checked, otherwise set it to 0
        $data['is_fav'] = $request->has('is_fav') ? 1 : 0;

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
        Donate::create($data);
        Artisan::call('custom:storagelink');

        return redirect()->route('admin.donate')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $donate = Donate::find($id);
        return response()->json($donate);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $donate = Donate::find($decryptId);
        return view('admin.donate.edit', [
            'donate' => $donate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'book_name' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'price' => 'required|integer',
            'desc' => 'nullable',
            'is_fav' => 'nullable',
            'image' => 'image|mimes:jpg,jpeg,png|nullable',
        ]);

        $donate = Donate::find($id);

        // // Set is_fav to 1 if the checkbox is checked, otherwise set it to 0
        // $data['is_fav'] = $request->has('is_fav') ? 1 : 0;

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
            Storage::delete('public/images/' . $donate->image);
        }


        $data['is_fav'] = $request->has('is_fav') ? 1 : 0;

        $limitRecc = Donate::where('is_fav', 1)->count();

        if ($limitRecc > 5) { //check if the donate is fav only 5
            return back()->with('error', 'Buku Rekomendasi Maksimal 5')->withInput();
        } else {
            $donate->update($data);

            $updatedLimitRecc = Donate::where('is_fav', 1)->count();

            if ($updatedLimitRecc > 5) {
                $data['is_fav'] = 0; // Set the donate as not fav
                $donate->update($data);
                return back()->with('error', 'Buku Rekomendasi Maksimal 5')->withInput();
            } else {
                return redirect()->route('admin.donate')->with('success', 'Sukses Memperbarui Data Buku');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donate = Donate::find($id);

        $donate->forceDelete();

        return redirect()->route('admin.donate')->with('success', 'Data berhasil dihapus');
    }
}
