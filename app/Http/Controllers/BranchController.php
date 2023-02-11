<?php

namespace App\Http\Controllers;

use App\Models\Picklist;
use App\Models\userLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{

    public function index()
    {
        $branches = Picklist::where('Type','=','Branch')->orderBy('Id')->paginate(20);

        return view('branches.index')
            ->with('branches', $branches)
            ->with('total', $branches->total())
            ->with('indexUrl', route('branches.index'));
    }


    public function create()
    {
        return view('branches.create');
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'Name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('picklists')->insert(
                [
                    'Type' => 'Branch',
                    'Name' => $request->Name,
                    'ParentId' => 0,
                    'Active' => 1
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Branch is created successfully')->with('class', 'alert-success');

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
        $branch = DB::table('picklists')->where('Id',$id)->first();
        return view('branches.edit')->with('branch',$branch);
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'Name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('picklists')->where('Id',$id)->update(
                [
                    'Name' => $request->Name,
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Branch is update successfully')->with('class', 'alert-success');

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
       DB::table('picklists')->where('Id',$id)->update(['Active'=> 0]);
        return redirect()->back()->with('message', 'Branch is deactivated successfully')->with('class', 'alert-success');
    }
    public function activate($id)
    {
        $branch = DB::table('picklists')->where('Id',$id)->update(['Active' => 1]);
        return redirect()->back()->with('message', 'Branch is activated successfully')->with('class', 'alert-success');
    }
}
