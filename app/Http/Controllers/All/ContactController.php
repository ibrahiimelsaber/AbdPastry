<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = DB::table('contacts')
            ->selectRaw('distinct contacts.*')
            ->orderBy('contacts.CreatedOn', 'desc')
            ->paginate(20);


        return view('All.contacts.index')
            ->with('contacts', $contacts)
            ->with('total', $contacts->total())
            ->with('indexUrl', route('all.accounts.contacts'));
    }

    public function dashboard()
    {
        return view('pages.user-profile');
    }

    public function create($id)
    {

        $account = Account::with('Type')->where('Id', $id)->first();
        $accountTypes = DB::table('picklists')
            ->where('Type', '=', 'AccountType')
            ->pluck('name', 'id');

        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
            ->pluck('name', 'id');

        $gender = DB::table('picklists')
            ->where('Type', '=', 'Gender')
            ->pluck('name', 'id');
        $titles = DB::table('picklists')
            ->where('Type', '=', 'Title')
            ->pluck('name', 'id');

        return view('all.accounts.contacts.create')
            ->with('phoneTypes', $phoneTypes)
            ->with('accountTypes', $accountTypes)
            ->with('gender', $gender)
            ->with('accountId', $id)
            ->with('titles', $titles)
            ->with('account', $account);
    }


    public function store(Request $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            $rules = [
                'accountId' => 'required',
                'Name' => 'required|string',
                'PhoneTypeId' => 'required',
                'PhoneNumber' => 'required|min:10',
//                'PhoneNumber' => 'required|min:10|unique:accounts,PhoneNumber',
                'GenderId' => 'required',
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

            return redirect()->to(route('all.accounts.contacts.show',$request->accountId))->with('message', 'Contact is created successfully')->with('class', 'alert-success');

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


        return view('All.accounts.contacts.index')
            ->with('contacts', $contacts)
            ->with('accountId', $id)
            ->with('total', $contacts->total())
            ->with('indexUrl', route('all.accounts.contacts.show', $id));
    }


    public function edit($id)
    {
        $contact = Contact::with('account', 'gender', 'phoneType')->where('Id', $id)->first();
        $accountTypes = DB::table('picklists')
            ->where('Type', '=', 'AccountType')
            ->pluck('name', 'id');
        $phoneTypes = DB::table('picklists')
            ->where('Type', '=', 'PhoneType')
            ->pluck('name', 'id');

        $gender = DB::table('picklists')
            ->where('Type', '=', 'Gender')
            ->pluck('name', 'id');

        $titles = DB::table('picklists')
            ->where('Type', '=', 'Title')
            ->pluck('name', 'id');


        return view('All.accounts.contacts.edit')
            ->with('contact', $contact)
            ->with('accountTypes', $accountTypes)
            ->with('phoneTypes', $phoneTypes)
            ->with('gender', $gender)
            ->with('titles', $titles);

    }


    public function update(Request $request, $id)
    {
        $contact = DB::table('contacts')
            ->where('Id', '=', $id)
            ->first();
        $accountId = $contact->AccountId;

        $inputs = [];
        try {
            if (isset($request->Name)) {
                $inputs['Name'] = $request->Name;
            } else {
                $inputs['Name'] = $contact->Name;
            }
            if (isset($request->PhoneTypeId)) {
                $inputs['PhoneTypeId'] = $request->PhoneTypeId;
            } else {
                $inputs['PhoneTypeId'] = $contact->PhoneTypeId;
            }
            if (isset($request->PhoneNumber)) {
                $inputs['PhoneNumber'] = $request->PhoneNumber;
            } else {
                $inputs['PhoneNumber'] = $contact->PhoneNumber;
            }
            if (isset($request->GenderId)) {
                $inputs['GenderId'] = $request->GenderId;
            } else {
                $inputs['GenderId'] = $contact->GenderId;
            }
            if (isset($request->AgeId)) {
                $inputs['AgeId'] = $request->AgeId;
            } else {
                $inputs['AgeId'] = $contact->AgeId;
            }
            if (isset($request->TitleId)) {
                $inputs['TitleId'] = $request->TitleId;

            } else {
                $inputs['TitleId'] = $contact->TitleId;
            }

            if (isset($request->JobTitle)) {
                $inputs['JobTitle'] = $request->JobTitle;

            } else {
                $inputs['JobTitle'] = $contact->JobTitle;
            }
            if (isset($request->Email)) {
                $inputs['Email'] = $request->Email;

            } else {
                $inputs['Email'] = $contact->Email;
            }
            if (isset($request->Comments)) {
                $inputs['Comments'] = $request->Comments;

            } else {
                $inputs['Comments'] = $contact->Comments;
            }


            DB::table('contacts')->where('id', $id)->update(
                [
                    'Name' => $inputs['Name'],
                    'PhoneTypeId' => $inputs['PhoneTypeId'],
                    'PhoneNumber' => $inputs['PhoneNumber'],
                    'GenderId' => $inputs['GenderId'],
                    'Comments' => $inputs['Comments'],
                    'TitleId' => $inputs['TitleId'],
                    'AgeId' => $inputs['AgeId'],
                    'Email' => $inputs['Email'],
                    'JobTitle' => $inputs['JobTitle'],
                    'ModifiedOn' => now(),
                    'ModifiedBy' => session('userName'),
                ]);

            return redirect()->to(route('all.accounts.contacts.show',$accountId))->with('message', 'Contact is updated successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            return Redirect::to(route('all.account.contacts.edit', $id))->withErrors('Update failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
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
