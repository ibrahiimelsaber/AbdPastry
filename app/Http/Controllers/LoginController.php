<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\userLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'role' => ['required'],
        ]);

        if ($request->role == 'user') {

            try {

                $user = userLogin::whereRaw('UPPER(UserName)=UPPER("' . $credentials['username'] . '")')->first();
                if (!$user) {
                    return redirect()->back()->withErrors('You are not authorized')->with('message', 'You are not authorized')->with('class', 'alert-danger');
                }

//        if ($this->checkActiveDirectory($credentials->username, $credentials->password)) {
                if ($user->Username == "Ibrahim_MElsaber") {

                    Session::put('userId', $user->Id);
                    Session::put('userName', $user->Username);
                    Session::put('GroupId', $user->GroupId);
                    Session::put('role', $request->role);
                    Session::put('user', $user);
                    return redirect()->route('my.accounts.index');
                }
            } catch (\Exception $ex) {
                DB::rollBack();
                return Redirect::back()->withErrors('You are not authorized.' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
            }
        }
        if ($request->role == 'branch') {
            try {

                $Name = $credentials['username'];
                $Password = $credentials['password'];
                $user = Branch::whereRaw('Name= ? and Password = ?', [$Name, $Password])->first();

                if (!$user) {
                    return redirect()->back()->withErrors('You are not authorized')->with('message', 'You are not authorized')->with('class', 'alert-danger');
                }

                Session::put('userId', $user->Id);
                Session::put('userName', $user->Name);
                Session::put('BranchId', $user->BranchId);
                Session::put('BranchName', $user->branch->Name);
                Session::put('role', $request->role);
                Session::put('user', $user);
                return redirect()->route('branch.requests.statistics',$user->BranchId);
            } catch
            (\Exception $ex) {
                DB::rollBack();
                return Redirect::back()->withErrors('You are not authorized.' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
            }

        }

    }


    public function logout()
    {
        Session::forget('userId');
        Session::forget('userName');
        Session::forget('GroupId');
        Session::forget('user');
        Session::forget('role');
        Session::forget('BranchId');

        return Redirect::to('/');
    }
}
