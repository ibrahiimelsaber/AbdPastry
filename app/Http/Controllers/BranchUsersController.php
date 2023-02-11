<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Picklist;
use App\Models\userLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BranchUsersController extends Controller
{

    public function index()
    {
        $users = userLogin::orderBy('Id')->paginate(10);

        return view('branches.users.index')
            ->with('branches', $users)
            ->with('total', $users->total())
            ->with('indexUrl', route('users.index'));
    }

    public function branch($id)
    {
        $users = Branch::where('BranchId','=',$id)->paginate(20);
        $branch = DB::table('picklists')->where('Id',$id)->first();


        return view('branches.users.list')
            ->with('users', $users)
            ->with('branch', $branch)
            ->with('total', $users->total())
            ->with('indexUrl', route('branch.users.list', $id));
    }


    public function create($id)
    {
        $branch = DB::table('picklists')->where('Id',$id)->first();
        return view('branches.users.create')->with('branch',$branch);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'Name' => 'required|unique:branch_users|min:6',
                'Password' => 'required|min:8',
                'BranchId' => 'required',

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('branch_users')->insert(
                [
                    'Name' => $request->Name,
                    'BranchId' => $request->BranchId,
                    'Password' => $request->Password,
                    'Active' => 1,
                    'created_at' => now(),
                    'created_by' => session('userName'),

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

        $user = Branch::with('branch')->where('Id',$id)->first();

        return view('branches.users.edit')->with('user',$user);
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'Name' => 'required|unique:branch_users|min:6',
                'Password' => 'required|min:8',

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('branch_users')->where('Id',$id)->update(
                [
                    'Name' => $request->Name,
                    'Password' => $request->Password,
                    'updated_at' => now(),
                    'updated_by' => session('userName'),
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
        $user = DB::table('branch_users')->where('Id',$id)->update(['Active'=> 0]);
        return redirect()->back()->with('message', 'User is deactivated successfully')->with('class', 'alert-success');
    }
    public function activate($id)
    {
        $user = DB::table('branch_users')->where('Id',$id)->update(['Active' => 1]);
        return redirect()->back()->with('message', 'User is activated successfully')->with('class', 'alert-success');
    }
}
