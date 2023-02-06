<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use  App\Models\Request as SR;
use  App\Models\RequestHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{

    public function index($id)
    {
        $contact = Contact::where('Id', '=', $id)->first();
        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('ContactId', '=', $id)->paginate(10);
        return view('requests.index')
            ->with('requests', $requests)
            ->with('contact', $contact)
            ->with('total', $requests->total())
            ->with('indexUrl', route('my.accounts.contact.requests', $id));
    }






    public function create($id)
    {
        $contact = Contact::where('Id', '=', $id)->first();

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




        return view('requests.create')
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

             DB::table('service_requests')->insert(
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
                    'Created' => now(),
                    'ModifiedBy' => now()
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
