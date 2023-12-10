<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('mahasiswa.login.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required|unique:users,nim',
            'full_name' => 'required',
            'phone' => 'required|max:15|regex:/^\+62[1-9][0-9]*$/',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Username wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'full_name.required' => 'Nama Lengkap wajib diisi',
            'nim.unique' => 'NIM sudah digunakan, silakan input NIM lain',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.max' => 'Nomor telepon maksimal 15 karakter',
            'phone.regex' => 'Penulisan nomor telepon diawali dengan +62',
            'email.required' => 'Email harus diisi dan valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $data = $request->except('_token');

        $isEmailExist = User::where('email', $request->email)->exists();

        if ($isEmailExist) {
            return back()->withErrors([
                'email' => 'Email ini sudah digunakan!'
            ])->withInput();
        }
        // $phoneNumber = $request->input('countryCode') . $request->input('phone');
        // $data['phone'] = $phoneNumber;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('login');
    }
}
