<?php

namespace App\Http\Controllers\Admin;

use App\Models\Librarian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class LibrarianController extends Controller
{
    public function index()
    {
        $librarians = Librarian::all();
        return view('admin.librarian.index', compact('librarians'));
    }

    public function edit(string $id)
    {
        $decryptId = Crypt::decryptString($id);
        $librarian =  Librarian::find($decryptId);

        return view('admin.librarian.edit', ['librarian' => $librarian]);
    }

    public function create(){
        return view('admin.librarian.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' =>'required|string',
            'nim' =>'required|string',
            'image'=>'string|nullable',
            'year' =>'required|string',
        ]);

        Librarian::create($data);
        return redirect()->route('admin.librarian')->with('success', 'Data pustakawan baru berhasil ditambahkan');
    }

    public function update($id, Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' =>'required|string',
            'nim' =>'required|string',
            'image'=>'string|nullable',
            'year' =>'required|string',
        ]);

        $librarian =  Librarian::find($id);

        $librarian->update($data);

        return redirect()->route('admin.librarian')->with('success', 'Sukses memperbarui data pustakawan');
    }

    public function destroy($id)
    {
        $librarian =  Librarian::find($id);

        $librarian->forceDelete();

        return redirect()->route('admin.librarian')->with('success', 'Data berhasil dihapus');
    }
}
