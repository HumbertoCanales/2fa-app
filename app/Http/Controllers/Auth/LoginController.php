<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\UserCode;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            auth()->user()->generateCode();

            $id = auth()->user()->id;

            return redirect('2fa/' . $id);
        }

        return redirect("login")->withError('Credenciales incorrectas');
    }

    public function logout(Request $request) {
        Auth::logout();
        Session::forget('user_2fa');
        return redirect('/login');
    }
}
