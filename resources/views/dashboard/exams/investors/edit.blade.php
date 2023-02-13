@extends('layouts.dashboard-master')

@section('title','Edit ExamRound Investor')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit ExamRound Investor</h1>
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
                            <h4>Update Investor</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('dashboard.exams.investors.update', [ 'round' => $round->id,'package' => $package->id,'investor' => $investor['id'], ]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User
                                        Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="username" value="{{old('username', $investor->username)}}"
                                               class="form-control @error('username') is-invalid @enderror">
                                        @error('username')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('username') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User
                                        Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="password" value="{{old('password', $investor->password)}}"
                                               class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
