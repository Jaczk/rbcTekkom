<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Thesis;
use App\Models\Capstone;
use App\Models\Lecturer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::findOrFail(Auth::user()->id);
        $theses = Thesis::with(['lec1', 'lec2'])->where('user_id', $user->id)->get();
        $capstone = Capstone::with(['lec1', 'lec2'])->where('user_id', $user->id)->get();

        return view('mahasiswa.profile.index', compact('user', 'theses', 'capstone'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail(Auth::user()->id);

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
            $compressedImage->save(public_path('store/profile/' . $ogImageName));

            // Delete the old image
            if ($user->profile_image) {
                File::delete(public_path('store/profile/' . $user->profile_image));
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
            $kcompressedImage->save(public_path('store/ktm/' . $kogImageName));

            // Delete the old image
            if ($user->ktm_image) {
                File::delete(public_path('store/ktm/' . $user->ktm_image));
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

        return redirect()->route('user.profile')->with('success', 'Sukses Memperbarui Profil');
    }
}
