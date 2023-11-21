<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all()->slice(1);
        $shiftFirst = Shift::first();

        return view('admin.shift.index',['shifts' => $shifts, 'shiftFirst' => $shiftFirst]);
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
        $shift =  Shift::find($decryptId);

        return view('admin.shift.edit', ['shift' => $shift]);
    
    }

    public function editTime()
    {   
        $shift = Shift::first();

        return view('admin.shift.editTime',['shift'=> $shift]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('token');

        $request->validate([
            'day'=>'required|string',
            's1'=>'required|string',
            's2'=>'required|string',
            's3'=>'required|string',
        ]);

        $shift = Shift::find($id);

        $shift->update($data);

        return redirect()->route('admin.shift')->with('success', 'Sukses memperbarui shift layanan');
    }

    public function updateTime(Request $request)
    {
        $data = $request->except('token');

        $request->validate([
            'day'=>'required|string',
            's1'=>'required|string',
            's2'=>'required|string',
            's3'=>'required|string',
        ]);

        $shift = Shift::first();

        $shift->update($data);

        return redirect()->route('admin.shift')->with('success', 'Sukses memperbarui jam layanan RBC');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
