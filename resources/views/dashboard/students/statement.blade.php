@extends('layouts.dashboard-master')

@section('title', $student->name.' - statement')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Student Account Statement</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">
            @can('view-students')
                <div class="row">
                    <div class="col-12">
                        @include('dashboard.common._alert_message')
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Current Balance</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-muted">{{$student->name}}</div>
                                            </td>
                                            <td>
                                                <div class="text-muted">{{$student->email}}</div>
                                            </td>
                                            <td>
                                                <div class="text-muted">{{$student->phone}}</div>
                                            </td>
                                            <td>
                                                <div class="text-muted">{{$moneyAccount->balance}}</div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Account Statement</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    @if(count($transactions)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Related Model</th>
                                                <th>Related ID</th>
                                                <th>Amount</th>
                                                <th>Created At</th>
                                            </tr>
                                            @foreach($transactions as $transaction)
                                                <tr>
                                                    <td>
                                                        <div>{{$transaction->related_model}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$transaction->related_id}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{"$transaction->amount $transaction->currency"}}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{$transaction->created_at}}</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not buy any thing yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($transactions)>0)
                            <div class="text-center">
                                {{$transactions->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
