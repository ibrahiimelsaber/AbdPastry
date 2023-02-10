@extends('layouts.dashboard-master')

@section('title','Manage all accounts')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage All Accounts</h1>
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
                                <h4>All Active Accounts <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                        <a href="{{route('all.accounts.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Account</a>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($accounts)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Account Id</th>
                                                <th>Account Name</th>
                                                <th>Main Phone Number</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($accounts as $account)
                                                <tr>

                                                    <td>{{ $account->Id }}</td>
                                                    <td>{{ $account->Name }}</td>
                                                    <td>{{ $account->PhoneNumber }}</td>
                                                    <td>{{ $account->CreatedOn }}</td>
                                                    <td>{{ $account->CreatedBy }}</td>

                                                    <td>

                                                            <a href="{{route('all.accounts.edit',$account->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"> Update Account</i>
                                                            </a>

{{--                                                            <a href="{{route('all.accounts.contacts.show',$account->Id)}}"--}}
{{--                                                               class="btn btn-warning"><i class="fa fa-eye"> Contacts</i>--}}
{{--                                                            </a>--}}

                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any accounts yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($accounts)>0)
                            <div class="text-center">
                                {{ $accounts->links() }}
{{--                                 {{ $accounts->appends(Request::except('page'))->links() }}--}}
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
