@extends('layouts.dashboard-master')

@section('title','Manage Branch Service Requests')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2"><strong class="bg-secondary">{{session('BranchName')}}</strong> Service Requests Statistics</h1>
            <button class="btn btn-primary ml-2" id="modal-search">Show Statistics</button>

            <form class="modal-part" id="modal-login-part" action="{{route("branch.requests.statistics",session('BranchId'))}}">
                <p>Choose Search Dates</p>

                <input name="BranchId" value="{{session('BranchId')}}" hidden>
                <input name="key" value="search" hidden>

                <div class="form-group">
                    <label>From</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <input type="date" class="form-control" placeholder="From Date" name="from">
                    </div>
                </div>
                <div class="form-group">
                    <label>To</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <input type="date" class="form-control" placeholder="To Date" name="to">
                    </div>
                </div>
            </form>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

            <div class="row">

                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Service Requests Types</h4>
                            <div class="card-header-action">

                            </div>
                            <div class="card-header-action">
{{--                                <a href="#" class="btn active">Week</a>--}}
{{--                                <a href="#" class="btn">Month</a>--}}
{{--                                <a href="#" class="btn">Year</a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart1" height="180"></canvas>

                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Service Requests Types Percentage Of All Requests</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col mb-4 mb-lg-0 text-center">
{{--                                    <div class="browser browser-chrome"></div>--}}
                                    <img src="{{asset("assets/statistics/ginq.png")}}" class="browser rounded-circle" alt="">
                                    <div class="mt-2 font-weight-bold">General Inquiry</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> <strong>{{ $srCounts == 0 ? $srCounts : round($generalInquiry/$srCounts * 100,1)}} %</strong></div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/complaints.jpg")}}" class="browser rounded-circle" alt="">

                                    <div class="mt-2 font-weight-bold">Complaints</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> {{$srCounts == 0 ? $srCounts : round($complaints/$srCounts * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/orderTaking.jpg")}}" class="browser rounded-circle" alt="">

                                    <div class="mt-2 font-weight-bold">Order Taking</div>
                                    <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> {{$srCounts == 0 ? $srCounts : round($orderTaking/$srCounts * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/fbinq.png")}}" class="browser rounded-circle" alt="">
                                    <div class="mt-2 font-weight-bold">FB Inquiry</div>
                                    <div class="text-small text-muted">{{$srCounts == 0 ? $srCounts : round($faceBookInquiry/$srCounts * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/fbcomplaints.jpg")}}" class="browser rounded-circle" alt="">

                                    <div class="mt-2 font-weight-bold">FB Complaints</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> {{$srCounts == 0 ? $srCounts : round($faceBookComplaints/$srCounts * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/wrongnumber.jpg")}}" class="browser rounded-circle" alt="">
                                    <div class="mt-2 font-weight-bold">Wrong Number</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>{{$srCounts == 0 ? $srCounts : round($wrongNumber/$srCounts * 100,1)}} % </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Complaints Sub Types</h4>
                            <div class="card-header-action">
{{--                                <a href="#" class="btn active">Week</a>--}}
{{--                                <a href="#" class="btn">Month</a>--}}
{{--                                <a href="#" class="btn">Year</a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="180"></canvas>

                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Complaints Sub Types Percentage Of All Complaints</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col mb-4 mb-lg-0 text-center">
                                    {{--                                    <div class="browser browser-chrome"></div>--}}
                                    <img src="{{asset("assets/statistics/deliverydamage.jpeg")}}" class="browser rounded-circle" alt="">
                                    <div class="mt-2 font-weight-bold">Delivery Damage</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> <strong>{{$complaints == 0 ? $complaints : round($deliveryDamage/$complaints * 100,1)}} %</strong></div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/productQuality.jpg")}}" class="browser rounded-circle" alt="">

                                    <div class="mt-2 font-weight-bold">Product Quality</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> {{$complaints == 0 ? $complaints : round($productQuality/$complaints * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/staffattitude.png")}}" class="browser rounded-circle" alt="">

                                    <div class="mt-2 font-weight-bold">Staff Attitude</div>
                                    <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> {{$complaints == 0 ? $complaints : round($staffAttitude/$complaints * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/missingproduct.png")}}" class="browser rounded-circle" alt="">
                                    <div class="mt-2 font-weight-bold">Missing Products</div>
                                    <div class="text-small text-muted">{{$complaints == 0 ? $complaints : round($missingProducts/$complaints * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/visa.jpg")}}" class="browser rounded-circle" alt="">

                                    <div class="mt-2 font-weight-bold">Visa Issues</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> {{$complaints == 0 ? $complaints : round($visaIssues/$complaints * 100,1)}} %</div>
                                </div>
                                <div class="col mb-4 mb-lg-0 text-center">
                                    <img src="{{asset("assets/statistics/complaints.jpg")}}" class="browser rounded-circle" alt="">
                                    <div class="mt-2 font-weight-bold">Branch Complaints</div>
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>{{$complaints == 0 ? $complaints : round($branchComplaints/$complaints * 100,1)}} % </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('scripts')
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Delivery Damage", "Product Quality", "Staff Attitude", "Delayed Order", "Bill Mistakes", "Food Safety", "Visa Issues", "Food Poising", "Missing Products","Branch Complaints"],
                datasets: [{
                    label: 'Complaints Sub Types Count',
                    data: [<?php echo   $deliveryDamage?>,<?php echo  $productQuality ?>,<?php echo  $staffAttitude ?>,<?php echo  $delayedOrder ?>,<?php echo  $billMistakes ?>,<?php echo  $foodSafety ?>,<?php echo  $visaIssues ?>,<?php echo  $foodPoising ?>,<?php echo  $missingProducts ?>,<?php echo  $branchComplaints ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 139, 54, 0.2)',
                        'rgba(255, 170, 28, 0.2)',
                        'rgba(255, 180, 82, 0.2)',
                        'rgba(255, 112, 64, 0.2)',
                        'rgba(255, 130, 52, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 109, 34, 1)',
                        'rgba(255, 129, 42, 1)',
                        'rgba(255, 119, 84, 1)',
                        'rgba(255, 159, 94, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("myChart1").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["General Inquiry", "Complaints", "Order Taking", "FB Inquiry", "FB Complaints", "Wrong Number"],
                datasets: [{
                    label: 'Service Requests Types Count',
                    data: [<?php echo  $generalInquiry ?>,<?php echo  $complaints ?>,<?php echo  $orderTaking ?>,<?php echo  $faceBookInquiry ?>,<?php echo  $faceBookComplaints ?>,<?php echo  $wrongNumber ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>

    @include('dashboard.common._modal_branch_search')
@endsection
