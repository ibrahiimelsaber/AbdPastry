<?php

namespace App\Http\Controllers;

use App\Models\Request as SR;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function getSRSubTypes($id)
    {

        $subTypes = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->where('Active','=',1)
            ->pluck('name', 'id');

        return response()->json($subTypes);
    }

    public function getAreas($id)
    {
        $areas = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->where('Active','=',1)
            ->pluck('name', 'id');

        return response()->json($areas);
    }

    public function getSRProductsSubTypes($id)
    {
        $subTypes = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->where('Active','=',1)
            ->pluck('name', 'id');

        return response()->json($subTypes);
    }
    public function getSRSubSubTypes($id)
    {
        $subsubTypes = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->where('Active','=',1)
            ->pluck('name', 'id');

        return response()->json($subsubTypes);
    }

    public function statistics()
    {

        $generalInquiry = SR::where('TypeId','=',846)->count();
        $complaints = SR::where('TypeId','=',848)->count();
        $orderTaking = SR::where('TypeId','=',847)->count();
        $faceBookInquiry = SR::where('TypeId','=',850)->count();
        $faceBookComplaints = SR::where('TypeId','=',851)->count();
        $wrongNumber = SR::where('TypeId','=',849)->count();
        $srCounts = SR::count();

        $deliveryDamage = SR::where('SubTypeId','=',789)->count();
        $productQuality = SR::where('SubTypeId','=',794)->count();
        $staffAttitude = SR::where('SubTypeId','=',790)->count();
        $delayedOrder = SR::where('SubTypeId','=',1805)->count();
        $billMistakes = SR::where('SubTypeId','=',792)->count();
        $foodSafety = SR::where('SubTypeId','=',1823)->count();
        $visaIssues = SR::where('SubTypeId','=',1807)->count();
        $foodPoising = SR::where('SubTypeId','=',802)->count();
        $missingProducts = SR::where('SubTypeId','=',798)->count();
        $branchComplaints = SR::where('SubTypeId','=',800)->count();


        return view('statistics.index')
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

}
