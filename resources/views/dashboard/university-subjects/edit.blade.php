@extends('layouts.dashboard-master')

@section('title','Edit UniversitySubject, '.$universitySubject->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit UniversitySubject</h1>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Update UniversitySubject</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.university-subjects.update',[
                            'university'=>$university->id,'faculty'=>$faculty->id,'major'=>$universitySubject->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">UniversitySubject
                                        Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name',$universitySubject->name)}}"
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
                                                <option {{$universitySubject->level==$level->label?' selected':''}}>{{$level->label}}</option>
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
                                                <option {{$universitySubject->major_id==$major->id?' selected ':''}}
                                                        value="{{$major->id}}">{{$major->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('major_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('major_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Archived --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Archived</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror"
                                                   type="radio" name="archived" id="archived1"
                                                   value="1" {{$universitySubject->archived == 1 ?' checked ':''}}>
                                            <label class="form-check-label" for="archived1">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror"
                                                   type="radio" name="archived" id="archived2"
                                                   value="0" {{$universitySubject->archived == 0 ?' checked ':''}}>
                                            <label class="form-check-label" for="archived2">No</label>
                                        </div>
                                        @error('archived')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('archived') }}</p>
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
