@extends('layouts.dashboard-master')

@section('title','Manage My Service Requests')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage My Service Requests</h1>
            <h1 class="ml-2">||</h1>
    <a href="{{route("my.accounts.contacts.show",$contact->AccountId)}}" class="ml-2 btn btn-primary">Go To Contact</a>


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
                                <h4>My Service Requests <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                        <a href="{{route('accounts.contact.requests.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Service Request</a>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($requests)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Contact Name</th>
                                                <th>Request Id</th>
                                                <th>Request Type</th>
                                                <th>Request Sub Type</th>
                                                <th>Request Status</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($requests as $request)
                                                <tr>

                                                    <td>{{ optional($request->contact)->Name }}</td>
                                                    <td>{{ $request->Id }}</td>
                                                    <td>{{ optional($request->type)->Name }}</td>
                                                    <td>{{ optional($request->subType)->Name }}</td>
                                                    <td>{{ optional($request->status)->Name }}</td>
                                                    <td>{{ $request->Created }}</td>
                                                    <td>{{ $request->CreatedBy }}</td>

                                                    <td>

                                                            <a href="{{route('my.accounts.edit',$request->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"> Update SR</i>
                                                            </a>

                                                            <a href="{{route('my.accounts.contacts.show',$request->Id)}}"
                                                               class="btn btn-warning"><i class="fa fa-eye"> Activites</i>
                                                            </a>

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

{{--@section('scripts')--}}
{{--    @include('dashboard.common._modal_delete')--}}
{{--@endsection--}}
