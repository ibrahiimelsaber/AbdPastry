<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function getSRSubTypes($id)
    {
        $subTypes = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->pluck('name', 'id');

        return response()->json($subTypes);
    }

    public function getAreas($id)
    {
        $areas = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->pluck('name', 'id');

        return response()->json($areas);
    }

    public function getSRProductsSubTypes($id)
    {
        $subTypes = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->pluck('name', 'id');

        return response()->json($subTypes);
    }
    public function getSRSubSubTypes($id)
    {
        $subsubTypes = DB::table('picklists')
            ->where('ParentId', '=', $id)
            ->pluck('name', 'id');

        return response()->json($subsubTypes);
    }

}
