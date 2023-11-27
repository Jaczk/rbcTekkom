<?php

namespace App\Http\Controllers\User;

use App\Models\TextEdit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextEditController extends Controller
{
    public function faq()
    {
        $text = TextEdit::first();

        return view('mahasiswa.faq.index', ['text' => $text]);
    }

    public function rule()
    {
        $text = TextEdit::first();

        return view('mahasiswa.tatib.index', ['text' => $text]);
    }

    public function visi()
    {
        $text = TextEdit::all()->slice(2)->first();;

        return view('mahasiswa.visi.index', ['text' => $text]);
    }
}
