<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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
        try {
            // process image
//            $file_extension = $request->file('image')->getClientOriginalExtension();
//            $file_name = time() . '.' . $file_extension;
//            $path = 'images/agents';
//            $db_path = $request->file('image')->move($path, $file_name);


            $image = $request->file('image');
            $input['image'] = time() . '.' . $image->getClientOriginalExtension();
            $file_name = $input['image'];

            $destinationPath = '';
            $imgFile = Image::make($image);
            $imgFile->resize(255, 255)->save($destinationPath . '/' . $input['image']);
            $destinationPath = 'images/agents';
            $db_path = $image->move($destinationPath, $input['image']);


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
        $user = DB::table('agents')->where('id', $id)->first();

        return view('agents.edit')->with('user', $user);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'sometimes',
            'percentage' => 'sometimes',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator->errors())
                ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $input['image'] = time() . '.' . $image->getClientOriginalExtension();
            $file_name = $input['image'];


            $destinationPath = '';
            $imgFile = Image::make($image);
            $imgFile->resize(255, 255)->save($destinationPath . '/' . $input['image']);
            $destinationPath = 'images/agents';
            $db_path = $image->move($destinationPath, $input['image']);

        } else {
            $file_name = $request->old_name;
            $db_path = $request->old_path;
        }

        try {
            DB::beginTransaction();
            DB::table('agents')->where('id', $id)->update(
                [
                    'username' => $request->username,
                    'percentage' => $request->percentage,
                    'name' => $file_name,
                    'path' => $db_path,
                    'updated_by' => session('userName'),
                    'updated_at' => now(),
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Agent is update successfully')->with('class', 'alert-success');

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
        $user = DB::table('agents')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Agent is deleted successfully')->with('class', 'alert-success');
    }


}
