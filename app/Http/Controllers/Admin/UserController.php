<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();

        foreach($users as $user){
            $loans = Loan::where('user_id', $user->id)->get();

            $filteredLoan = $loans->filter(function ($loan) {
                return $loan->is_returned === 0;
            });
    
            foreach ($filteredLoan as $floan) {
                $floan->fine = $this->calculateFine($floan->return_date);
                $floan->save();
            }

            $totalFine = $filteredLoan->sum('fine');

            $user['fine'] = $totalFine;
            $user->save();
            
        }
        return view('admin.user.index', ['users' => $users]);
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
        $decryptId = Crypt::decryptString($id);
        $user = User::find($decryptId);
        $roles = Role::all();
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'role_id'=> 'required',
            'phone' => 'required|max:15|regex:/^\+62\d{0,}$/',
        ]);

        $user = User::find($id);

        $user->update($data);
        return redirect()->route('admin.user')->with('success', 'Berhasil memperbarui data pengguna');
        
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
