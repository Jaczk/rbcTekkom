<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Specialization;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $specializations = Specialization::orderBy('spec_char', 'asc')->get();
        $books = Book::where('is_recommended', 1)->orderBy('book_name')->get();
        return view('mahasiswa.dashboard.index', compact('specializations', 'books'));
    }


    public function access()
    {
        return view('user-acc');
    }
}
