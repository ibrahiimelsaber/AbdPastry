@extends('layouts.dashboard-master')
@section('title','Manage Dashboard')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Manage Dashboard</h1></div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            <div class="row m-2">

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Today's Students</h4>
                            </div>
                            <div class="card-body">
                                {{ $todayStudentsCount }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>All Students</h4>
                            </div>
                            <div class="card-body">
                                {{ $allStudentsCount }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Verified Students</h4>
                            </div>
                            <div class="card-body">
                                {{ $allVerifiedStudentsCount }}
                            </div>
                        </div>
                    </div>
                </div>

                {{--                <div class="col-lg-3 col-md-6 col-sm-6 col-12">--}}
                {{--                    <div class="card card-statistic-1">--}}
                {{--                        <div class="card-icon bg-warning">--}}
                {{--                            <i class="fab fa-sellcast"></i>--}}
                {{--                        </div>--}}
                {{--                        <div class="card-wrap">--}}
                {{--                            <div class="card-header">--}}
                {{--                                <h4>Most Sold Item</h4>--}}
                {{--                            </div>--}}
                {{--                            <div class="card-body">--}}
                {{--                                1--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="col-lg-3 col-md-6 col-sm-6 col-12">--}}
                {{--                    <div class="card card-statistic-1">--}}
                {{--                        <div class="card-icon bg-danger">--}}
                {{--                            <i class="fas fa-dollar-sign"></i>--}}
                {{--                        </div>--}}
                {{--                        <div class="card-wrap">--}}
                {{--                            <div class="card-header">--}}
                {{--                                <h4>Today's Money</h4>--}}
                {{--                            </div>--}}
                {{--                            <div class="card-body">--}}
                {{--                                1--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

            </div>
        </div>
    </section>
@endsection
