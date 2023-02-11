@extends('layouts.dashboard-master')

@section('title','Create Branch User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Branch User</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('branch.users.list',$branch->Id)}}"
               class="ml-2 btn btn-primary">Go To Branch Users</a>
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
                            <h4>Add a New Branch User</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('branch.users.store') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <input name="BranchId" value="{{$branch->Id}}" hidden>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">User Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Name"
                                               placeholder="Set an User Name."    class="form-control @error('Name') is-invalid @enderror"/>

                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="Password" name="Password" autocomplete="new-Password"
                                               class="form-control @error('Password') is-invalid @enderror"
                                               placeholder="Set an User Password.">
                                        @error('Password')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Password') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>





                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save New Branch User</button>
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
