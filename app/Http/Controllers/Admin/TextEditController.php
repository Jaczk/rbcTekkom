<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TextEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TextEditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $texts = TextEdit::all();

        return view('admin.textEdit.index', ['texts' => $texts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptId = Crypt::decryptString($id);
        $text = TextEdit::find($decryptId);

        return view('admin.textEdit.edit', ['text' => $text]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('token');

        $request->validate([
            'title'=>'required|string',
            'desc'=>'string',
            'image'=>'string|nullable',
        ]);

        $text = TextEdit::find($id);

        $text->update($data);

        return redirect()->route('admin.text')->with('success', 'Sukses memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
