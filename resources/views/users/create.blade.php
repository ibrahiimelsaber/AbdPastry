@extends('layouts.dashboard-master')

@section('title','Create User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add User</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('users.index')}}"
               class="ml-2 btn btn-primary">Go To Users</a>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Add a New User</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.store') }}"
                                  enctype="multipart/form-data">
                                @csrf




                                <!-- User Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">User Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Username"
                                               class="form-control @error('Username') is-invalid @enderror"/>

                                        @error('Username')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Username') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>



                                <!--Call Status and Call Back Status-->

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">User Group</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('GroupId') is-invalid @enderror"
                                                name="GroupId" id="GroupId">

                                            <option value="1">Agent</option>
                                            <option value="2">Team Leader</option>

                                        </select>
                                        @error('GroupId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('GroupId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>



                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save New User</button>
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
