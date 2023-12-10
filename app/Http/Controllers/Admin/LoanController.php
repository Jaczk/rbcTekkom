<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $loan2 = Loan::with(['user', 'book'])->orderBy('created_at', 'asc')->get();

        $users = User::with('role')->get();

        foreach ($users as $user) {
            $loans = Loan::where('user_id', $user->id)->get();

            $filteredLoan = $loans->filter(function ($loan) {
                return $loan->is_returned === 0;
            });

            foreach ($filteredLoan as $floan) {
                $floan->fine = $this->calculateFine($floan->return_date);
                $floan->save();
            }
        }

        $loanDrop = Loan::groupBy('period')->select('period')->get();
        $period = $request->period ?? Carbon::now()->format('Ym');

        $chartData = $this->loanChart($period);

        return view('admin.loan.index', [
            'loans' => $loan2,
            'chartData' => $chartData,
            'period' => $period,
            'loanDrop' => $loanDrop,
        ]);
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

    public function loanChartAjax($period)
    {
        $chartData = $this->loanChart($period);

        return response()->json($chartData);
    }

    public static function loanChart($period)
    {
        $loanChart = Loan::where('period', $period)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as date, COUNT(*) as count')
            ->get();

        $returnChart = Loan::where('period', $period)
            ->where('is_returned', 1)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as date, COUNT(*) as count')
            ->get();

        // Get distinct dates from both datasets
        $dates = collect($returnChart->pluck('date'))
            ->concat($loanChart->pluck('date'))
            ->unique()
            ->sortBy(function ($date) {
                return Carbon::parse($date);
            });

        // Create an empty array to hold the chart data
        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Dikembalikan',
                    'data' => [],
                    'backgroundColor' => 'rgba(54, 162, 235, 1)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'fill' => false,
                    'type' => 'bar'
                ],
                [
                    'label' => 'Dipinjam',
                    'data' => [],
                    'backgroundColor' => 'rgba(255, 99, 132, 1)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'fill' => false,
                    'type' => 'bar'
                ]
            ]
        ];

        // Populate the chart data with the available return and loan values
        foreach ($dates as $date) {
            $returnCount = $returnChart->firstWhere('date', $date);
            $loanCount = $loanChart->firstWhere('date', $date);

            // Add the date to the labels array
            $chartData['labels'][] = $date;

            // Add the return count or 0 if not available
            if ($returnCount) {
                $chartData['datasets'][0]['data'][] = $returnCount->count;
            } else {
                $chartData['datasets'][0]['data'][] = 0;
            }

            // Add the loan count or 0 if not available
            if ($loanCount) {
                $chartData['datasets'][1]['data'][] = $loanCount->count;
            } else {
                $chartData['datasets'][1]['data'][] = 0;
            }
        }

        return $chartData;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookDrops = Book::where('stock', '>=', 1)->get();
        $userDrops = User::where('role_id', 2)->where('is_loan', 0)->get();
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

        $book = Book::find($data['book_id']);

        if ($book->stock > 0) {
            $book->update(['stock' => $book->stock - 1]);
        } else {
            return redirect()->route('admin.loans.qr-create')->with('error', 'Buku tidak tersedia atau masih dipinjam');
        }

        User::find($data['user_id'])->update(['is_loan' => 1]);

        $data['return_date'] = Carbon::now()->addDays(7);
        $data['period'] = Carbon::now()->format('Ym');

        Loan::create($data);
        return redirect()->route('admin.loans')->with('success', 'Berhasil membuat Peminjaman');
    }

    public function QRcreate()
    {
        $userDrops = User::where('is_loan', 0)->get();
        return view('admin.loan.qr-create', compact('userDrops'));
    }

    public function QRstore(Request $request)
    {
        $data = $request->validate([
            'lib_book_code' => 'required|string',
            'user_id' => 'required|numeric',
        ]);

        $book = Book::where('lib_book_code', $data['lib_book_code'])->first();

        if ($book) {
            // Update the book's availability
            if ($book->stock > 0) {
                $book->update(['stock' => $book->stock - 1]);
            } else {
                return redirect()->route('admin.loans.qr-create')->with('error', 'Buku tidak tersedia atau masih dipinjam');
            }

            // Update the user's loan status
            User::find($data['user_id'])->update(['is_loan' => 1]);

            // Create a new loan record
            $loanData = [
                'book_id' => $book->id,
                'user_id' => $data['user_id'],
                'return_date' => now()->addDays(7),
                'period' => now()->format('Ym'),
            ];

            Loan::create($loanData);

            return redirect()->route('admin.loans')->with('success', 'Berhasil membuat Peminjaman');
        } else {
            return redirect()->route('admin.loans')->with('error', 'Book not found.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function return($id)
    {
        // Find a single loan record by its ID and eager load the 'book' and 'user' relationships
        $loan = Loan::with('book', 'user')->find($id);

        if ($loan && $loan->is_returned === 0) {
            // Update the related book and loan records
            $loan->book->update(['stock' => $loan->book->stock + 1]);
            $loan->update(['is_returned' => 1]);
            $loan->user->update(['is_loan' => 0]);

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
