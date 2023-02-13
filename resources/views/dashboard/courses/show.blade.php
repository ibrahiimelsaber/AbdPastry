@extends('layouts.dashboard-master')

@section('title','Show Course '.$course->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Show Course</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.courses.edit',$course->id)}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Edit Course
                </a>
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subject Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->subject->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Student Grade</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->studentGrade->educational_level ." - ". $course->studentGrade->grade}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Teacher Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->teacher->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subscription Type</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->subscription_type}}" class="form-control">
                                </div>
                            </div>
                            @if($course->subscription_type == 'MONTHLY')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Monthly Subscription Price</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{ $course->monthly_subscription_price }}" class="form-control">
                                    </div>
                                </div>
                            @else
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">One Time Payment Price</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{ $course->one_time_payment_price }}" class="form-control">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start At</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->starts_at}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hide At</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->hides_at}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Archived</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->archived == 1 ? 'YES' : 'NO'}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hidden</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->hidden == 1 ? 'YES' : 'NO'}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
