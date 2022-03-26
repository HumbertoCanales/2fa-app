<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\UserCode;
use Illuminate\Support\Facades\URL;

class TwoFAController extends Controller
{

    public function index(Request $request)
    {
        return view('2fa');
    }

    public function getSignedUrl($id)
    {
        return redirect(URL::temporarySignedRoute(
            '2fa.index', now()->addMinutes(5), ['user' => $id]
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(2))
                        ->first();

        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
            return redirect()->route('home');
        }

        return back()->with('error', 'Código incorrecto');
    }

    public function resend()
    {
        auth()->user()->generateCode();

        return back()->with('success', 'Te envíamos un código a tu celular');
    }
}
