<?php

namespace App\Http\Controllers\User;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all()->slice(1);
        $shiftFirst = Shift::first();

        return view('mahasiswa.shift.index',['shifts' => $shifts, 'shiftFirst' => $shiftFirst]);
    }

}
