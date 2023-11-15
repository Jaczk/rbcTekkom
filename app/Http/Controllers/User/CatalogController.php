<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpecDetail;
use App\Models\Specialization;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Get the filter values from the request
        $specId = $request->input('spec');
        $specDetailId = $request->input('spec_detail');
        $searchInput = $request->input('search');

        // Start with a base query to fetch books
        $query = Book::query();

        // Apply filters based on the presence of values
        if ($specId) {
            $query->where('spec_id', $specId);

            if ($specDetailId) {
                $query->where('spec_detail_id', $specDetailId);
            }
        } elseif ($specDetailId) {
            $query->where('spec_detail_id', $specDetailId);
        }

        if ($searchInput) {
            $query->where(function ($subQuery) use ($searchInput) {
                $subQuery->where('book_name', 'like', "%{$searchInput}%")
                    ->orWhere('isbn_issn', 'like', "%{$searchInput}%")
                    ->orWhere('author', 'like', "%{$searchInput}%")
                    ->orWhere('publisher', 'like', "%{$searchInput}%");
            });
        }

        // Fetch the books
        $books = $query->get();

        // Fetch additional data needed for the view
        $specs = Specialization::all();
        $specDetails = SpecDetail::all();

        return view('mahasiswa.catalog.index', compact('books', 'specs', 'specDetails'));
    }
}
