<?php

namespace App\Http\Controllers;

use App\Models\userLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $users = userLogin::orderBy('Id')->paginate(10);

        return view('users.index')
            ->with('users', $users)
            ->with('total', $users->total())
            ->with('indexUrl', route('users.index'));
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'Username' => 'required',
                'GroupId' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('users')->insert(
                [
                    'Username' => $request->Username,
                    'GroupId' => $request->GroupId,
                    'Active' => 1
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'User is created successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return Redirect::back()->withErrors('Creation field failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
        }
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $user = DB::table('users')->where('Id',$id)->first();
        return view('users.edit')->with('user',$user);
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'Username' => 'required',
                'GroupId' => 'required',
                'Active' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('users')->where('Id',$id)->update(
                [
                    'Username' => $request->Username,
                    'GroupId' => $request->GroupId,
                    'Active' => $request->Active
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'User is update successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return Redirect::back()->withErrors('Creation field failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deactivate($id)
    {
        $user = DB::table('users')->where('Id',$id)->update(['Active'=> 0]);
        return redirect()->back()->with('message', 'User is deactivated successfully')->with('class', 'alert-success');
    }
    public function activate($id)
    {
        $user = DB::table('users')->where('Id',$id)->update(['Active' => 1]);
        return redirect()->back()->with('message', 'User is activated successfully')->with('class', 'alert-success');
    }
}
