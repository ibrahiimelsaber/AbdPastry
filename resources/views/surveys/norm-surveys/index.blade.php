@extends('layouts.dashboard-master')

@section('title','Manage my Eed Surveys')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1 class="ml-2">Manage My Eed Surveys</h1>
    <h1 class="ml-2">|| </h1>
            <a href="{{route('my.accounts.index')}}"
               class="ml-2 btn btn-primary">Return Back
            </a>

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
                                <h4>My Eed Surveys <span>({{ $total }})</span></h4>
                                <div class="card-header-action">


                                        <a href="{{route('my.account.eed-surveys.create',$account)}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Eed Survey</a>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($surveys)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Account Id</th>
                                                <th>Account Name</th>
                                                <th>Survey Id</th>
                                                <th>Call Status</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
{{--                                                <th>Actions</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($surveys as $survey)
                                                <tr>

                                                    <td>{{ $survey->account->Id }}</td>
                                                    <td>{{ $survey->account->Name }}</td>
                                                    <td>{{ $survey->id }}</td>
                                                        <td>{{ $survey->callStatus->Name }}</td>
                                                    <td>{{ $survey->createdOn }}</td>
                                                    <td>{{ $survey->createdBy }}</td>

                                                    <td>

{{--                                                            <a href="{{route('my.account.contacts.edit',$survey->Id)}}"--}}
{{--                                                               class="btn btn-primary"><i class="fa fa-edit"> Update Contact</i>--}}
{{--                                                            </a>--}}
{{--                                                            <a href="{{route('my.account.contact.requests.index',$survey->Id)}}"--}}
{{--                                                               class="btn btn-warning"><i class="fa fa-edit"> Service Requests</i>--}}
{{--                                                            </a>--}}

                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any surveys yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($surveys)>0)
                            <div class="text-center">
                                {{ $surveys->links() }}
{{--                                 {{ $surveys->appends(Request::except('page'))->links() }}--}}
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
