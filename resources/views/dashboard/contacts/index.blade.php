@extends('layouts.dashboard-master')
@section('title','Manage Contacts')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>View ContactUs</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Messages of ContactUs <span>({{ $total }})</span></h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        @if(count($messages)>0)
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Redirected From</th>
                                    <th>Required Value</th>
                                    <th>Message</th>
                                </tr>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->phone }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->redirected_from }}</td>
                                        <td>{{ $message->required_value }}</td>
                                        <td>{{ $message->message }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center p-3 text-muted">
                                <h5>No Results</h5>
                                <p>Looks like you have not added any messages yet!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(count($messages)>0)
                <div class="text-center">
                    {{$messages->links()}}
                </div>
            @endif

        </div>
    </section>
@endsection
