<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboardAdmin() {
        return view("dashboard");
    }

    public function dashboardKasir() {
        return view("kasir.dashboard");
    }

    public function login() {
        return view("login");
    }

    public function pelanggan() {
        return view("pelanggan");
    }

    public function cekLogin(Request $request) {

        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $request->session()->regenerate();

        $data_user = $request->only(['username', 'password']);

        if (auth()->guard('admin')->attempt($data_user)){
            return redirect('/');
        } else {
            return redirect('/login');
        }
        
    }

    public function Logout(Request $request) {
        
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        return redirect('/login');
        
    }
}
