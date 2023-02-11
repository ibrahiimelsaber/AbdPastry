@extends('layouts.dashboard-master')

@section('title','Manage Branch Service Requests')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage Branch Service Requests</h1>
            <h1 class="ml-2">||</h1>
{{--    <button class="ml-2 btn btn-primary" onclick="history.back()">Return Back</button>--}}
    <button class="ml-2 btn btn-outline-light" onclick="window.location.reload()"> Reload Page</button>
{{--    <button class="btn btn-primary ml-2" id="modal-search">Search</button>--}}
{{--            <button class="btn btn-info delete ml-2"--}}
{{--                     type="button">--}}
{{--                Search--}}
{{--            </button>--}}
            <form class="modal-part" id="modal-login-part" action="{{route("branch.search")}}">
                <p>Choose Search Credentials</p>

                <input name="BranchId" value="{{session('BranchId')}}" hidden>
                <div class="form-group">
                    <label>Type</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <select class="form-control @error('TypeId') is-invalid @enderror"
                                name="TypeId" id="TypeId">
                            <option
                                value="0">Choose Type</option>
                            @foreach($searchSrTypes as $id => $value)
                                <option
                                    value="{{$id}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-charging-station"></i>
                            </div>
                        </div>
                        <select class="form-control @error('StatusId') is-invalid @enderror"
                                name="StatusId" id="StatusId">
                            <option
                                value="">All</option>
                            @foreach($searchStatus as $id => $value)
                                <option
                                    value="{{$id}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>From</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <input type="date" class="form-control" placeholder="From Date" name="from">
                    </div>
                </div>
                <div class="form-group">
                    <label>To</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <input type="date" class="form-control" placeholder="To Date" name="to">
                    </div>
                </div>
            </form>

            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4> Service Requests <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    <button class="btn btn-primary" id="modal-search">Search For Request</button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($requests)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>

                                                <th>Contact Name</th>
                                                <th>Branch Name</th>
                                                <th>Request Id</th>
                                                <th>Status</th>
                                                <th>Type</th>
                                                <th>Sub Type</th>
{{--                                                <th>Sub Sub Type</th>--}}
                                                <th>Complaint Type</th>
                                                <th>Product</th>
                                                <th>Sub Product</th>
                                                <th>Customer Comments</th>
                                                <th>Agent Comments</th>
                                                <th>Resolution</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($requests as $request)
                                                <tr>
                                                    <td>{{ optional($request->contact)->Name }}</td>
                                                    <td class="font-weight-bolder">{{ optional($request->branch)->Name }}</td>
                                                    <td>{{ $request->Id }}</td>
                                                    <td class="font-weight-bolder">{{ optional($request->status)->Name }}</td>
                                                    <td>{{ optional($request->type)->Name }}</td>
                                                    <td>{{ optional($request->subType)->Name }}</td>
{{--                                                    <td>{{ optional($request->subSubType)->Name }}</td>--}}
                                                    <td>{{ optional($request->complaintType)->Name }}</td>
                                                    <td>{{ optional($request->product)->Name }}</td>
                                                    <td>{{ optional($request->subProduct)->Name }}</td>
                                                    <td>{{ $request->CustomerComments }}</td>
                                                    <td>{{ $request->AgentComments }}</td>
                                                    <td class="font-weight-bolder">{{ $request->resolution }}</td>
                                                    <td>{{ $request->Created }}</td>
                                                    <td>{{ $request->CreatedBy }}</td>

                                                    <td>

                                                            <a href="{{route('branch.requests.edit',$request->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"> Resolution</i>
                                                            </a>
{{--                                                        <button class="btn btn-danger delete"--}}
{{--                                                                data-id="{{$request->Id}}" type="button">--}}
{{--                                                            <i class="fa fa-trash"></i>--}}
{{--                                                        </button>--}}

{{--                                                            <a href="{{route('request.history',$request->Id)}}"--}}
{{--                                                               class="btn btn-info"><i class="fa fa-history"> History</i>--}}
{{--                                                                </a>--}}


{{--                                                            <a href="{{route('accounts.contact.requests.activities',$request->Id)}}"--}}
{{--                                                               class="btn btn-warning"><i class="fa fa-eye"> Activities</i>--}}
{{--                                                            </a>--}}
{{--                                        <a href="{{route('accounts.contact.requests.create',optional($request->contact)->Id)}}" class="btn btn-success"><i class="fas fa-plus"></i> Add New SR</a>--}}

                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any users yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($requests)>0)
                            <div class="text-center">
                                {{ $requests->links() }}
{{--                                 {{ $requests->appends(Request::except('page'))->links() }}--}}
                            </div>
                        @endif
                    </div>
                </div>

        </div>
    </section>

@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
{{--    @include('dashboard.common._modal_delete')--}}


    @include('dashboard.common._modal_search')

@endsection
