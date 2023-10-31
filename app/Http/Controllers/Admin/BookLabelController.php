<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use App\Http\Controllers\Controller;

class BookLabelController extends Controller
{
    public function generateLabel($bookId)
    {
        // Retrieve the book by its ID
        $book = Book::find($bookId);

        if (!$book) {
            // Handle the case where the book with the given ID is not found (e.g., show an error message).
            return redirect()->back()->with('error', 'Book not found.');
        }

        // Create a PDF instance
        $pdf = PDF::loadView('admin.pdf.book_labels', ['book' => $book]);

        // Define the filename for the generated PDF
        $pdfFileName = 'book_label_' . $book->id . '.pdf';

        // Return the PDF as a download response
        return $pdf->download($pdfFileName);
    }

    public function generateAllBookLabels(Request $request)
    {
        // Validate the input
        $request->validate([
            'all' => 'nullable|boolean',
            'specID' => 'nullable|numeric',
            'specDetailID' => 'nullable|numeric',
            'yearEntry' => 'nullable|numeric',
        ]);

        // Check if 'all' is checked and get all books
        if ($request->has('all')) {
            $books = Book::all();
        } elseif ($request->filled('specID')) {
            // Get Specific Specialization Book
            $books = Book::where('spec_id', $request->input('specID'))->get();
        } elseif ($request->filled('specDetailID')) {
            // Get Specific Detail Specialization Book
            $books = Book::where('spec_detail_id', $request->input('specDetailID'))->get();
        } elseif ($request->filled('yearEntry')) {
            // Get Specific Year Entry Book
            $books = Book::where('year_entry', $request->input('yearEntry'))->get();
        }

        if ($books->isEmpty()) {
            // Handle the case where no matching books are found
            return redirect()->back()->with('error', 'No books found for the selected criteria.');
        }

        // Eager load relationships for the PDF view
        $books->load('specialization', 'specDetail');

        // Create a PDF instance
        $pdf = PDF::loadView('admin.pdf.multi_book_labels', ['books' => $books]);

        // Define the filename for the generated PDF
        $pdfFileName = 'book_labels_' . time() . '.pdf';

        // Save the PDF to a temporary file for printing
        $tempPdfFilePath = storage_path('app/temp/' . $pdfFileName);
        $pdf->save($tempPdfFilePath);

        // Create a BinaryFileResponse with appropriate headers
        $response = response()->file($tempPdfFilePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=$pdfFileName", // Download the PDF
        ])->deleteFileAfterSend(true);

        return $response;
    }

}
