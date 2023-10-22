<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Support\Facades\Crypt;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = Specialization::all();
        return view('admin.specialization.index', ['specializations' => $specializations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.specialization.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'spec_char' => 'required|string',
            'desc' => 'required|string'
        ]);

        Specialization::create($data);
        return redirect()->route('admin.special')->with('success', 'Peminatan berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $special = Specialization::find($decryptId);
        return view('admin.specialization.edit', ['specializations' => $special]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'spec_char' => 'required|string',
            'desc' => 'required|string'
        ]);

        $special = Specialization::find($id);

        $special->update($data);
        return redirect()->route('admin.special')->with('success', 'Sukses memperbarui peminatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $special = Specialization::find($id);

        $hasActiveBook = Book::where('spec_id', $special->id)->exists();

        if ($hasActiveBook) {
            return redirect()->route('admin.special')->with('error', 'Peminatan tidak dapat dihapus karena masih memiliki buku aktif');
        }

        $special->delete();
        return redirect()->route('admin.special')->with('success', 'Peminatan Berhasil Dihapus');
    }
}
