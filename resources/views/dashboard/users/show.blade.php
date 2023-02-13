@extends('layouts.dashboard-master')

@section('title','Show Profile '.$user->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Show Profile</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.users.index')}}"
                   class="btn btn-outline-primary ml-1">Back to all Users</a>

                <a href="{{route('dashboard.users.sendSmsView',$user->id)}}"
                   class="btn btn-outline-dark ml-1"><i class="fa fa-sms"></i> Send SMS
                </a>

                <a href="{{route('dashboard.users.statement',$user->id)}}"
                   class="btn btn-outline-dark ml-1"><i class="fa fa-dollar-sign" aria-hidden="true"></i> Account Statement
                </a>

                <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-primary ml-1">
                    <i class="fa fa-edit"></i>
                    Edit User Profile
                </a>
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h5>Personal</h5>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                                <div class="col-sm-12 col-md-7">
                                    <img src="{{$user->avatar_link}}" class="avatar avatar-lg">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->email}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->phone}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Roles</label>
                                <div class="col-sm-12 col-md-7">
                                    @foreach($user->roles as $role)
                                        <input disabled type="text" value="{{$role->name}}" class="form-control">
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Governorate</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->governorate->name ??''}}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Screenshots reported</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->screenshots->count() }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Availability</label>
                                <div class="col-sm-9 col-md-5">
                                    <input disabled type="text" class="form-control"
                                           value="{{$user->banned?'Banned':'Available'}}">
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    <a href="{{route('dashboard.users.ban',$user->id)}}"
                                       class="btn btn-outline-info btn-block"
                                       onclick="event.preventDefault();
                                                     document.getElementById('ban-user').submit();">
                                        @if($user->banned)
                                            <i class="fas fa-lock-open"></i> Un-Ban
                                        @else
                                            <i class="fas fa-user-slash"></i> Ban
                                        @endif
                                    </a>
                                    <form id="ban-user" action="{{ route('dashboard.users.ban',$user->id) }}"
                                          method="POST" style="display: none;" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>


                            <h5>Mobile Device</h5>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">OS</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->os_type}}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">UUID</label>
                                <div class="col-sm-9 col-md-5">
                                    <input disabled type="text" value="{{$user->device_uuid}}" class="form-control">
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    <a href="{{route('dashboard.users.remove-uuid',$user->id)}}"
                                        class="btn btn-outline-info btn-block"
                                        onclick="event.preventDefault();
                                                     document.getElementById('remove-uuid-user').submit();">
                                        <i class="fas fa-mobile-alt"></i> Remove UUID</a>
                                    </a>
                                    <form id="remove-uuid-user" action="{{ route('dashboard.users.remove-uuid',$user->id) }}"
                                          method="POST" style="display: none;" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Last IP</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->last_ip}}" class="form-control">
                                </div>
                            </div>


                            <h5>Education</h5>

                            {{--@if($user->is_school_student ==true)--}}
                            @if($user->hasRole('SCHOOL_STUDENT'))
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">School</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$user->school_name}}" class="form-control">
                                    </div>
                                </div>
                            @else
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">University</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$user->faculty->university->name??''}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Faculty</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$user->faculty->name??''}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Major</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="{{$user->major->name??''}}"
                                               class="form-control">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Level</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$user->level}}" class="form-control">
                                </div>
                            </div>


                            <h5>Payment</h5>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Balance</label>
                                <div class="col-sm-9 col-md-5">
                                    <input disabled type="text" value="{{$moneyAccount->balance}}" class="form-control">
                                </div>
                                <div class="col-sm-3 col-md-2">
                                    <a href="{{route('dashboard.users.addBalanceView',$user->id)}}"
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
