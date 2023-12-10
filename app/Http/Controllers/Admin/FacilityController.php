<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function gallery()
    {
        $gallery = Facility::all();
        return view('admin.facility.gallery', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function editGallery(string $id)
    {
        $decryptId = Crypt::decryptString($id);
        $gallery =  Facility::find($decryptId);

        return view('admin.facility.edit-gallery', compact('gallery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateGallery(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png',
            'caption' => 'required|string'
        ]);

        $gallery = Facility::findOrFail($id);

        // Check if the gallery has an existing image
        if ($gallery->image) {
            // Delete the old image
            File::delete(public_path('store/facility/' . $gallery->image));
        }

        if ($request->hasFile('image')) {
            // Upload and store the new image
            $image = $request->file('image');
            $filename = Str::random(8) . $image->getClientOriginalName();

            // Move the file to public/store/c100
            $image->move(public_path('store/facility'), $filename);

            // Update the gallery with the new image and caption
            $gallery->update([
                'image' => $filename,
                'caption' => $request->caption,
            ]);
        } else {
            // Update the gallery with only the new caption
            $gallery->update([
                'caption' => $request->caption,
            ]);
        }

        return redirect()->route('admin.facility.gallery')->with('success', 'Foto berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function create()
    {
        return view('admin.facility.add-gallery');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'caption' => 'required|string'
        ]);

        $image = $request->file('image');
        $filename = Str::random(8) . $image->getClientOriginalName();
        // Store the image in the public/storage/facility directory
        $image->move(public_path('store/facility'), $filename);

        Facility::create([
            'image' => $filename,
            'caption' => $request->caption,
            // Add other fields you want to store here
        ]);

        return redirect()->route('admin.facility.gallery')->with('success', 'Sukses memperbarui peminatan');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
