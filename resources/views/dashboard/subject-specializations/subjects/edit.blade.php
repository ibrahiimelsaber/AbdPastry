@extends('layouts.dashboard-master')

@section('title','Edit Subject '.$subject->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Subject</h1>
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
                            <h4>Update Subject</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('dashboard.subject-specializations.subjects.update',["subjectSpecialization"=>$subject->subject_specialization_id,"subject"=>$subject->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subject
                                        Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name',$subject->name)}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >Specialization</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('department') is-invalid @enderror"
                                                name="subject_specialization_id">
                                            @foreach($specializations as $specialization)
                                                <option value="{{$specialization->id}}"
                                                    {{$specialization->id==$subject->subject_specialization_id?' selected':''}}>
                                                    {{$specialization->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('department') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Archived --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Archived</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror"
                                                   type="radio" name="archived" id="archived1"
                                                   value="1" {{$subject->archived == 1 ?' checked ':''}}>
                                            <label class="form-check-label" for="archived1">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror"
                                                   type="radio" name="archived" id="archived2"
                                                   value="0" {{$subject->archived == 0 ?' checked ':''}}>
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
                                        <button type="submit" class="btn btn-primary">Save Updates</button>
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
