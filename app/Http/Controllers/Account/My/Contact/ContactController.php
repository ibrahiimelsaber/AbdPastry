<?php

namespace App\Http\Controllers\Account\My\Contact;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function index($id)
    {

        $contacts = DB::table('contacts')
            ->where('AccountId', '=', $id)
            ->selectRaw('distinct contacts.*')
            ->orderBy('contacts.CreatedOn', 'desc')
            ->paginate(20);


        return view('accounts.my.contacts.index')
            ->with('contacts', $contacts)
            ->with('account', $id)
            ->with('total', $contacts->total())
            ->with('indexUrl', route('my.account.contacts.index',$id));
    }

    public function dashboard()
    {
        return view('pages.user-profile');
    }


    public function create(Request $request, $id)
    {


        $account = Account::with('Type')->where('Id', $id)->first();
        $accountTypes = DB::table('picklists')
            ->where('Type', '=', 'AccountType')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $gender = DB::table('picklists')
            ->where('Type', '=', 'Gender')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');
        $titles = DB::table('picklists')
            ->where('Type', '=', 'Title')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');

        return view('accounts.my.contacts.create')
            ->with('phoneTypes', $phoneTypes)
            ->with('accountTypes', $accountTypes)
            ->with('gender', $gender)
            ->with('titles', $titles)
            ->with('account', $account);
    }


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $rules = [
                'Name' => 'required|string',
                'accountId' => 'required',
                'PhoneTypeId' => 'required',
                'PhoneNumber' => 'sometimes',
//                'PhoneNumber' => 'required|min:10|unique:accounts,PhoneNumber',
                'GenderId' => 'sometimes',
                'AgeId' => 'sometimes',
                'TitleId' => 'sometimes',
                'JobTitle' => 'sometimes',
                'Email' => 'sometimes',
                'Comments' => 'sometimes',

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            $contact = DB::table('contacts')->insert(
                [
                    'Name' => $request->Name,
                    'AgeId' => $request->AgeId,
                    'AccountId' => $request->accountId,
                    'PhoneTypeId' => $request->PhoneTypeId,
                    'PhoneNumber' => $request->PhoneNumber,
                    'TitleId' => $request->TitleId,
                    'JobTitle' => $request->JobTitle,
                    'GenderId' => $request->GenderId,
                    'Active' => 1,
                    'Comments' => $request->Comments ?? '',
                    'CreatedBy' => \session('userName'),
                    'CreatedOn' => now()
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Contact is created successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return Redirect::back()->withErrors('Creation field failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
        }

    }


    public function show($id)
    {

        $contacts = DB::table('contacts')
            ->where('accountId', '=', $id)
            ->selectRaw('distinct contacts.*')
            ->orderBy('contacts.CreatedOn', 'desc')
            ->paginate(20);

        return view('my.accounts.contacts.index')
            ->with('contacts', $contacts)
            ->with('accountId', $id)
            ->with('total', $contacts->total())
            ->with('indexUrl', route('my.accounts.contacts.show', $id));
    }


    public function edit($id)
    {
        $contact = Contact::with('account', 'gender', 'phoneType')->where('Id', $id)->first();
        $accountTypes = DB::table('picklists')
            ->where('Type', '=', 'AccountType')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');
        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $gender = DB::table('picklists')
            ->where('Type', '=', 'Gender')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $titles = DB::table('picklists')
            ->where('Type', '=', 'Title')
             ->where('Active', '=', '1')
            ->pluck('name', 'id');


        return view('accounts.my.contacts.edit')
            ->with('contact', $contact)
            ->with('accountTypes', $accountTypes)
            ->with('phoneTypes', $phoneTypes)
            ->with('gender', $gender)
            ->with('titles', $titles);

    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'Name' => 'required|string',
                'PhoneTypeId' => 'sometimes',
                'PhoneNumber' => 'sometimes',
//                'PhoneNumber' => 'required|min:10|unique:accounts,PhoneNumber',
                'GenderId' => 'sometimes',
                'AgeId' => 'sometimes',
                'TitleId' => 'sometimes',
                'JobTitle' => 'sometimes',
                'Email' => 'sometimes',
                'Comments' => 'sometimes',

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


              DB::table('contacts')->where('id', $id)->update(
                [
                    'Name' => $request->Name,
                    'PhoneTypeId' => $request->PhoneTypeId ?? 0,
                    'PhoneNumber' => $request->PhoneNumber ?? 0,
                    'GenderId' => $request->GenderId ?? 0,
                    'Comments' => $request->Comments ?? 0,
                    'TitleId' => $request->TitleId ?? 0,
                    'AgeId' => $request->AgeId ?? 0,
                    'Email' => $request->Email ?? 0,
                    'JobTitle' => $request->JobTitle ?? 0,
                    'ModifiedOn' => now(),
                    'ModifiedBy' => session('userName'),
                ]);
            DB::commit();
            return redirect()->back()->with('message', 'Contact is updated successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            return Redirect::to(route('my.account.contacts.edit', $id))->withErrors('Update failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
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
