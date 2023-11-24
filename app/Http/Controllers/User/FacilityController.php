<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function gallery()
    {
        // Get all facility data in random order for each set
        $photos1 = Facility::inRandomOrder()->get();
        $photos2 = Facility::inRandomOrder()->get();
        $photos3 = Facility::inRandomOrder()->get();

        // Pass the data to the view
        return view('mahasiswa.facility.gallery', compact('photos1', 'photos2', 'photos3'));
    }
}
