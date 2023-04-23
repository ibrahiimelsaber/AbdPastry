<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{

    public function index()
    {
//        $agents = Agent::where('id', 5)->first();
//        dd($agents->path);
        $agents = Agent::orderBy('Id')->paginate(10);

        return view('agents.index')
            ->with('agents', $agents)
            ->with('total', $agents->total())
            ->with('indexUrl', route('agents.index'));
    }


    public function create()
    {
        return view('agents.create');
    }


    public function store(Request $request)
    {

        try {

            $rules = [
                'username' => 'required',
                'percentage' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }

            // process image
            $file_extension = $request->file('image')->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/agents';
            $db_path = $request->file('image')->move($path, $file_name);


            DB::beginTransaction();

            DB::table('agents')->insert(
                [
                    'username' => $request->username,
                    'percentage' => $request->percentage,
                    'name' => $file_name,
                    'path' => $db_path,
                    'created_by' => session('userName'),
                    'created_at' => now(),
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Agent is created successfully')->with('class', 'alert-success');

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
        $user = DB::table('agents')->where('Id', $id)->first();
        return view('agents.edit')->with('user', $user);
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


            DB::table('agents')->where('Id', $id)->update(
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
        $user = DB::table('agents')->where('Id', $id)->update(['Active' => 0]);
        return redirect()->back()->with('message', 'User is deactivated successfully')->with('class', 'alert-success');
    }

    public function activate($id)
    {
        $user = DB::table('agents')->where('Id', $id)->update(['Active' => 1]);
        return redirect()->back()->with('message', 'User is activated successfully')->with('class', 'alert-success');
    }
}
