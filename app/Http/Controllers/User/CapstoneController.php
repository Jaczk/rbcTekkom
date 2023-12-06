<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Capstone;
use App\Models\Lecturer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class CapstoneController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->get();
        $lecturer = Lecturer::all();
        $spec = Specialization::all();

        return view('mahasiswa.profile.capstone', compact('users', 'lecturer', 'spec'));
    }

    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $theses = Capstone::find($decryptId);
        $users = User::where('role_id', 2)->get();
        $spec = Specialization::all();
        $lecturer = Lecturer::all();

        return view('mahasiswa.profile.capstone-edit', [
            'theses' => $theses,
            'users' => $users,
            'spec' => $spec,
            'lecturer' => $lecturer,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'capstone_title' => 'required|string',
            'spec_id' => 'required',
            'team_name' => 'required|string',
            'lec1_id' => 'required',
            'lec2_id' => 'required',
            'member1_id' => 'required',
            'member2_id' => 'required',
            'member3_id' => 'nullable',
            'summary' => 'nullable|string',
            'year' => 'required|numeric',
            'c100' => 'nullable|mimes:pdf',
            'c200' => 'nullable|mimes:pdf',
            'c300' => 'nullable|mimes:pdf',
            'c400' => 'nullable|mimes:pdf',
            'c500' => 'nullable|mimes:pdf',
        ]);

        if ($request->hasFile('c100')) {
            // Handle c100 upload
            $file1 = $request->file('c100');
            $file1Name = Str::random(8) . $file1->getClientOriginalName();
            $file1->storeAs('public/c100/', $file1Name);

            $data['c100'] =  $file1Name;
        }

        if ($request->hasFile('c200')) {
            // Handle c200 upload
            $file2 = $request->file('c200');
            $file2Name = Str::random(8) . $file2->getClientOriginalName();
            $file2->storeAs('public/c200/', $file2Name);

            $data['c200'] =  $file2Name;
        }

        if ($request->hasFile('c300')) {
            // Handle c300 upload
            $file3 = $request->file('c300');
            $file3Name = Str::random(8) . $file3->getClientOriginalName();
            $file3->storeAs('public/c300/', $file3Name);

            $data['c300'] =  $file3Name;
        }

        if ($request->hasFile('c400')) {
            // Handle c400 upload
            $file4 = $request->file('c400');
            $file4Name = Str::random(8) . $file4->getClientOriginalName();
            $file4->storeAs('public/c400/', $file4Name);

            $data['c400'] =  $file4Name;
        }

        if ($request->hasFile('c500')) {
            // Handle c500 upload
            $file5 = $request->file('c500');
            $file5Name = Str::random(8) . $file5->getClientOriginalName();
            $file5->storeAs('public/c500/', $file5Name);

            $data['c500'] =  $file5Name;
        }

        $data['user_id'] = Auth::user()->id;
        $data2 = $data;
        $data2['user_id'] = $request->input('member2_id');

        $capstone = new Capstone($data);
        $capstone2 = new Capstone($data2);

        $capstone->save();
        $capstone2->save();

        if ($request->input('member3_id')) {
            $data3 = $data;
            $data3['user_id'] = $request->input('member3_id');
            $capstone3 = new Capstone($data3);
            $capstone3->save();
        }

        Artisan::call('custom:storagelink');

        return redirect()->route('user.profile')->with('success', 'Data Capstone berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $request->validate([
            'capstone_title' => 'required|string',
            'spec_id' => 'required',
            'team_name' => 'required|string',
            'lec1_id' => 'required|string',
            'lec2_id' => 'required|string',
            'member1_id' => 'nullable',
            'member2_id' => 'nullable',
            'member3_id' => 'nullable',
            'summary' => 'nullable|string',
            'year' => 'required|numeric',
            'c100' => 'nullable|mimes:pdf',
            'c200' => 'nullable|mimes:pdf',
            'c300' => 'nullable|mimes:pdf',
            'c400' => 'nullable|mimes:pdf',
            'c500' => 'nullable|mimes:pdf',
        ]);

        $capstone = Capstone::find($id);
        $capstone2 = Capstone::where('user_id', $capstone->member2_id);
        $capstone3 = Capstone::where('user_id', $capstone->member3_id);
        $capstone4 = Capstone::where('user_id', $capstone->member1_id);

        if ($request->hasFile('c100')) {
            // Handle c100 upload
            $file1 = $request->file('c100');
            $file1Name = Str::random(8) . $file1->getClientOriginalName();
            $file1->storeAs('public/c100/', $file1Name);

            $data['c100'] =  $file1Name;

            Storage::delete('public/c100/' . $capstone->c100);
        }

        if ($request->hasFile('c200')) {
            // Handle c200 upload
            $file2 = $request->file('c200');
            $file2Name = Str::random(8) . $file2->getClientOriginalName();
            $file2->storeAs('public/c200/', $file2Name);

            $data['c200'] =  $file2Name;

            Storage::delete('public/c200/' . $capstone->c200);
        }

        if ($request->hasFile('c300')) {
            // Handle c300 upload
            $file3 = $request->file('c300');
            $file3Name = Str::random(8) . $file3->getClientOriginalName();
            $file3->storeAs('public/c300/', $file3Name);

            $data['c300'] =  $file3Name;

            Storage::delete('public/c300/' . $capstone->c300);
        }

        if ($request->hasFile('c400')) {
            // Handle c400 upload
            $file4 = $request->file('c400');
            $file4Name = Str::random(8) . $file4->getClientOriginalName();
            $file4->storeAs('public/c400/', $file4Name);

            $data['c400'] =  $file4Name;

            Storage::delete('public/c400/' . $capstone->c400);
        }

        if ($request->hasFile('c500')) {
            // Handle c500 upload
            $file5 = $request->file('c500');
            $file5Name = Str::random(8) . $file5->getClientOriginalName();
            $file5->storeAs('public/c500/', $file5Name);

            $data['c500'] =  $file5Name;

            Storage::delete('public/c500/' . $capstone->c500);
        }

        // $data['user_id'] = Auth::user()->id;
        // $data2 = $data;
        // $data2['user_id'] = $request->input('member2_id');
        // $data3 = $data;
        // $data3['user_id'] = $request->input('member3_id');
        // $data4 = $data;
        // $data4['user_id'] = $request->input('member1_id');

        // // Save the Thesis instance
        // $capstone->update($data);
        // $capstone2->update($data2);
        // $capstone3->update($data3);
        // $capstone4->update($data4);
        $userIds = [
            Auth::user()->id,
            $request->input('member2_id'),
            $request->input('member1_id'),
        ];
        $capstones = [$capstone, $capstone2, $capstone4];
        if ($request->input('member3_id')) {
            $userIds[] = $request->input('member3_id');
            $capstones[] = $capstone3;
        }
        foreach ($userIds as $index => $userId) {
            $data['user_id'] = $userId;
            $capstones[$index]->update($data);
        }

        // Redirect to the user profile page
        return redirect()->route('user.profile')->with('success', 'Sukses Memperbarui Data Capstone');
    }


    public function destroy($id)
    {
        $capstone = Capstone::find($id);

        // Array of member IDs
        $memberIds = [$capstone->member2_id, $capstone->member3_id, $capstone->member1_id];

        // Loop through each member and delete files and force delete the Capstone instance
        foreach ($memberIds as $memberId) {
            $capstoneMember = Capstone::where('user_id', $memberId)->first();

            if ($capstoneMember) {
                Storage::delete([
                    'public/c100/' . $capstoneMember->c100,
                    'public/c200/' . $capstoneMember->c200,
                    'public/c300/' . $capstoneMember->c300,
                    'public/c400/' . $capstoneMember->c400,
                    'public/c500/' . $capstoneMember->c500,
                ]);

                $capstoneMember->forceDelete();
            }
        }


        return redirect()->route('user.profile')->with('success', 'Data berhasil dihapus');
    }

    public function capstoneGallery()
    {
        $capstones = Capstone::groupBy('capstone_title', 'team_name', 'member1_id', 'member2_id', 'member3_id', 'lec1_id', 'lec2_id', 'year', 'c100', 'c200', 'c300', 'c400', 'c500')
            ->select('capstone_title', 'team_name', 'member1_id', 'member2_id', 'member3_id', 'lec1_id', 'lec2_id', 'year', 'c100', 'c200', 'c300', 'c400', 'c500')
            ->get();
        $years = Capstone::distinct()->pluck('year');
        $lecturers = Lecturer::all();
        $specs = Specialization::all();
        return view('mahasiswa.capstone.index', compact('capstones', 'years', 'lecturers', 'specs'));
    }

    public function capstoneDetail($id)
    {
        $decryptId = Crypt::decryptString($id);
        $capstone = Capstone::with(['lec1', 'lec2', 'user', 'spec', 'member1', 'member2', 'member3'])
            ->select('capstones.*') // Select all columns from the Capstone table
            ->where('team_name', $decryptId)
            ->distinct('team_name') // Consider distinct values based on team_name
            ->first();
        return view('mahasiswa.capstone.detail', [
            'capstone' => $capstone,
        ]);
    }
}
