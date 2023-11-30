<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturer = Lecturer::all();

        return view('admin.lecturer.index', compact('lecturer'));
    }
}
