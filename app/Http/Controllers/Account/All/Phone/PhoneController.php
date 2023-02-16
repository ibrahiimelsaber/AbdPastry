<?php

namespace App\Http\Controllers\Account\All\Phone;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Models\EedSurvey;
use App\Models\Phone;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class PhoneController extends Controller
{

    public function index($id)
    {

        $phones = Phone::with('account','phoneType')->where('AccountId', '=', $id)->paginate(20);

        return view('accounts.all.phones.index')
            ->with('phones', $phones)
            ->with('account', $id)
            ->with('total', $phones->total())
            ->with('indexUrl', route('all.account.phones.index', $id));
    }




    public function create($id)
    {
        $account = Account::with('Type')->where('Id', $id)->first();

        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');


        return view('accounts.all.phones.create')
            ->with('phoneTypes', $phoneTypes)
            ->with('account', $account);
    }


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $rules = [
                'AccountId' => 'required',
                'TypeId' => 'required',
                'Phone' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('account_phones')->insert(
                [
                    'AccountId' => $request->AccountId,
                    'TypeId' => $request->TypeId,
                    'Phone' => $request->Phone,
                    'Active' => 1,

                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Phone is created successfully')->with('class', 'alert-success');

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
        $phone = Phone::with('account','phoneType')->where('Id', $id)->first();

        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');


        return view('accounts.all.phones.edit')
            ->with('phoneTypes', $phoneTypes)
            ->with('phone', $phone);

    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'TypeId' => 'required',
                'Phone' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('account_phones')->where('Id','=',$id)->update(
                [
                    'TypeId' => $request->TypeId,
                    'Phone' => $request->Phone
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Phone is updated successfully')->with('class', 'alert-success');

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
        DB::table('account_phones')->where('Id',$id)->update(['Active'=> 0]);
        return redirect()->back()->with('message', 'Phone is deactivated successfully')->with('class', 'alert-success');
    }
    public function activate($id)
    {
        $branch = DB::table('account_phones')->where('Id',$id)->update(['Active' => 1]);
        return redirect()->back()->with('message', 'Phone is activated successfully')->with('class', 'alert-success');
    }
}
