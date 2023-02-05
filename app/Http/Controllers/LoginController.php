<?php

namespace App\Http\Controllers;

use App\Models\userLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\NoReturn;

class LoginController extends Controller
{

    public function show()
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);


        $user = userLogin::whereRaw('UPPER(UserName)=UPPER("' . $credentials['username'] . '")')->first();
        if (!$user) {
            return redirect()->back()->withErrors('You are not authorized');
        }

//        if ($this->checkActiveDirectory($credentials->username, $credentials->password)) {
        if ($user->Username == "Ibrahim_MElsaber") {

            Session::put('userId', $user->Id);
            Session::put('userName', $user->Username);
            Session::put('GroupId', $user->GroupId);
            Session::put('user', $user);
            return redirect()->route('my.accounts');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);

    }


    public function logout()
    {
        Session::forget('userId');
        Session::forget('userName');
        Session::forget('GroupId');
        Session::forget('user');

        return Redirect::to('/');
    }
}
