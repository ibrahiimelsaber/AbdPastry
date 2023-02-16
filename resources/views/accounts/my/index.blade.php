@extends('layouts.dashboard-master')

@section('title','Manage my accounts')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage My Accounts</h1>

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
                                <h4>My Accounts <span>({{ $total }})</span></h4>
                                <div class="card-header-action">


                                        <a href="{{route('my.accounts.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Account</a>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($accounts)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Account Name</th>
                                                <th>Account Type</th>
                                                <th>Main Phone Number</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($accounts as $account)
                                                <tr>

                                                    <td>{{ $account->Name }}</td>
                                                    <td>{{ $account->accType }}</td>
                                                    <td>{{ $account->PhoneNumber }}</td>
                                                    <td>{{ $account->CreatedOn }}</td>
                                                    <td>{{ $account->CreatedBy }}</td>

                                                    <td>

                                                            <a href="{{route('my.account.phones.index',$account->Id)}}"
                                                               class="btn btn-danger"><i class="fa fa-phone"> Phones</i>
                                                            </a>
                                                            <a href="{{route('my.accounts.edit',$account->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"> Update Account</i>
                                                            </a>

                                                            <a href="{{route('my.account.contacts.index',$account->Id)}}"
                                                               class="btn btn-warning"><i class="fa fa-eye"> Contacts</i>
                                                            </a>

                                                            <a href="{{route('all.account.surveys.index',$account->Id)}}"
                                                               class="btn btn-info"><i class="fa fa-question"> Surveys</i>
                                                            </a>
    <a href="{{route('my.account.eed-surveys.index',$account->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-question"> Eed Surveys</i>
                                                            </a>

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
