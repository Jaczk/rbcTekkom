<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Thesis;
use App\Models\Lecturer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ThesesController extends Controller
{
    public function index()
    {
        $user = User::where('role_id',2)->get();
        $theses = Thesis::with(['lec1', 'lec2'])->get();

        return view('admin.theses.index', compact('user', 'theses'));
    }

    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $theses = Thesis::find($decryptId);
        $spec = Specialization::all();
        $lecturer = Lecturer::all();
        $user = User::where('role_id',2)->get();

        return view('admin.theses.edit', compact('theses', 'spec', 'lecturer', 'user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'thesis_name' => 'required|string',
            'spec_id' => 'required',
            'lec1_id' => 'required',
            'lec2_id' => 'required',
            'year' => 'required|numeric',
            'abstract' => 'required|string',
            'abs_keyword' => 'required|string',
            'file_1' => 'required|mimes:pdf',
            'file_2' => 'required|mimes:pdf',

        ]);

        // Handle file_1 upload
        $file1 = $request->file('file_1');
        $file1Name = Str::random(8) . $file1->getClientOriginalName();
        $file1->move(public_path('store/pdf-1'), $file1Name);

        // Handle file_2 upload
        $file2 = $request->file('file_2');
        $file2Name = Str::random(8) . $file2->getClientOriginalName();
        $file2->move(public_path('store/pdf-2'), $file2Name);

        // Create Thesis instance
        $thesis = new Thesis([
            // 'user_id' => Auth::user()->id,
            'spec_id' => $request->input('spec_id'),
            'lec1_id' => $request->input('lec1_id'),
            'lec2_id' => $request->input('lec2_id'),
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

        // Redirect to the user profile page
        return redirect()->route('admin.theses')->with('success', 'Sukses Mengupload Tugas Akhir');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'thesis_name' => 'required|string',
            'spec_id' => 'required',
            'lec1_id' => 'required',
            'lec2_id' => 'required',
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
            $file1->move(public_path('store/pdf-1'), $file1Name);

            $data['file_1'] =  $file1Name;

            File::delete(public_path('store/pdf-1/' . $theses->file_1));
        }

        if ($request->hasFile('file_2')) {
            // Handle file_2 upload
            $file2 = $request->file('file_2');
            $file2Name = Str::random(8) . $file2->getClientOriginalName();
            $file2->move(public_path('store/pdf-2'), $file2Name);

            $data['file_2'] =  $file2Name;

            File::delete(public_path('store/pdf-2/' . $theses->file_2));
        }

        // Save the Thesis instance
        $theses->update($data);
        // Redirect to the user profile page
        return redirect()->route('admin.theses')->with('success', 'Sukses Memperbarui Data Tugas Akhir');
    }

    public function destroy($id)
    {
        $theses = Thesis::find($id);

        File::delete(public_path('store/pdf-1/' . $theses->file_1));
        File::delete(public_path('store/pdf-2/' . $theses->file_2));

        $theses->forceDelete();

        return redirect()->route('user.profile')->with('success', 'Data berhasil dihapus');
    }
}
