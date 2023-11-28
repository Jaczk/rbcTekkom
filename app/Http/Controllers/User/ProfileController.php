<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Thesis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = User::find($id);

        $theses = Thesis::where('user_id', $user->id)->get();

        return view('mahasiswa.profile.index', compact('user', 'theses'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|email',
            'nim' => 'required|string',
            'phone' => 'required|max:15|regex:/^\+62\d{0,}$/',
            'profile_image' => 'image|mimes:jpg,jpeg,png',
            'ktm_image' => 'image|mimes:jpg,jpeg,png',
        ]);

        // Handle cropped image upload
        if ($request->has('profile_image')) {
            $image = $request->file('profile_image');
            $ogImageName = Str::random(8) . $image->getClientOriginalName();

            // Compress and convert to WebP
            $compressedImage = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75);

            // Save the compressed and converted image
            $compressedImage->save(storage_path('app/public/profile/' . $ogImageName));

            // Delete the old image
            if ($user->profile_image) {
                Storage::delete('public/profile/' . $user->profile_image);
            }

            // Update the user's profile with the new image name
            $user->profile_image = $ogImageName;
        }

        // Handle cropped image upload
        if ($request->has('ktm_image')) {
            $kimage = $request->file('ktm_image');
            $kogImageName = Str::random(8) . $kimage->getClientOriginalName();

            // Compress and convert to WebP
            $kcompressedImage = Image::make($kimage)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75);

            // Save the compressed and converted image
            $kcompressedImage->save(storage_path('app/public/ktm/' . $kogImageName));

            // Delete the old image
            if ($user->ktm_image) {
                Storage::delete('public/ktm/' . $user->ktm_image);
            }

            // Update the user's profile with the new image name
            $user->ktm_image = $kogImageName;
        }

        // Update other user fields
        $user->name = $request->input('name');
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->nim = $request->input('nim');
        $user->phone = $request->input('phone');

        // Save the changes to the user model
        $user->save();

        // Handle KTM image upload
        // (Add similar code for KTM image upload as needed)

        return redirect()->route('user.profile', ['id' => $user->id])->with('success', 'Sukses Memperbarui Profil');
    }

    public function openTheses($id)
    {
        $user = User::find($id);

        return view('mahasiswa.profile.theses', compact('user'));
    }

    public function createTheses(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'thesis_name' => 'required|string',
            'lecturer_1' => 'required|string',
            'lecturer_2' => 'required|string',
            'year' => 'required|numeric',
            'abstract' => 'required|string',
            'abs_keyword' => 'required|string',
            'file_1' => 'required|mimes:pdf',
            'file_2' => 'required|mimes:pdf',

        ]);

        // Handle file_1 upload
        $file1 = $request->file('file_1');
        $file1Name = Str::random(8) . $file1->getClientOriginalName();
        $file1->storeAs('public/pdf-1/', $file1Name);

        // Handle file_2 upload
        $file2 = $request->file('file_2');
        $file2Name = Str::random(8) . $file2->getClientOriginalName();
        $file2->storeAs('public/pdf-2/', $file2Name);

        // Create Thesis instance
        $thesis = new Thesis([
            'user_id' => $id,
            'thesis_name' => $request->input('thesis_name'),
            'author' => $request->input('hidden_author'), // You can directly use 'hidden_author'
            'lecturer_1' => $request->input('lecturer_1'),
            'lecturer_2' => $request->input('lecturer_2'),
            'year' => $request->input('year'),
            'abstract' => $request->input('abstract'),
            'abs_keyword' => $request->input('abs_keyword'),
            'file_1' => $file1Name,
            'file_2' => $file2Name,
        ]);

        // Save the Thesis instance
        $thesis->save();

        // Assuming you have a 'custom:storagelink' Artisan command for creating storage links
        Artisan::call('custom:storagelink');

        // Redirect to the user profile page
        return redirect()->route('user.profile', ['id' => $id])->with('success', 'Sukses Mengupload Tugas Akhir');
    }
}
