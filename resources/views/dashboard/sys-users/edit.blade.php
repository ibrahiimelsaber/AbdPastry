@extends('layouts.dashboard-master')

@section('title','Edit SystemUser Profile '.$sysUser->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit SystemUser Profile</h1>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    @include('dashboard.common._alert_validation_errors')
                    <div class="card">
                        <div class="card-header">
                            <h4>Update SystemUser Profile</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.sys-users.update',$sysUser->id) }}">
                                @csrf
                                @method('PUT')

                                {{-- User Role --}}
                                @if($canUpdateRole)
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                        >User Role</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="role_university_student" name="role"
                                                       value="UNIVERSITY_STUDENT" class="custom-control-input"
                                                        {{ $sysUser->hasRole('UNIVERSITY_STUDENT')? ' checked' : '' }}>
                                                <label class="custom-control-label"
                                                       for="role_university_student">University Student</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="role_school_student" name="role"
                                                       value="SCHOOL_STUDENT" class="custom-control-input"
                                                        {{ $sysUser->hasRole('SCHOOL_STUDENT')? ' checked' : '' }}>
                                                <label class="custom-control-label"
                                                       for="role_school_student">School Student</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Name --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name',$sysUser->name)}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="email" value="{{old('email',$sysUser->email)}}"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="phone" value="{{old('phone',$sysUser->phone)}}"
                                               class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('phone') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                @if($sysUser->id == auth()->id())
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                        >Current Password</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="password"
                                                   name="current_password"
                                                   class="form-control @error('current_password') is-invalid @enderror"
                                                   autocomplete="new-password"
                                                   placeholder="Current password">
                                            @error('current_password')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('current_password') }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >New Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               autocomplete="new-password"
                                               placeholder="New password (Only if you want to change the password)">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >Confirm New Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password"
                                               name="password_confirmation"
                                               class="form-control @error('password_confirmation') is-invalid @enderror"
                                               autocomplete="new-password">
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password_confirmation') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{url()->previous()}}" class="btn btn-outline-dark">Cancel</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
