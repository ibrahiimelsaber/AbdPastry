<?php

namespace App\Http\Controllers;

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

        return view('activities.index')
            ->with('sr', $sr)
            ->with('activities', $activities)
            ->with('total', $activities->total())
            ->with('indexUrl', route('accounts.contact.requests.activities', $id));
    }

    public function all()
    {

//        dd(\App\Models\Request::with('contact')->where('Id',582495)->first());
        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->orderBy('Created', 'desc')->paginate(30);
//        dd($requests);

        return view('requests.index')
            ->with('requests', $requests)
            ->with('total', $requests->total())
            ->with('indexUrl', route('all.requests'));
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


        return view('activities.create')
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
                    'FocalPointBranchStatusId' => $request->FocalPointBranchStatusId ?? 0,
                    'CustomerActivityComments' => $request->CustomerActivityComments,
                    'CustomerActivityAgentComments' => $request->CustomerActivityAgentComments,
                    'Active' => 1,
                    'CreatedBy' => \session('userName'),
                    'Created' => now()

                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Contact is created successfully')->with('class', 'alert-success');

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
        $sr = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('Id', '=', $id)->first();
        $status = DB::table('picklists')
            ->where('Type', '=', 'Status')
            ->pluck('name', 'id');

        $directions = DB::table('picklists')
            ->where('Type', '=', 'CallDirection')
            ->pluck('name', 'id');

        $srTypes = DB::table('picklists')
            ->where('Type', '=', 'Type')
            ->pluck('name', 'id');

        $complaintsTypes = DB::table('picklists')
            ->where('Type', '=', 'ComplaintType')
            ->pluck('name', 'id');

        $branches = DB::table('picklists')
            ->where('Type', '=', 'Branch')
            ->pluck('name', 'id');

        $products = DB::table('picklists')
            ->where('Type', '=', 'Product')
            ->pluck('name', 'id');


        return view('requests.edit')
            ->with('request', $sr)
            ->with('status', $status)
            ->with('directions', $directions)
            ->with('srTypes', $srTypes)
            ->with('branches', $branches)
            ->with('products', $products)
            ->with('complaintsTypes', $complaintsTypes);

    }

    public function history($id)
    {
        $requests = RequestHistory::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('SRID', '=', $id)->paginate(10);
        return view('requests.history.index')
            ->with('requests', $requests)
            ->with('total', $requests->total())
            ->with('indexUrl', route('request.history', $id));
    }

    public function update(Request $request)
    {


        try {
            DB::beginTransaction();
            $rules = [
                'sr_id' => 'required',
                'StatusId' => 'sometimes',
                'CallDirectionId' => 'sometimes',
                'ContactId' => 'sometimes',
                'TypeId' => 'required',
                'BranchId' => 'required',
                'SubTypeId' => 'sometimes',
                'SubSubType' => 'sometimes',
                'ProductId' => 'sometimes',
                'SubProductId' => 'sometimes',
                'ComplaintTypeId' => 'sometimes',
                'CustomerComments' => 'sometimes',
                'AgentComments' => 'sometimes',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            //facebook type id

            $today_date = date('l');

            if ($today_date == 'Thursday') {
                $NowDate = date('Y-m-d H:i:s');
                $timestamp = strtotime($NowDate) + 60 * 60 * 47;
                $DueDate = date('Y-m-d H:i:s', $timestamp);
            } else {
                $NowDate = date('Y-m-d H:i:s');
                $timestamp = strtotime($NowDate) + 60 * 60 * 47;
                $DueDate = date('Y-m-d H:i:s', $timestamp);
            }

            $sr = DB::table('service_requests')->where('id', $request->sr_id)->update(
                [
                    'StatusId' => $request->StatusId,
                    'CallDirectionId' => $request->CallDirectionId,
                    'ContactId' => $request->ContactId,
                    'TypeId' => $request->TypeId,
                    'BranchId' => $request->BranchId,
                    'SubTypeId' => $request->SubTypeId ?? 0,
                    'SubSubType' => $request->SubSubType ?? 0,
                    'ProductId' => $request->ProductId,
                    'SubProductId' => $request->SubProductId,
                    'ComplaintTypeId' => $request->ComplaintTypeId,
                    'DueDate' => $request->$DueDate,
                    'CustomerComments' => $request->CustomerComments ?? '',
                    'AgentComments' => $request->AgentComments ?? '',
                    'Active' => 1,
                    'Modified' => now(),
                    'ModifiedBy' => \session('userName')
                ]);


            DB::table('requests_history')->insert(
                [
                    'SRID' => $request->sr_id,
                    'StatusId' => $request->StatusId,
                    'CallDirectionId' => $request->CallDirectionId,
                    'ContactId' => $request->ContactId,
                    'TypeId' => $request->TypeId,
                    'BranchId' => $request->BranchId,
                    'SubTypeId' => $request->SubTypeId ?? 0,
                    'SubSubType' => $request->SubSubType ?? 0,
                    'ProductId' => $request->ProductId,
                    'SubProductId' => $request->SubProductId,
                    'ComplaintTypeId' => $request->ComplaintTypeId,
                    'DueDate' => $request->$DueDate,
                    'CustomerComments' => $request->CustomerComments ?? '',
                    'AgentComments' => $request->AgentComments ?? '',
                    'Active' => 1,
                    'Created' => now(),
                    'CreatedBy' => \session('userName')
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Service Request is updated successfully')->with('class', 'alert-success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return Redirect::back()->withErrors('Update field failed. ' . $ex->getMessage())->withInput($request->all())->with('message', $ex->getMessage())->with('class', 'alert-danger');
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
