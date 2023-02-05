@extends('layouts.dashboard-master')

@section('title','Show Profile '.$student->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Show Student Profile</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

            <div class="card card-primary">
                <div class="card-body">

                    <a href="{{route('dashboard.students.sendSmsView',$student->id)}}"
                       class="btn btn-outline-dark ml-1"><i class="fa fa-sms"></i> Send SMS</a>

                    <a href="{{route('dashboard.students.statement',$student->id)}}"
                       class="btn btn-outline-dark ml-1"><i class="fa fa-dollar-sign"></i> Account Statement</a>

                    <a href="{{route('dashboard.students.edit',$student->id)}}"
                       class="btn btn-primary ml-1"><i class="fa fa-edit"></i> Edit Student Profile</a>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h5>Personal</h5>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                                <div class="col-sm-12 col-md-7">
                                    <img src="{{$student->avatar_link}}" class="avatar avatar-lg">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$student->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$student->email}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                                <div class="col-sm-9 col-md-5">
                                    <input disabled type="text" value="{{$student->phone}}" class="form-control">
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    @if($student->phone_verified_at)
                                        <i class="fas fa-check-circle"></i> Verified
                                    @else
                                        <i class="fas fa-ban"></i> Not-Verified
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Last Phone Verification Code</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$lastPhoneVerificationCode}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Roles</label>
                                <div class="col-sm-12 col-md-7">
                                    @foreach($student->roles as $role)
                                        <input disabled type="text" value="{{$role->name}}" class="form-control">
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Governorate</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$student->governorate->name ??''}}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Screenshots reported</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$student->screenshots->count() }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Availability</label>
                                <div class="col-sm-9 col-md-5">
                                    <input disabled type="text" class="form-control"
                                           value="{{$student->banned?'Banned':'Available'}}">
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    <a href="{{route('dashboard.students.ban',$student->id)}}"
                                       class="btn btn-outline-info btn-block"
                                       onclick="event.preventDefault();
                                                     document.getElementById('ban-user').submit();">
                                        @if($student->banned)
                                            <i class="fas fa-lock-open"></i> Un-Ban
                                        @else
                                            <i class="fas fa-user-slash"></i> Ban
                                        @endif
                                    </a>
                                    <form id="ban-user" action="{{ route('dashboard.students.ban',$student->id) }}"
                                          method="POST" style="display: none;" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>


                            <h5>Mobile Device</h5>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">OS</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$student->os_type}}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">UUID</label>
                                <div class="col-sm-9 col-md-5">
                                    <input disabled type="text" value="{{$student->device_uuid}}" class="form-control">
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    <a href="{{route('dashboard.students.remove-uuid',$student->id)}}"
                                        class="btn btn-outline-info btn-block"
                                        onclick="event.preventDefault();
                                                     document.getElementById('remove-uuid-user').submit();">
                                        <i class="fas fa-mobile-alt"></i> Remove UUID</a>
                                    <form id="remove-uuid-user" action="{{ route('dashboard.students.remove-uuid',$student->id) }}"
                                          method="POST" style="display: none;" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Last IP</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$student->last_ip}}" class="form-control">
                                </div>
                            </div>


                            <h5>Education</h5>

                            {{--@if($student->is_school_student ==true)--}}
                            @if($student->hasRole('SCHOOL_STUDENT'))
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">School</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$student->school_name}}" class="form-control">
                                    </div>
                                </div>
                            @else
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">University</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$student->faculty->university->name??''}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Faculty</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$student->faculty->name??''}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Major</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$student->major->name??''}}"
                                               class="form-control">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Student Grade</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" class="form-control"
                                           value="{{$student->studentGrade->educational_level ?? ''}} - {{$student->studentGrade->grade ?? ''}}">
                                </div>
                            </div>


                            <h5>Payment</h5>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Balance</label>
                                <div class="col-sm-9 col-md-5">
                                    <input disabled type="text" value="{{$moneyAccount->balance}}" class="form-control">
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    <a href="{{route('dashboard.students.addBalanceView',$student->id)}}"
                                       class="btn btn-outline-info btn-block">
                                        <i class="fas fa-dollar-sign"></i> Add Balance</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
