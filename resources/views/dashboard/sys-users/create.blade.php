@extends('layouts.dashboard-master')

@section('title','Create SystemUser')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Add SystemUser</h1></div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    @include('dashboard.common._alert_validation_errors')
                    <div class="card">
                        <div class="card-header">
                            <h4>Add a New SystemUser</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.sys-users.store') }}">
                                @csrf

                                {{-- User Role --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >User Role *</label>
                                    <div class="col-sm-12 col-md-7">

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="role_school_student" name="role"
                                                   value="SYS_SUPPORT" class="custom-control-input"
                                                   checked>
                                            <label class="custom-control-label"
                                                   for="role_school_student">System Support</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Name --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name *</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name')}}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Full name of the user.">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email *</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" name="email" value="{{old('email')}}"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Email address (should be unique).">
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
                                        <input type="text" name="phone" value="{{old('phone')}}"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               placeholder="Phone (should be unique).">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('phone') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >Password *</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" name="password" autocomplete="new-password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Set an account password.">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >Confirm Password *</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" name="password_confirmation" autocomplete="new-password"
                                               class="form-control @error('password_confirmation') is-invalid @enderror"
                                               placeholder="Confirm account password.">
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
                                        <button type="submit" class="btn btn-primary">Save New System User</button>
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
