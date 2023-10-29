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

        // Return the PDF as a download response
        return $pdf->download($pdfFileName);
    }



    public function generateWordLabels($bookId)
    {
        // Retrieve the book by its ID
        $book = Book::find($bookId);

        // Create a new PHPWord instance
        $phpWord = new PhpWord();

        // Define a template file for the labels (you should have a template.docx with placeholders)
        $templateFile = storage_path('app/templates/template.docx');

        // Create a table for the labels
        $table = $phpWord->addTable();
        $table->addRow();
        $cell = $table->addCell();
        $cell->addText('Book Name');
        $cell = $table->addCell();
        $cell->addText('Library Code');
        // Add more table headers as needed

        $table->addRow();
        $cell = $table->addCell();
        $cell->addText($book->book_name);
        $cell = $table->addCell();
        $cell->addText($book->lib_book_code);
        // Add more data as needed
        // Save the labels to a Word (DOCX) file
        $labelFileName = 'labels.docx';
        $phpWord->save(storage_path('app/labels/' . $labelFileName));

        // Provide the DOCX file for download
        return response()->download(storage_path('app/labels/' . $labelFileName))->deleteFileAfterSend(true);
    }
    // public function generateWordLabels(Request $request)
    // {
    //     // Get input criteria from the request (you can adjust this based on your form fields)
    //     $bookCriteria = $request->input('book_criteria');

    //     // Query the database based on the criteria
    //     $books = Book::whereIn('id', $bookCriteria)->get(); // Adjust the condition as per your needs

    //     // Create a new PHPWord instance
    //     $phpWord = new PhpWord();

    //     // Define a template file for the labels (you should have a template.docx with placeholders)
    //     $templateFile = storage_path('app/templates/template.docx');

    //     // Create a table for the labels
    //     $table = $phpWord->addTable();
    //     $table->addRow();
    //     $cell = $table->addCell();
    //     $cell->addText('Book Name');
    //     $cell = $table->addCell();
    //     $cell->addText('Library Code');
    //     // Add more table headers as needed

    //     // Loop through each book and generate a label
    //     foreach ($books as $book) {
    //         $table->addRow();
    //         $cell = $table->addCell();
    //         $cell->addText($book->book_name);
    //         $cell = $table->addCell();
    //         $cell->addText($book->lib_book_code);
    //         // Add more data as needed
    //     }

    //     // Save the labels to a Word (DOCX) file
    //     $labelFileName = 'labels.docx';
    //     $phpWord->save(storage_path('app/labels/' . $labelFileName));

    //     // Provide the DOCX file for download
    //     return response()->download(storage_path('app/labels/' . $labelFileName))->deleteFileAfterSend(true);
    // }
}
