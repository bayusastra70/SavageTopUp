<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login_proses(Request $request)
{
    $request->validate([
        'email' => 'required|email', // Tambahkan validasi email
        'password' => 'required',
    ]);

    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        $user = Auth::user(); // Ambil data user yang sedang login

        // Cek role dan arahkan sesuai
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Berhasil login sebagai Admin');
        } elseif ($user->role === 'user') {
            return redirect()->route('index')->with('success', 'Berhasil login sebagai User');
        }

        // Jika role tidak sesuai, logout dan berikan pesan error
        Auth::logout();
        return redirect()->route('login')->with('failed', 'Role tidak valid.');
    } else {
        return redirect()->route('login')->with('failed', 'Email atau Password salah');
    }
}


    public function register(){
        return view('auth.register');
    }

    public function register_proses(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $data['name']   = $request->name;
        $data['email']  = $request->email;
        $data['password'] = Hash::make($request->password);
        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($login)){
            return redirect()->route('index')->with('success', 'berhasil login');
        }else{
            return redirect()->route('login')->with('failed', 'Email atau Password salah');
        };
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('index')->with('success','Kamu berhasil logout');
    }
}
