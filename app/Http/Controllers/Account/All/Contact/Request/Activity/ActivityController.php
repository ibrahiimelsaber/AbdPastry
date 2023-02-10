<?php

namespace App\Http\Controllers\Account\All\Contact\Request\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Contact;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use  App\Models\Request as SR;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{

    public function index($id)
    {

        $sr = SR::where('Id', '=', $id)->first();

        $activities = Activity::with('request', 'status', 'type', 'subType', 'focalStatus', 'branch', 'branch', 'statusBack')->where('SRId', '=', $id)->paginate(30);

        return view('accounts.all.contacts.requests.activities.index')
            ->with('sr', $sr)
            ->with('activities', $activities)
            ->with('total', $activities->total())
            ->with('indexUrl', route('all.account.contact.request.activities.index', $id));
    }


    public function create($id)
    {
        $sr = SR::where('Id', '=', $id)->first();

        $activityCallStatus = DB::table('picklists')
            ->where('Type', '=', 'CallStatus2')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activityCallBackStatus = DB::table('picklists')
            ->where('Type', '=', 'CallBackStatus')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activityTypes = DB::table('picklists')
            ->where('Type', '=', 'ActType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activitySubTypes = DB::table('picklists')
            ->where('Type', '=', 'ActSubType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $branches = DB::table('picklists')
            ->where('Active', '=', '1')
            ->where('Type', '=', 'Branch')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activityFocalPointBranchStatus = DB::table('picklists')
            ->where('Type', '=', 'FocalPointBranchStatus')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');


        return view('accounts.all.contacts.requests.activities.create')
            ->with('sr', $sr)
            ->with('activityCallStatus', $activityCallStatus)
            ->with('activityCallBackStatus', $activityCallBackStatus)
            ->with('activityTypes', $activityTypes)
            ->with('activitySubTypes', $activitySubTypes)
            ->with('branches', $branches)
            ->with('activityFocalPointBranchStatus', $activityFocalPointBranchStatus);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'SRId' => 'required',
                'ActTypeId' => 'sometimes',
                'ContactTrial' => 'sometimes',
                'ActSubTypeId' => 'sometimes',
                'CallStatusId' => 'sometimes',
                'CallBackStatusId' => 'sometimes',
                'BranchId' => 'sometimes',
                'FocalPointBranchStatusId' => 'sometimes',
                'CustomerActivityComments' => 'sometimes',
                'CustomerActivityAgentComments' => 'sometimes',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('activities')->insert(
                [
                    'SRId' => $request->SRId,
                    'ActTypeId' => $request->ActTypeId,
                    'ActSubTypeId' => $request->ActSubTypeId,
                    'CallStatusId' => $request->CallStatusId,
                    'CallBackStatusId' => $request->CallBackStatusId,
                    'BranchId' => $request->BranchId ?? 0,
                    'ContactTrial' => $request->ContactTrial ?? 0,
                    'FocalPointBranchStatusId' => $request->FocalPointBranchStatusId ?? 0,
                    'CustomerActivityComments' => $request->CustomerActivityComments,
                    'CustomerActivityAgentComments' => $request->CustomerActivityAgentComments,
                    'Active' => 1,
                    'FocalPoint' =>0,
                    'Alarm' =>0,
                    'CreatedBy' => \session('userName'),
                    'Created' => now()

                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Activity is created successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return Redirect::back()->withErrors('Creation field failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
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
        //
    }


    public function edit($id)
    {

        $activity = Activity::with('request', 'status', 'type', 'subType', 'focalStatus', 'branch', 'branch', 'statusBack')->where('Id',$id)->first();

        $activityCallStatus = DB::table('picklists')
            ->where('Type', '=', 'CallStatus2')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activityCallBackStatus = DB::table('picklists')
            ->where('Type', '=', 'CallBackStatus')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activityTypes = DB::table('picklists')
            ->where('Type', '=', 'ActType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activitySubTypes = DB::table('picklists')
            ->where('Type', '=', 'ActSubType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $branches = DB::table('picklists')
            ->where('Active', '=', '1')
            ->where('Type', '=', 'Branch')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $activityFocalPointBranchStatus = DB::table('picklists')
            ->where('Type', '=', 'FocalPointBranchStatus')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');


        return view('accounts.all.contacts.requests.activities.edit')
            ->with('activity', $activity)
            ->with('activityCallStatus', $activityCallStatus)
            ->with('activityCallBackStatus', $activityCallBackStatus)
            ->with('activityTypes', $activityTypes)
            ->with('activitySubTypes', $activitySubTypes)
            ->with('branches', $branches)
            ->with('activityFocalPointBranchStatus', $activityFocalPointBranchStatus);

    }



    public function update(Request $request,$id)
    {

        try {
            DB::beginTransaction();
            $rules = [
                'ActTypeId' => 'sometimes',
                'ActSubTypeId' => 'sometimes',
                'CallStatusId' => 'sometimes',
                'ContactTrial' => 'sometimes',
                'CallBackStatusId' => 'sometimes',
                'BranchId' => 'sometimes',
                'FocalPointBranchStatusId' => 'sometimes',
                'CustomerActivityComments' => 'sometimes',
                'CustomerActivityAgentComments' => 'sometimes',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            DB::table('activities')->where('Id',$id)->update(
                [
                    'ActTypeId' => $request->ActTypeId,
                    'ActSubTypeId' => $request->ActSubTypeId,
                    'CallStatusId' => $request->CallStatusId,
                    'CallBackStatusId' => $request->CallBackStatusId,
                    'BranchId' => $request->BranchId ?? 0,
                    'FocalPointBranchStatusId' => $request->FocalPointBranchStatusId ?? 0,
                    'CustomerActivityComments' => $request->CustomerActivityComments,
                    'CustomerActivityAgentComments' => $request->CustomerActivityAgentComments,
                    'ContactTrial' => $request->ContactTrial ?? 0,
                    'FocalPoint' =>0,
                    'Alarm' =>0,
                    'Active' => 1,
                    'ModifiedBy' => \session('userName'),
                    'Modified' => now()

                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Activity is created successfully')->with('class', 'alert-success');

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
}
