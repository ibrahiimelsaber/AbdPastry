<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use  App\Models\Request as SR;
use Illuminate\Support\Facades\DB;

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
        //TODO Create Service Request Store IN DB HAHA
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
