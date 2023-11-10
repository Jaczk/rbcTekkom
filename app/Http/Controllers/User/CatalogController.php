<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialization;

class CatalogController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $specs = Specialization::all();
        return view('mahasiswa.catalog.index', compact('books', 'specs'));
    }
}
