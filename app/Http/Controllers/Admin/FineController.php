<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class FineController extends Controller
{

    public function edit()
    {
        $fine = Fine::first();

        return view('admin.fine.index',['fine'=> $fine]);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'value' => 'required|integer'
        ]);

        $fine = Fine::first();

        $fine->update($data);
        return redirect()->route('admin.fine.edit')->with('success', 'Sukses memperbarui denda');

    }
}
