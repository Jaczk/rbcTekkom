<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Donate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::count();
        $donates = Donate::count();
        $lateLoans = Loan::where('is_returned', 0)
            ->where('fine', '>', 0)
            ->where('return_date', '<', Carbon::now())
            ->count();

        $inLoans = Loan::where('is_returned', 0)->count();

        $brokenBook = Book::where('condition', 'broken')->count();

        $noAdmin = User::where('role_id', '!=', 1)->count();

        $specBooks = Book::join('specializations', 'books.spec_id', '=', 'specializations.id')
            ->groupBy('specializations.desc')
            ->select('specializations.desc', DB::raw('COUNT(*) as count'))
            ->get();

        $specBookChartData = $this->specBookChartAjax($request->period);

        $specBookDrop = Loan::groupBy('period')->select('period')->get();

        $period = $request->period ?? Carbon::now()->format('Ym');

        return view('admin.dashboard.index', compact(
            'books',
            'donates',
            'lateLoans',
            'specBooks',
            'specBookChartData',
            'specBookDrop',
            'period',
            'brokenBook',
            'inLoans',
            'noAdmin'
        ));
    }

    public function specBookChartAjax($period)
    {
        $specBookChartData = $this->specBookChart($period);

        return response()->json($specBookChartData);
    }

    public static function specBookChart($period)
    {
        $data = Loan::where('period', $period)
            ->join('books', 'loans.book_id', '=', 'books.id')
            ->join('specializations', 'books.spec_id', '=', 'specializations.id')
            ->groupBy('specializations.desc')
            ->select('specializations.desc', DB::raw('COUNT(*) as count'))
            ->get();

        $specBookChartData = [
            'labels' => $data->pluck('desc')->toArray(),
            'datasets' => [
                [
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => [
                        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de',
                        '#9BE8D8', '#CBFFA9', '#9BCDD2', '#E1AEFF', '#0079FF', '#FDCEDF', '#B799FF',
                        '#D25380', '#E3F2C1', '#6C9BCF', '#408E91'
                    ]
                ]
            ]
        ];
        return $specBookChartData;
    }
}
