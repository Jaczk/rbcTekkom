<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Thesis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ThesesController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('mahasiswa.profile.theses', compact('user'));
    }

    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $theses = Thesis::find($decryptId);

        return view('mahasiswa.profile.theses-edit', [
            'theses' => $theses,
        ]);
    }


    public function store(Request $request)
    {
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
            'user_id' => Auth::user()->id,
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
        return redirect()->route('user.profile')->with('success', 'Sukses Mengupload Tugas Akhir');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'thesis_name' => 'required|string',
            'lecturer_1' => 'required|string',
            'lecturer_2' => 'required|string',
            'year' => 'required|numeric',
            'abstract' => 'required|string',
            'abs_keyword' => 'required|string',
            'file_1' => 'nullable|mimes:pdf',
            'file_2' => 'nullable|mimes:pdf',

        ]);

        $theses = Thesis::find($id);

        if ($request->hasFile('file_1')) {
            // Handle file_1 upload
            $file1 = $request->file('file_1');
            $file1Name = Str::random(8) . $file1->getClientOriginalName();
            $file1->storeAs('public/pdf-1/', $file1Name);

            $data['file_1'] =  $file1Name;

            Storage::delete('public/pdf-1/' . $theses->file_1);
        }

        if ($request->hasFile('file_2')) {
            // Handle file_2 upload
            $file2 = $request->file('file_2');
            $file2Name = Str::random(8) . $file2->getClientOriginalName();
            $file2->storeAs('public/pdf-2/', $file2Name);

            $data['file_2'] =  $file2Name;

            Storage::delete('public/pdf-2/' . $theses->file_2);
        }
        
        $data['user_id'] = Auth::user()->id;

        // Save the Thesis instance
        $theses->update($data);
        // Redirect to the user profile page
        return redirect()->route('user.profile')->with('success', 'Sukses Memperbarui Data Tugas Akhir');
    }

    public function destroy($id) {
        $theses = Thesis::find($id);

        Storage::delete('public/pdf-1/' . $theses->file_1);
        Storage::delete('public/pdf-2/' . $theses->file_2);

        $theses->forceDelete();

        return redirect()->route('user.profile')->with('success', 'Data berhasil dihapus');
    }
}
