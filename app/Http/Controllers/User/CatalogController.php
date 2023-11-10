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

        // Fetch books based on the filter values
        $books = Book::when($specId && $specDetailId, function ($query) use ($specId, $specDetailId) {
            // If both filters are selected, apply both filters
            $query->where('spec_id', $specId)->where('spec_detail_id', $specDetailId);
        })
            ->when($specId && !$specDetailId, function ($query) use ($specId) {
                // If only the first filter is selected, apply the first filter
                $query->where('spec_id', $specId);
            })
            ->when(!$specId && $specDetailId, function ($query) use ($specDetailId) {
                // If only the second filter is selected, apply the second filter
                $query->where('spec_detail_id', $specDetailId);
            })
            ->get();

        $specs = Specialization::all();
        $specDetails = SpecDetail::all();

        return view('mahasiswa.catalog.index', compact('books', 'specs', 'specDetails'));
    }
}
