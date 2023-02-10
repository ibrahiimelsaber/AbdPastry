@extends('layouts.dashboard-master')

@section('title','Manage Service Requests History')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage Request History</h1>
            <h1 class="ml-2">||</h1>
   <a href="{{route('my.account.contact.requests.index',$contact)}}"
               class="ml-2 btn btn-primary">Return Back</a>


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
                                <h4> Service Request History <span>({{ $total }})</span></h4>
                                <div class="card-header-action">

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($requests)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>

                                                <th>Update Num#</th>
                                                <th>Contact Name</th>
                                                <th>Request Id</th>
                                                <th>Request Type</th>
                                                <th>Request Sub Type</th>
                                                <th>Request Status</th>
                                                <th>Customer Comments</th>
                                                <th>Agent Comments</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($requests as $request)
                                                <tr>

                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{ optional($request->contact)->Name }}</td>
                                                    <td>{{ $request->Id }}</td>
                                                    <td>{{ optional($request->type)->Name }}</td>
                                                    <td>{{ optional($request->subType)->Name }}</td>
                                                    <td>{{ optional($request->status)->Name }}</td>
                                                    <td>{{ $request->CustomerComments }}</td>
                                                    <td>{{ $request->AgentComments }}</td>
                                                    <td>{{ $request->Created }}</td>
                                                    <td>{{ $request->CreatedBy }}</td>


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
