@extends('layouts.dashboard-master')

@section('title','Manage My Activities')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage My Activities</h1>

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
                                <h4>Activities <span>({{ $total }})</span></h4>
                                <div class="card-header-action">

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">

                                    @if(count($activities)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Activity Id</th>
                                                <th>Request Id</th>
                                                <th>Contact Name</th>
                                                <th>Activity Type</th>
                                                <th>Activity Sub Type</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($activities as $activity)
                                                <tr>
                                                    <td>{{ $activity->Id }}</td>
                                                    <td>{{ $activity->SRId}}</td>
                                                    <td>{{ optional($activity->request)->contact->account->Name ?? '' }}</td>
                                                    <td>{{ optional($activity->type)->Name }}</td>
                                                    <td>{{ optional($activity->subType)->Name }}</td>
                                                    <td>{{ $activity->Created }}</td>
                                                    <td>{{ $activity->CreatedBy }}</td>
                                                    <td>
                                                            <a href="{{route('my.activities.edit',$activity->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"> Update Activity</i>
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
                        @if(count($activities)>0)
                            <div class="text-center">
                                {{ $activities->links() }}
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
