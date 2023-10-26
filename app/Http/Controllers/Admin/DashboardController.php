<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
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
        $loans = Loan::count();

        $brokenBook = Book::where('condition', 'broken')->count();
        $newBook = Book::where('condition', 'new')->count();
        $normalBook = Book::where('condition', 'normal')->count();

        $specBookChartData = $this->specBookChartAjax($request->period);

        $specBookDrop = Loan::groupBy('period')->select('period')->get();

        $period = $request->period ?? Carbon::now()->format('Ym');

        return view('admin.dashboard.index', compact(
            'books',
            'donates',
            'loans',
            'brokenBook',
            'newBook',
            'normalBook',
            'specBookChartData',
            'specBookDrop',
            'period'

        ));
    }

    public function specBookChartAjax($period)
    {
        $specBookChartData = $this->specBookChart($period);

        return response()->json($specBookChartData);
    }

    public static function specBookChart($period)
    {
        $data =Loan::join('books', 'loans.book_id', '=', 'books.id')
        ->where('period',$period)
        ->join('specializations', 'books.spec_id', '=', 'specializations.id')
        ->groupBy('specializations.desc')
        ->select('specializations.desc', DB::raw('COUNT(*) as count'))
        ->get();

        $specBookChartData = [
            'labels' => $data->pluck('specializations.desc')->toArray(),
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
