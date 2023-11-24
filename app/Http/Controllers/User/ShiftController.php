<?php

namespace App\Http\Controllers\User;

use App\Models\Shift;
use App\Models\TextEdit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all()->slice(1);
        $shiftFirst = Shift::first();
        $cp = TextEdit::all()->slice(1)->first();

        return view('mahasiswa.shift.index',
        [
            'shifts' => $shifts, 
            'shiftFirst' => $shiftFirst,
            'cp' => $cp,
        ]);
    }

}
