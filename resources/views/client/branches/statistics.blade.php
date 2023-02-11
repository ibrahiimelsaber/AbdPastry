@extends('layouts.dashboard-master')

@section('title','Manage Branch Service Requests')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage Branch Service Requests</h1>
            <h1 class="ml-2">||</h1>


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
                                <h4> Service Requests Statistics</h4>
                                <div class="card-header-action">
                                </div>
                            </div>
                            <div class="card-body p-0">

                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </section>

@endsection

@section('scripts')


@endsection
