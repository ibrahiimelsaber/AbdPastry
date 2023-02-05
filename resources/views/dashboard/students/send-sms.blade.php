@extends('layouts.dashboard-master')

@section('title','Send SMS Message To '.$student->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Send SMS Message To {{$student->name}}</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Student</h5>
                            <div class="form-group row mb-4">
                                <div class="col-sm-6 col-md-4">
                                    <input disabled type="text" value="{{$student->name}}" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <input disabled type="text" value="{{$student->email}}" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <input disabled type="text" value="{{$student->phone}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Send SMS Message</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.students.sendSms',$student->id) }}">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Message</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="message" value="{{old('message')}}"
                                               class="form-control @error('message') is-invalid @enderror"
                                               placeholder="write message">
                                        @error('message')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('message') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Send</button>
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
