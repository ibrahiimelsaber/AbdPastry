@extends('layouts.dashboard-master')

@section('title','Create Branch')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Branch</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('branches.index')}}"
               class="ml-2 btn btn-primary">Go To Branches</a>
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
                            <h4>Add a New Branch</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('branches.store') }}"
                                  enctype="multipart/form-data">
                                @csrf




                                <!-- Branch Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Branch Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Name"
                                               class="form-control @error('Name') is-invalid @enderror"/>

                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>





                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save New Branch</button>
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
