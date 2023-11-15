<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecBookController extends Controller
{
    public function index(){
        return view('mahasiswa.specialization.index');
    }

    public function sortedBySpec($id)
    {
        $books = Book::whereHas('specialization', function ($q) use ($id) {
            $q->where('id', $id);
        })->get();

        return view('mahasiswa.specialization.index', ['books' => $books]);
    }
}
