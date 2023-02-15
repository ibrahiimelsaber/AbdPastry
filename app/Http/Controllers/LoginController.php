<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\userLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{

    public function show()
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {

        $validator = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required'],
        ]);
        if (!$validator) {
            return redirect()->back()->withErrors($validator->errors())->with('message', 'You are not authorized')->with('class', 'alert-danger');
        }

        try {
            if ($request->role == 'user') {

                $username = $validator['username'];
                $password = $validator['password'];
                $protectedUser = strtoupper($username);

                $user = UserLogin::whereRaw("UPPER(Username) = ?", $protectedUser)->where("Active", 1)->first();

                if (!$user || $user == null) {
                    return redirect()->back()->withErrors('You are not authorized')->with('message', 'You are not authorized')->with('class', 'alert-danger');
                }

                if (true) {
//                if ($this->checkActiveDirectory($username, $password)) {
                    Session::put('userId', $user->Id);
                    Session::put('userName', $user->Username);
                    Session::put('GroupId', $user->GroupId);
                    Session::put('role', $request->role);
                    Session::put('user', $user);
                    return redirect()->route('my.accounts.index');
                } else {
                    return redirect()->back()->withErrors('You are not authorized')->with('message', 'Wrong password, please make sure you enter your windows password..!')->with('class', 'alert-danger');
                }
            }

            if ($request->role == 'branch') {


                $Name = $validator['username'];
                $Password = $validator['password'];
                $protectedUser = strtoupper($Name);
                $user = Branch::whereRaw('Name= ? and Password = ?', [$protectedUser, $Password])->where('Active', 1)->first();

                if (!$user) {
                    return redirect()->back()->withErrors('You are not authorized')->with('message', 'You are not authorized')->with('class', 'alert-danger');
                }

                Session::put('userId', $user->Id);
                Session::put('userName', $user->Name);
                Session::put('BranchId', $user->BranchId);
                Session::put('BranchName', $user->branch->Name);
                Session::put('role', $request->role);
                Session::put('user', $user);
                return redirect()->route('branch.requests.statistics', $user->BranchId);
            }
        } catch
        (\Exception $ex) {
            DB::rollBack();
            return Redirect::back()->withErrors('You are not authorized.' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
        }


    }


    public
    function logout()
    {
        Session::forget('userId');
        Session::forget('userName');
        Session::forget('GroupId');
        Session::forget('user');
        Session::forget('role');
        Session::forget('BranchId');
        Session::forget('BranchName');

        return Redirect::to('/');
    }

    function checkActiveDirectory($username, $password)
    {

        return true;

//        $adServer = "LDAP://contactcntr.raya.corp";
//
//        $ldap = ldap_connect($adServer);
//
//        $ldaprdn = 'contactcntr' . "\\" . $username;
//
//        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
//        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
//
//        $bind = @ldap_bind($ldap, $ldaprdn, $password);
//
//        if ($bind) {
//            @ldap_close($ldap);
//            return true;
//        }
//        return false;
    }

}
