<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loan = Loan::with(['user', 'book'])->orderBy('is_returned', 'asc')->get();

        $filteredLoan = Loan::where('is_returned', 0)->get();

        foreach ($filteredLoan as $floan) {
            $floan->fine = $this->calculateFine($floan->return_date);
            $floan->save();
        }

        return view('admin.loan.index', ['loans' => $loan]);
    }

    public function calculateFine($returnDate)
    {
        $fine = 0;

        $date = substr($returnDate, 0, 10);

        $filteredReturnDate = $date . " 00:00:00";
        $fineValue = Fine::where('fine_name', 'loan_fine')->first();

        if ($filteredReturnDate < Carbon::today()) {
            $diffInDays = Carbon::today()->diffInDays($filteredReturnDate);
            $fine = ($diffInDays) * $fineValue->value;
        }

        return $fine;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookDrops = Book::where('is_available', 1)->get();
        $userDrops = User::where('is_loan', 0)->get();
        return view('admin.loan.create', compact('bookDrops', 'userDrops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data  = $request->except('_token');

        $request->validate([
            'book_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        Book::find($data['book_id'])->update(['is_available' => 0]);
        User::find($data['user_id'])->update(['is_loan' => 1]);

        $data['return_date'] = Carbon::now()->addDays(7);
        $data['period'] = Carbon::now()->format('Ym');

        Loan::create($data);
        return redirect()->route('admin.loans')->with('success', 'Berhasil membuat Peminjaman');
    }

    /**
     * Display the specified resource.
     */
    public function return($id)
    {
        // Find a single loan record by its ID
        $loan = Loan::with('book')->find($id);

        if ($loan && $loan->is_returned === 0) {
            // Update the related book and loan records
            Book::find($loan->book->id)->update(['is_available' => 1]);
            $loan->update(['is_returned' => 1]);
            User::find($loan->user->id)->update(['is_loan' => 0]);

            return redirect()->route('admin.loans')->with('success', 'Berhasil Menyelesaikan Peminjaman');
        }

        return redirect()->route('admin.loans')->with('error', 'Gagal Menyelesaikan Peminjaman');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
