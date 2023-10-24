<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();

        // foreach ($users as $user) {

        //     $loans = Loan::where('user_id', $user->id)->with('item_loan')->get();

        //     $filteredLoan = $loans->filter(function ($loan) {
        //         return $loan->is_returned === 0;
        //     });

        //     $filteredLoan->each(function ($loan) {

        //         if ($loan->item_loan->isEmpty()) {
        //             // Delete the loan
        //             $loan->forceDelete();
        //         }

        //         $fine = $this->calculateFine($loan->return_date);
        //         $loan->fine = $fine;
        //         $loan->save();
        //     });

        //     $totalFine = $filteredLoan->sum('fine');

        //     $user['total_fine'] = $totalFine;
        //     $user->save();
        // }

        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy($id)
    {
        $user = User::find($id);

        $hasActiveLoans = $user->whereHas('loan', function ($q) {
            $q->where('is_returned', 0);
        })->exists();

        if ($hasActiveLoans) {
            return redirect()->route('admin.user')->with('error', 'Gagal menghapus akun pengguna, karena pengguna masih memiliki pinjaman aktif !');
        }

        $user->delete();
        
        return redirect()->route('admin.user')->with('success', 'Berhasil menghapus akun pengguna !');
    }
}
