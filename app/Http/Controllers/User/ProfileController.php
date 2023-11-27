<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile($id)
    {

        $user = User::find($id);

        return view('mahasiswa.profile.index', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'nim' => 'required|string',
            'phone' => 'required|string',
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

        // Update other user fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nim = $request->input('nim');
        $user->phone = $request->input('phone');

        // Save the changes to the user model
        $user->save();

        // Handle KTM image upload
        // (Add similar code for KTM image upload as needed)

        return redirect()->route('user.profile', ['id' => $user->id])->with('success', 'Sukses Memperbarui Profil');
    }
}
