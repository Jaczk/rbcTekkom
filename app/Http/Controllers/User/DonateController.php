<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donate;

class DonateController extends Controller
{
    public function index(Request $request)
    {
        // Get the filter values from the request
        $searchInput = $request->input('search');

        // Start with a base query to fetch books
        $query = Donate::query();

        if ($searchInput) {
            $query->where(function ($subQuery) use ($searchInput) {
                $subQuery->where('book_name', 'like', "%{$searchInput}%")
                    ->orWhere('author', 'like', "%{$searchInput}%")
                    ->orWhere('publisher', 'like', "%{$searchInput}%");
            });
        }

        // Fetch the books
        $books = $query->get();

        return view('mahasiswa.donate.index', compact('books'));
    }

    public function show($id)
    {
        $book = Donate::find($id);
        return response()->json($book);
    }

}
