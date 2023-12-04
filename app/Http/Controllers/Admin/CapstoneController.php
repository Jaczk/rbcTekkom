<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Capstone;
use App\Models\Lecturer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Specialization;
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
        // $capstones = Capstone::groupBy('capstone_title', 'team_name', 'spec_id', 'member1_id', 'member2_id', 'member3_id', 'lec1_id', 'lec2_id', 'year', 'c100', 'c200', 'c300', 'c400', 'c500')
        //     ->select('capstone_title', 'team_name', 'spec_id', 'member1_id', 'member2_id', 'member3_id', 'lec1_id', 'lec2_id', 'year', 'c100', 'c200', 'c300', 'c400', 'c500')
        //     ->get();
        $capstones = Capstone::select('capstone_title', 'team_name', 'spec_id', 'member1_id', 'member2_id', 'member3_id', 'lec1_id', 'lec2_id', 'year', 'c100', 'c200', 'c300', 'c400', 'c500')
            ->distinct()
            ->get();

        return view('admin.capstone.index', compact('users', 'lecturer', 'spec', 'capstones',));
    }

    public function all()
    {
        $capstone = Capstone::with(['lec1', 'lec2'])->get();
        return view('admin.capstone.all', compact('capstone'));
    }

    public function edit($id)
    {
        $decryptId = Crypt::decryptString($id);
        $capstone = Capstone::find($decryptId);
        $users = User::where('role_id', 2)->get();
        $spec = Specialization::all();
        $lecturer = Lecturer::all();

        return view('admin.capstone.edit', [
            'capstone' => $capstone,
            'users' => $users,
            'spec' => $spec,
            'lecturer' => $lecturer,
        ]);
    }

    public function editAll($id)
    {
        $decryptId = Crypt::decryptString($id);
        $capstone = Capstone::with(['lec1', 'lec2', 'user', 'spec', 'member1', 'member2', 'member3'])
            ->select('capstones.*') // Select all columns from the Capstone table
            ->where('team_name', $decryptId)
            ->distinct('team_name') // Consider distinct values based on team_name
            ->first();
        return view('admin.capstone.editAll', [
            'capstone' => $capstone,
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
            'member3_id' => 'required',
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

        $data['user_id'] = $request->input('member1_id');
        $data2 = $data;
        $data2['user_id'] = $request->input('member2_id');
        $data3 = $data;
        $data3['user_id'] = $request->input('member3_id');

        $capstone = new Capstone($data);
        $capstone2 = new Capstone($data2);
        $capstone3 = new Capstone($data3);

        $capstone->save();
        $capstone2->save();
        $capstone3->save();

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
            'member1_id' => 'required',
            'member2_id' => 'required',
            'member3_id' => 'required',
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

        $data['user_id'] = $request->input('member1_id');
        $data2 = $data;
        $data2['user_id'] = $request->input('member2_id');
        $data3 = $data;
        $data3['user_id'] = $request->input('member3_id');

        // Save the Thesis instance
        $capstone->update($data);
        $capstone2->update($data2);
        $capstone3->update($data3);

        // Redirect to the user profile page
        return redirect()->route('user.profile')->with('success', 'Sukses Memperbarui Data Capstone');
    }


    public function destroy($id)
    {
        $capstone = Capstone::find($id);
        $capstone2 = Capstone::where('user_id', $capstone->member2_id);
        $capstone3 = Capstone::where('user_id', $capstone->member3_id);

        Storage::delete('public/c100/' . $capstone->c100);
        Storage::delete('public/c200/' . $capstone->c200);
        Storage::delete('public/c300/' . $capstone->c300);
        Storage::delete('public/c400/' . $capstone->c400);
        Storage::delete('public/c500/' . $capstone->c500);

        $capstone->forceDelete();
        $capstone2->forceDelete();
        $capstone3->forceDelete();


        return redirect()->route('user.profile')->with('success', 'Data berhasil dihapus');
    }
}
