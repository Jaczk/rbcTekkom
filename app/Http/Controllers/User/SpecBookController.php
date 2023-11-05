<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecBookController extends Controller
{
    public function index(){
        return view('mahasiswa.specialization.index');
    }
}
