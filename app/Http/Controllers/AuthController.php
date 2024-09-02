<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('login.login');
    }

    public function register(){
        return view('login.register');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);
        $request['name'] = $request->name;
        $request['email'] = $request->email;
        $request['password'] = Hash::make($request->password);
        $request['rules_id'] = '2';
        $request['status'] = 'tidak';

        $register = User::create($request->all());
        if($register){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Akun anda berhasil dibuat');
        }
        return redirect('/login');
    }
    
    public function authenticating(Request $request){
        $credential = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credential)){
            if(Auth::user()->status == 'tidak'){
                Session::flash('status', 'failed');
                Session::flash('pesan', 'Akun anda belum aktif !!');
                return redirect('/login');
            }
            if(Auth::user()->rules_id){
                return redirect('/dashboard');
            }
        }
        Session::flash('status', 'failed');
        Session::flash('pesan', 'Gagal Login');
        return redirect('/login');
    }

    public function index_active(){
        $user = User::get()->where('status', 'ya')->where('rules_id', 2);
        return view('user.user-tampil-aktif', [
            'data_aktif' => $user,
        ]);
    }

    public function index_inactive(){
        $user = User::all()->where('status', 'tidak')->where('rules_id', 2);
        return view('user.user-tampil-inaktif', [
            'data_inaktif' => $user
        ]);
    }

    public function approve($id){
        $user = User::FindOrFail($id);
        $user->status = 'ya';
        $user->save();
        if($user){
            Session::flash('status', 'success');
            Session::flash('pesan', 'User telah aktif');
        }
        return redirect('/user-active');
    }

    public function delete($id){
        $user = User::FindOrFail($id);
        $user->delete();
        if($user){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Hapus user sukses !!');
        }
        return redirect('/user-active');
    }

    public function update(Request $request, $id){
        $user = User::FindOrFail($id);
        $password = $user->password;
        if( $request['password'] == ""){
            $request['password'] = $password;
        }else{

            $request['password'] = Hash::make($request->password);
        }
        $user->update($request->all());
        return redirect('/dashboard');
    }
}
