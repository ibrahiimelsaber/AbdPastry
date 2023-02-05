@extends('layouts.dashboard-master')

@section('title','Show SystemUser Profile '.$sysUser->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Show Profile</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.sys-users.edit',$sysUser->id)}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Edit SystemUser Profile
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
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                                <div class="col-sm-12 col-md-7">
                                    <img src="{{$sysUser->avatar_link}}" class="avatar avatar-lg">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$sysUser->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$sysUser->email}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$sysUser->phone}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Roles</label>
                                <div class="col-sm-12 col-md-7">
                                    @foreach($sysUser->roles as $role)
                                        <input disabled type="text" value="{{$role->name}}" class="form-control">
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
