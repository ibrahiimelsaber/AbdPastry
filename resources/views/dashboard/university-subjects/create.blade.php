@extends('layouts.dashboard-master')

@section('title','Create Faculty Subject')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Add Faculty Subject</h1></div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Add a New Faculty Subject</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.university-subjects.store',['university'=>$university->id,'faculty' => $faculty->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Faculty Subject Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name')}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Level</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('level') is-invalid @enderror"
                                                name="level">
                                            @foreach($levels as $level)
                                                <option>{{$level->label}}</option>
                                            @endforeach
                                        </select>
                                        @error('level')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('level') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Major</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('major_id') is-invalid @enderror"
                                                name="major_id">
                                            @foreach($majors as $major)
                                                <option value="{{$major->id}}">{{$major->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('major_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('major_id') }}</p>
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
