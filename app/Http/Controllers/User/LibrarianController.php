<?php

namespace App\Http\Controllers\User;

use App\Models\Librarian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LibrarianController extends Controller
{
    public function index(){
        $librarians = Librarian::all();
        return view('mahasiswa.librarian.index', compact('librarians'));
    }
}
