<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Capstone;
use App\Models\Thesis;
use Illuminate\Support\Facades\Crypt;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturer = Lecturer::all();

        return view('admin.lecturer.index', compact('lecturer'));
    }

    public function create()
    {
        return view('admin.lecturer.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string',
            'image' => 'string|nullable',
        ]);

        Lecturer::create($data);
        return redirect()->route('admin.lecturer')->with('success', 'Data Dosen berhasil dibuat');
    }

    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $lecturer = Lecturer::find($decryptId);
        return view('admin.lecturer.edit', compact('lecturer'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string',
            'image' => 'string|nullable',
        ]);

        $lecturer = Lecturer::find($id);

        $lecturer->update($data);
        return redirect()->route('admin.lecturer')->with('success', 'Sukses memperbarui data dosen');
    }

    public function destroy($id)
    {
        $lecturer = Lecturer::find($id);

        $hasActiveCapstone = Capstone::where('lec1_id', $lecturer->id)->orWhere('lec2_id', $lecturer->id)->exists();
        $hasActiveTheses = Thesis::where('lec1_id', $lecturer->id)->orWhere('lec2_id', $lecturer->id)->exists();

        if ($hasActiveCapstone || $hasActiveTheses) {
            return redirect()->route('admin.lecturer')->with('error', 'Data dosen tidak bisa dihapus karena masih dimiliki data capstone atau tugas akhir seseorang');
        }

        $lecturer->forceDelete();

        return redirect()->route('admin.lecturer')->with('success', 'Data dosen Berhasil Dihapus');
    }
}
