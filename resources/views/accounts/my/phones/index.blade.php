@extends('layouts.dashboard-master')

@section('title','Manage Account Phones')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1 class="ml-2">Manage Account Phones</h1>
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
                                <h4>My Account Phones <span>({{ $total }})</span></h4>
                                <div class="card-header-action">


                                        <a href="{{route('my.account.phones.create',$account)}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Phone</a>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($phones)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Account Id</th>
                                                <th>Account Name</th>
                                                <th>Phone Number</th>
                                                <th>Phone Type</th>

                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($phones as $phone)
                                                <tr>

                                                    <td>{{ optional($phone->account)->Id }}</td>
                                                    <td>{{ optional($phone->account)->Name }}</td>
                                                    <td>{{ $phone->Phone }}</td>
                                                    <td>{{ optional($phone->phoneType)->Name }}</td>

                                                    <td>

                                                            <a href="{{route('my.account.phones.edit',$phone->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"> Update Phone</i>
                                                            </a>
                                                                   @if($phone->Active == 1)
                                                                         <a href="{{route('phones.deactivate',$phone->Id)}}"
                                                               class="btn btn-danger"><i class="fa fa-user-times"> Deactivate Phone</i>
                                                            </a>
@else
    <a href="{{route('phones.activate',$phone->Id)}}"
                                                               class="btn btn-success ml-1"><i class="fa fa-user-check"> Activate Phone</i>
                                                            </a>

@endif

                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any phones yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($phones)>0)
                            <div class="text-center">
                                {{ $phones->links() }}
{{--                                 {{ $phones->appends(Request::except('page'))->links() }}--}}
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
