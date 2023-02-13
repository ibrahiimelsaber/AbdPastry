@extends('layouts.dashboard-master')

@section('title','Create Field')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Add Field</h1></div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Add a New Field</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.fields.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Field Label</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="label" value="{{old('label')}}"
                                               class="form-control @error('label') is-invalid @enderror">
                                        @error('label')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('label') }}</p>
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
