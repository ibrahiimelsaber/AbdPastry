@extends('layouts.dashboard-master')

@section('title', 'Edit Teacher, ' . $teacher->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Teacher, {{$teacher->name}}</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    {{--@include('dashboard.common._alert_validation_errors')--}}
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Teacher</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.teachers.update',$teacher->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- City --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">City</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('city_id') is-invalid @enderror"
                                                name="city_id" id="cities_list">
                                            @foreach($cities as $city)
                                                <option {{$city->id==$teacher->city_id?' selected ':''}}
                                                        value="{{$city->id}}">{{$city->name}}</option>
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
                                        <input type="text" name="name" value="{{old('name',$teacher->name)}}"
                                               class="form-control @error('name') is-invalid @enderror">
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
                                        <input type="text" name="email" value="{{old('email',$teacher->email)}}"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Confirm Password</label>
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
                                    @if($teacher->avatar_link)
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <img src="{{ $teacher->avatar_link }}" alt="avatar"
                                                     class="avatar-presence mr-1" width="80">
                                            </div>
                                        </div>
                                    @endif
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
                                        <button type="submit" class="btn btn-primary">Save</button>
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
