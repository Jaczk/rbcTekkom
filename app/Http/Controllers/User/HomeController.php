<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Donate;
use App\Models\Specialization;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $specializations = Specialization::orderBy('spec_char', 'asc')->get();
        $books = Donate::where('is_fav', 1)->orderBy('book_name')->get();
        return view('mahasiswa.dashboard.index', compact('specializations', 'books'));
    }

    public function access()
    {
        return view('user-acc');
    }

    public function show($id)
    {
        $book = Book::with(['specialization', 'specDetail'])->find($id);
        return response()->json($book);
    }
}
