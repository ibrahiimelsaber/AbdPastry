@extends('layouts.dashboard-master')

@section('title','Manage Course Students')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Course Students</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-body">

                    <div class="card-stats">
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-label">Course</div>
                                <div class="card-stats-item-count">{{$course->name}}</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @can('view-students')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Students <span>({{ $total }})</span></h4>
                                <div class="card-header-action">

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($boughtCourses)>0)
                                        <table class="table table-striped text-center table-hover">
                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>Bought At</th>
                                                <th>Money Paid</th>
                                                <th>Bought Method</th>
                                            </tr>
                                            @foreach($boughtCourses as $boughtCourse)
                                                <tr>
                                                    <td>
                                                        <a href="{{route('dashboard.students.show',$boughtCourse->student_id )}}">{{$boughtCourse->student_name}}</a>
                                                    </td>
                                                    <td>{{$boughtCourse->created_at}}</td>
                                                    <td>{{$boughtCourse->money_paid ?? 0}}</td>
                                                    <td>{{$boughtCourse->bought_method}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like no students bought this course yet!</p>
                                        </div>
                                    @endif
                                </div>
                                @if(count($boughtCourses)>0)
                                    <div class="text-center">
                                        {{$boughtCourses->links()}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
