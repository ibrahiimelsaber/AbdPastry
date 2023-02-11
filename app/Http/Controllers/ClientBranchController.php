<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Picklist;
use App\Models\Request as SR;
use App\Models\userLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClientBranchController extends Controller
{

    public function index($id)
    {
        $branch = DB::table('picklists')->where('Id', $id)->first();
//        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('Id', '=', 44286)->first();
//        dd($requests);
        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('BranchId', '=', $id)->orderBy('Id', 'desc')->paginate(30);
        $status = DB::table('picklists')
            ->where('Type', '=', 'Status')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $srTypes = DB::table('picklists')
            ->where('Type', '=', 'Type')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $products = DB::table('picklists')
            ->where('Type', '=', 'Product')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        return view('client.branches.index')
            ->with('branch', $branch)
            ->with('requests', $requests)
            ->with('searchStatus', $status)
            ->with('searchSrTypes', $srTypes)
            ->with('searchProducts', $products)
            ->with('total', $requests->total())
            ->with('indexUrl', route('branch.requests.index', $id));
    }


    public function search(Request $request)
    {

//        dd($request->all());
        $branch = DB::table('picklists')->where('Id', $request->BranchID)->first();
        $requests = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->Search($request->all())->paginate(20);

        $status = DB::table('picklists')
            ->where('Type', '=', 'Status')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $srTypes = DB::table('picklists')
            ->where('Type', '=', 'Type')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        $products = DB::table('picklists')
            ->where('Type', '=', 'Product')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        return view('client.branches.list')
            ->with('branch', $branch)
            ->with('requests', $requests)
            ->with('searchStatus', $status)
            ->with('searchSrTypes', $srTypes)
            ->with('searchProducts', $products)
            ->with('total', $requests->total())
            ->with('indexUrl', route('branch.requests.list'));
    }


    public function create($id)
    {

    }


    public function store(Request $request)
    {

    }


    public function statistics($id)
    {

        $generalInquiry = SR::where('BranchId','=',$id)->where('TypeId','=',846)->count();
        $complaints = SR::where('BranchId','=',$id)->where('TypeId','=',848)->count();
        $orderTaking = SR::where('BranchId','=',$id)->where('TypeId','=',847)->count();
        $faceBookInquiry = SR::where('BranchId','=',$id)->where('TypeId','=',850)->count();
        $faceBookComplaints = SR::where('BranchId','=',$id)->where('TypeId','=',851)->count();
        $wrongNumber = SR::where('BranchId','=',$id)->where('TypeId','=',849)->count();
        $srCounts = SR::where('BranchId','=',$id)->count();

        $deliveryDamage = SR::where('BranchId','=',$id)->where('SubTypeId','=',789)->count();
        $productQuality = SR::where('BranchId','=',$id)->where('SubTypeId','=',794)->count();
        $staffAttitude = SR::where('BranchId','=',$id)->where('SubTypeId','=',790)->count();
        $delayedOrder = SR::where('BranchId','=',$id)->where('SubTypeId','=',1805)->count();
        $billMistakes = SR::where('BranchId','=',$id)->where('SubTypeId','=',792)->count();
        $foodSafety = SR::where('BranchId','=',$id)->where('SubTypeId','=',1823)->count();
        $visaIssues = SR::where('BranchId','=',$id)->where('SubTypeId','=',1807)->count();
        $foodPoising = SR::where('BranchId','=',$id)->where('SubTypeId','=',802)->count();
        $missingProducts = SR::where('BranchId','=',$id)->where('SubTypeId','=',798)->count();
        $branchComplaints = SR::where('BranchId','=',$id)->where('SubTypeId','=',800)->count();


        return view('client.branches.statistics')
            ->with('generalInquiry',$generalInquiry)
            ->with('complaints',$complaints)
            ->with('orderTaking',$orderTaking)
            ->with('faceBookInquiry',$faceBookInquiry)
            ->with('faceBookComplaints',$faceBookComplaints)
            ->with('wrongNumber',$wrongNumber)
            ->with('srCounts',$srCounts)

            ->with('deliveryDamage',$deliveryDamage)
            ->with('branchComplaints',$branchComplaints)
            ->with('productQuality',$productQuality)
            ->with('staffAttitude',$staffAttitude)
            ->with('delayedOrder',$delayedOrder)
            ->with('billMistakes',$billMistakes)
            ->with('foodSafety',$foodSafety)
            ->with('visaIssues',$visaIssues)
            ->with('foodPoising',$foodPoising)
            ->with('missingProducts',$missingProducts)
            ;
    }


    public function show($id)
    {

    }


    public function edit($id)
    {

        $request = SR::with('status')->where('Id', '=', $id)->first();
        $status = DB::table('picklists')
            ->where('Type', '=', 'Status')
            ->where('Active', '=', '1')
            ->pluck('name', 'id');

        return view('client.branches.edit')->with('request', $request)
            ->with('status', $status);
    }


    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $rules = [
                'StatusId' => 'sometimes',
                'resolution' => 'sometimes',

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator->errors())
                    ->withInput($request->all())->with('message', $validator->errors())->with('class', 'alert-danger');
            }


            $sr = DB::table('service_requests')->where('id', $id)->update(
                [
                    'StatusId' => $request->StatusId,
                    'resolution' => $request->resolution,
                    'Modified' => now(),
                    'ModifiedBy' => session('userName')
                ]);

            DB::commit();

            return redirect()->back()->with('message', 'Service Request is update successfully')->with('class', 'alert-success');

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
        $user = DB::table('branch_users')->where('Id', $id)->update(['Active' => 0]);
        return redirect()->back()->with('message', 'User is deactivated successfully')->with('class', 'alert-success');
    }

    public function activate($id)
    {
        $user = DB::table('branch_users')->where('Id', $id)->update(['Active' => 1]);
        return redirect()->back()->with('message', 'User is activated successfully')->with('class', 'alert-success');
    }
}
