<?php

namespace App\Http\Controllers\Account\All\Contact\Request;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use  App\Models\Request as SR;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{

    public function index($id)
    {
        $contact = Contact::where('Id', $id)->first();
        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('ContactId', '=', $id)->paginate(30);
        return view('accounts.all.contacts.requests.index')
            ->with('account', $contact->AccountId)
            ->with('contact', $id)
            ->with('requests', $requests)
            ->with('total', $requests->total())
            ->with('indexUrl', route('all.account.contact.requests.index', $id));
    }

    public function all()
    {

        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->orderBy('Created', 'desc')->paginate(30);
        return view('requests.index')
            ->with('requests', $requests)
            ->with('total', $requests->total())
            ->with('indexUrl', route('all.requests'));
    }

    public function my()
    {

        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('CreatedBy', session('userName'))->orderBy('Created', 'desc')->paginate(30);
        return view('requests.index')
            ->with('requests', $requests)
            ->with('total', $requests->total())
            ->with('indexUrl', route('my.requests'));
    }


    public function create($id)
    {
        $contact = Contact::where('Id', '=', $id)->first();

        $status = DB::table('picklists')
            ->where('Type', '=', 'Status')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $directions = DB::table('picklists')
            ->where('Type', '=', 'CallDirection')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $srTypes = DB::table('picklists')
            ->where('Type', '=', 'Type')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $complaintsTypes = DB::table('picklists')
            ->where('Type', '=', 'ComplaintType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $branches = DB::table('picklists')
            ->where('Type', '=', 'Branch')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $products = DB::table('picklists')
            ->where('Type', '=', 'Product')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');


        return view('accounts.all.contacts.requests.create')
            ->with('contact', $contact)
            ->with('status', $status)
            ->with('directions', $directions)
            ->with('srTypes', $srTypes)
            ->with('branches', $branches)
            ->with('products', $products)
            ->with('complaintsTypes', $complaintsTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'StatusId' => 'required',
                'CallDirectionId' => 'required',
                'ContactId' => 'required',
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

            $SRID = DB::table('service_requests')->insertGetId(
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
                    'CreatedBy' => \session('userName'),
                    'ModifiedBy' => \session('userName'),
                    'Created' => now()
                ]);

            DB::commit();


//            EmailAfterInsert($SRID);
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
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $directions = DB::table('picklists')
            ->where('Type', '=', 'CallDirection')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $srTypes = DB::table('picklists')
            ->where('Type', '=', 'Type')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $complaintsTypes = DB::table('picklists')
            ->where('Type', '=', 'ComplaintType')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $branches = DB::table('picklists')
            ->where('Type', '=', 'Branch')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $products = DB::table('picklists')
            ->where('Type', '=', 'Product')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');


        return view('accounts.all.contacts.requests.edit')
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
        $sr = SR::where('Id', '=', $id)->first();
        return view('accounts.all.contacts.requests.history.index')
            ->with('contact', $sr->ContactId)
            ->with('requests', $requests)
            ->with('total', $requests->total())
            ->with('indexUrl', route('all.account.contact.request.history.index', $id));
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
                    'ModifiedBy' => session('userName')
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
                    'CreatedBy' => session('userName')
                ]);

            DB::commit();

//            EmailAfterUpdate($request->sr_id);

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
