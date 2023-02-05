@extends('layouts.dashboard-master')

@section('title', 'Create Teacher')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Teacher</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @if(session('message'))
                        <div class="alert {{ session('class') }} alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert"><span>×</span></button>
                                {{ session('message') }}
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Add a New Teacher</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.teachers.store') }}" enctype="multipart/form-data">
                                @csrf

                                {{-- City --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">City</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('city_id') is-invalid @enderror"
                                                name="city_id" id="cities_list">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('city_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name')}}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Full name.">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
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
{{--                                 <div class="form-group row mb-4">--}}
{{--                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>--}}
{{--                                    <div class="col-sm-12 col-md-7">--}}
{{--                                        <input type="phone" name="phone" value="{{old('phone')}}"--}}
{{--                                               class="form-control @error('phone') is-invalid @enderror"--}}
{{--                                               placeholder="Email address (should be unique).">--}}
{{--                                        @error('phone')--}}
{{--                                        <div class="invalid-feedback">--}}
{{--                                            <p>{{ $errors->first('phone') }}</p>--}}
{{--                                        </div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Confirm
                                        Password</label>
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="avatar"
                                               class="form-control @error('avatar') is-invalid @enderror">
                                        @error('avatar')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('avatar') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Add</button>
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
