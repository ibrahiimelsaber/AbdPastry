<?php

namespace App\Http\Controllers\Account\All\Surveys;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Models\EedSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class EedSurveyController extends Controller
{

    public function index($id)
    {

        $surveys = EedSurvey::with('account','callStatus')->where('AccountId', '=', $id)->orderBy('createdOn', 'desc')->paginate(20);

        return view('accounts.all.surveys.eed-surveys.index')
            ->with('surveys', $surveys)
            ->with('account', $id)
            ->with('total', $surveys->total())
            ->with('indexUrl', route('all.account.eed-surveys.index', $id));
    }
    public function all()
    {

        $surveys = EedSurvey::with('account','callStatus')->orderBy('createdOn', 'desc')->paginate(20);

        return view('surveys.all.eed-surveys.index')
            ->with('surveys', $surveys)
            ->with('total', $surveys->total())
            ->with('indexUrl', route('all.eed-surveys.index'));
    }



    public function create($id)
    {
        $account = Account::with('Type')->where('Id', $id)->first();
        $status = DB::table('picklists')
            ->where('Type', '=', 'EidCallStatus')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $EidQ1 = DB::table('picklists')
            ->where('Type', '=', 'eid_q1_id')->pluck('name', 'id');
        $EidQ2 = DB::table('picklists')
            ->where('Type', '=', 'eid_q2_id')->pluck('name', 'id');
        $EidQ3 = DB::table('picklists')
            ->where('Type', '=', 'eid_q3_id')->pluck('name', 'id');

        $EidQ3Sub = DB::table('picklists')
            ->where('Type', '=', 'eid_q3_sub_id')->pluck('name', 'id');
        $EidQ4 = DB::table('picklists')
            ->where('Type', '=', 'eid_q4_id')->pluck('name', 'id');
        $EidQ5 = DB::table('picklists')
            ->where('Type', '=', 'eid_q5_id')->pluck('name', 'id');
        $EidQ6 = DB::table('picklists')
            ->where('Type', '=', 'eid_q6_id')->pluck('name', 'id');
        $EidQ7 = DB::table('picklists')
            ->where('Type', '=', 'eid_q7_id')->pluck('name', 'id');


//dd($EidQ3);

        return view('accounts.all.surveys.eed-surveys.create')
            ->with('EidQ1', $EidQ1)
            ->with('EidQ2', $EidQ2)
            ->with('EidQ3', $EidQ3)
            ->with('EidQ3Sub', $EidQ3Sub)
            ->with('EidQ4', $EidQ4)
            ->with('EidQ5', $EidQ5)
            ->with('EidQ6', $EidQ6)
            ->with('EidQ7', $EidQ7)
            ->with('status', $status)
            ->with('account', $account);
    }


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $rules = [
                'EidCallStatusId' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('Eedsurvey')->insert(
                [
                    'AccountId' => $request->AccountId,
                    'EidCallStatusId' => $request->EidCallStatusId,
                    'Eid_q1ID' => $request->Eid_q1ID ?? 0,
                    'Eid_q2ID' => $request->Eid_q2ID ?? 0,
                    'Eid_q3ID' => $request->Eid_q3ID ?? 0,
                    'Eid_q4ID' => $request->Eid_q4ID ?? 0,
                    'Eid_q5ID' => $request->Eid_q5ID ?? 0,
                    'Eid_q6ID' => $request->Eid_q6ID ?? 0,
                    'Eid_q7ID' => $request->Eid_q7ID ?? 0,
                    'Eid_q1_comment' => $request->Eid_q1_comment ?? '-',
                    'Eid_q2_comment' => $request->Eid_q2_comment ?? '-',
                    'Eid_q3_comment' => $request->Eid_q3_comment ?? '-',
                    'Eid_q4_comment' => $request->Eid_q4_comment ?? '-',
                    'Eid_q5_comment' => $request->Eid_q5_comment ?? '-',
                    'Eid_q6_comment' => $request->Eid_q6_comment ?? '-',
                    'Eid_q7_comment' => $request->Eid_q7_comment ?? '-',
                    'Eid_q3_subID' => $request->Eid_q3_subID ?? 0,
                    'Eid_q6_subID' => $request->Eid_q6_subID ?? 0,
                    'Eid_q7_subID' => $request->Eid_q7_subID ?? 0,
                    'Active' => 1,
                    'createdBy' => \session('userName'),
                    'createdOn' => now()
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Survey is created successfully')->with('class', 'alert-success');

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
