<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\SpecDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class SpecDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specDetail = SpecDetail::all();
        return view('admin.spec_detail.index', ['spec_details' => $specDetail]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spec_detail.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'spec_detail_code' => 'required|string',
            'desc' => 'required|string',
        ]);

        SpecDetail::create($data);
        return redirect()->route('admin.specDetail')->with('success', 'Detail Peminatan berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $special = SpecDetail::find($decryptId);

        return view('admin.spec_detail.edit', ['spec_details' => $special]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'spec_detail_code' => 'required|string',
            'desc' => 'required|string',

        ]);

        $special = SpecDetail::find($id);

        $special->update($data);
        return redirect()->route('admin.specDetail')->with('success', 'Sukses memperbarui peminatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spec_detail = SpecDetail::find($id);

        $hasActiveBook = Book::where('spec_detail_code', $spec_detail->id)->exists();

        if ($hasActiveBook) {
            return redirect()->route('admin.specDetail')->with('error', 'Detail Peminatan tidak dapat
            dihapus karena masih memiliki buku aktif');
        }

        $spec_detail->delete();
        return redirect()->route('admin.specDetail')->with('success', 'Detail Peminatan Berhasil Dihapus');
    }
}
