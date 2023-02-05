@extends('layouts.dashboard-master')

@section('title','Generate Course DynamicLinks')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Generate DynamicLinks for a Course</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-body">

                    <div class="card-stats">
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-label">Course</div>
                                <div class="card-stats-item-count">{{$course->name}}</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    @include('dashboard.common._alert_validation_errors')
                    <div class="card">
                        <div class="card-header">
                            <h4>Generate DynamicLinks</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.courses.dynamic-links.index',[$course->id]) }}">
                                @csrf

                                {{-- Expires At --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Expires At</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" name="expires_at" value="{{old('expires_at')}}"
                                               class="form-control @error('expires_at') is-invalid @enderror"
                                               placeholder="Charging Codes will expire at date.." required>
                                        @error('expires_at')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('expires_at') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Number of Codes --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Number of Codes</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" min="1" name="count" value="{{old('count')}}"
                                               class="form-control @error('count') is-invalid @enderror"
                                               placeholder="How many dynamic links do you want?" required>
                                        @error('count')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('count') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Generate</button>
                                        <a href="{{url()->previous()}}" class="btn btn-outline-dark">Cancel</a>
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
