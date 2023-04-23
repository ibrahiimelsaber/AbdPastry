@extends('layouts.dashboard-master')

@section('title','Create Agent')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Agent</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('agents.index')}}"
               class="ml-2 btn btn-primary">Go To Agents</a>
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
                            <h4>Add a New Agent</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('agents.store') }}"
                                  enctype="multipart/form-data">
                                @csrf




                                <!-- Agent Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Agent Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="username"
                                               class="form-control @error('username') is-invalid @enderror"/>

                                        @error('username')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('username') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Agent Image -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Agent Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="image" id="formFileLg"
                                               class="form-control form-control-file border border-danger @error('image') is-invalid @enderror"/>

                                        @error('image')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('image') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Agent Percentage -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Agent Percentage</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="percentage" max="100"
                                               class="form-control @error('percentage') is-invalid @enderror"/>

                                        @error('percentage')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('percentage') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>




                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save New Agent</button>
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
