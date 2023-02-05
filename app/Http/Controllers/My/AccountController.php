<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function index()
    {
        $username = session('userName');

        $accounts = DB::table('accounts')
            ->leftJoin('picklists', 'accounts.AccountTypeId', '=', 'picklists.Id')
            ->whereRaw('accounts.Active')
            ->where('accounts.CreatedBy', '=', $username)
            ->selectRaw('distinct accounts.*, picklists.Name as accType')
            ->orderBy('accounts.CreatedOn', 'desc')
            ->paginate(10);


        return view('My.accounts.index')
            ->with('accounts', $accounts)
            ->with('total', $accounts->total())
            ->with('indexUrl', route('my.accounts'));
    }


    public function create()
    {

        $accountTypes = DB::table('picklists')
            ->where('Type', '=', 'AccountType')
            ->pluck('name', 'id');
        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
            ->pluck('name', 'id');

        $cities = DB::table('picklists')
            ->where('Type', '=', 'City')
            ->pluck('name', 'id');


        $gender = DB::table('picklists')
            ->where('Type', '=', 'Gender')
            ->pluck('name', 'id');
        $callSource = DB::table('picklists')
            ->where('Type', '=', 'callSource')
            ->pluck('name', 'id');

        return view('My.accounts.create')
            ->with('accountTypes', $accountTypes)
            ->with('phoneTypes', $phoneTypes)
            ->with('cities', $cities)
            ->with('gender', $gender)
            ->with('callSource', $callSource);

    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [];
            $rules = [
                'Name' => 'required|string',
                'AccountTypeId' => 'required',
                'PhoneTypeId' => 'required',
                'PhoneNumber' => 'required|min:10',
//                'PhoneNumber' => 'required|min:10|unique:accounts,PhoneNumber',
                'GenderId' => 'required',
                'CityId' => 'required',
                'AreaId' => 'required',
                'call_source' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::to(route('my.accounts.create'))
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('accounts')->insert(
                [
                    'Name' => $request->Name,
                    'AccountTypeId' => $request->AccountTypeId,
                    'PhoneTypeId' => $request->PhoneTypeId,
                    'PhoneNumber' => $request->PhoneNumber,
                    'GenderId' => $request->GenderId,
                    'Address' => $request->Address ?? '',
                    'CityId' => $request->CityId,
                    'AreaId' => $request->AreaId ?? 0,
                    'DistrictId' => $request->DistrictId ?? 0,
                    'Active' => 1,
                    'call_source' => $request->call_source,
                    'Comments' => $request->Comments ?? '',
                    'CreatedBy' => \session('userName'),
                    'CreatedOn' => now()
                ]);

            DB::commit();

            return redirect()->route('my.accounts')->with('message', 'Account is created successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return Redirect::to(route('my.accounts.create'))->withErrors('Creation field failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    public function edit($id)
    {
        $account = Account::with('area')->where('Id', $id)->first();
        $accountTypes = DB::table('picklists')
            ->where('Type', '=', 'AccountType')
            ->pluck('name', 'id');
        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
            ->pluck('name', 'id');

        $cities = DB::table('picklists')
            ->where('Type', '=', 'City')
            ->pluck('name', 'id');

        $districts = DB::table('picklists')
            ->where('Type', '=', 'Area')
            ->pluck('name', 'id');

        $gender = DB::table('picklists')
            ->where('Type', '=', 'Gender')
            ->pluck('name', 'id');
        $callSource = DB::table('picklists')
            ->where('Type', '=', 'callSource')
            ->pluck('name', 'id');

        return view('My.accounts.edit')
            ->with('account', $account)
            ->with('accountTypes', $accountTypes)
            ->with('phoneTypes', $phoneTypes)
            ->with('cities', $cities)
            ->with('districts', $districts)
            ->with('gender', $gender)
            ->with('callSource', $callSource);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'Name' => 'required|string',
            'AccountTypeId' => 'required',
            'PhoneTypeId' => 'required',
            'PhoneNumber' => 'required|min:10',
//                'PhoneNumber' => 'required|min:10|unique:accounts,PhoneNumber',
            'GenderId' => 'required',
            'CityId' => 'required',
            'DistrictId' => 'sometimes',
            'AreaId' => 'sometimes',
            'call_source' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('my.accounts.edit', $id))
                ->withErrors($validator->errors())
                ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
        }

     

        $account = DB::table('accounts')
            ->where('Id', '=', $id)
            ->first();
        $inputs = [];
        try {
            if (isset($request->Name)) {
                $inputs['Name'] = $request->Name;
            } else {
                $inputs['Name'] = $account->Name;
            }
            if (isset($request->AccountTypeId)) {
                $inputs['AccountTypeId'] = $request->AccountTypeId;
            } else {
                $inputs['AccountTypeId'] = $account->AccountTypeId;
            }
            if (isset($request->PhoneTypeId)) {
                $inputs['PhoneTypeId'] = $request->PhoneTypeId;
            } else {
                $inputs['PhoneTypeId'] = $account->PhoneTypeId;
            }
            if (isset($request->PhoneNumber)) {
                $inputs['PhoneNumber'] = $request->PhoneNumber;
            } else {
                $inputs['PhoneNumber'] = $account->PhoneNumber;
            }
            if (isset($request->GenderId)) {
                $inputs['GenderId'] = $request->GenderId;
            } else {
                $inputs['GenderId'] = $account->GenderId;
            }
            if (isset($request->Address)) {
                $inputs['Address'] = $request->Address;
            } else {
                $inputs['Address'] = $account->Address;
            }
            if (isset($request->CityId)) {
                $inputs['CityId'] = $request->CityId;

            } else {
                $inputs['CityId'] = $account->CityId;
            }
            if (isset($request->AreaId)) {
                $inputs['AreaId'] = $request->AreaId;

            } else {
                $inputs['AreaId'] = $account->AreaId;
            }

            if (isset($request->DistrictId)) {
                $inputs['DistrictId'] = $request->DistrictId;

            } else {
                $inputs['DistrictId'] = $account->DistrictId;
            }


            if (isset($request->call_source)) {
                $inputs['call_source'] = $request->call_source;

            } else {
                $inputs['call_source'] = $account->call_source;
            }

            DB::table('accounts')->where('id', $id)->update(
                [
                    'Name' => $inputs['Name'],
                    'AccountTypeId' => $inputs['AccountTypeId'],
                    'PhoneTypeId' => $inputs['PhoneTypeId'],
                    'PhoneNumber' => $inputs['PhoneNumber'],
                    'GenderId' => $inputs['GenderId'],
                    'Address' => $inputs['Address'],
                    'CityId' => $inputs['CityId'],
                    'AreaId' => $inputs['AreaId'],
                    'call_source' => $inputs['call_source'],
                ]);

            return redirect()->back()->with('message', 'Account is updated successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            return Redirect::to(route('my.accounts.edit', $id))->withErrors('Update failed. ' . $ex->getMessage())->withInput($request->all());
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
}
