@extends('layouts.dashboard-master')

@section('title','Edit Exam Rounds')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Exam Round</h1>
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
                            <h4>Update Exam Round</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.exams.rounds.update',$examRound->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Round Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name',$examRound->name)}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Round Start Date</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" name="start_date" value="{{old('start_date', $examRound->start_date->format('Y-m-d\TH:i'))}}"
                                               class="form-control @error('start_date') is-invalid @enderror">
                                        @error('start_date')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('start_date') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Round End Date</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" name="end_date" value="{{old('end_date', $examRound->end_date->format('Y-m-d\TH:i'))}}"
                                               class="form-control @error('end_date') is-invalid @enderror">
                                        @error('end_date')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('end_date') }}</p>
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
