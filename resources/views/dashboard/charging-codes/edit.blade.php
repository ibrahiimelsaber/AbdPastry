@extends('layouts.dashboard-master')

@section('title','Edit A charging Code '.$chargingCode->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit A charging Code</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @if(session('message'))
                        <div class="alert {{ session('class') }} alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert"><span>×</span></button>
                                {{ session('message') }}
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit A charging Code</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.charging-codes.update',$chargingCode->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Expires At</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" name="expires_at"
                                               value="{{old('expires_at',$chargingCode->expires_at)}}"
                                               class="form-control @error('expires_at') is-invalid @enderror">
                                        @error('expires_at')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('expires_at') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Level</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" min="1" max="3" name="level"
                                               value="{{old('level',$chargingCode->level)}}"
                                               class="form-control @error('level') is-invalid @enderror"
                                               placeholder="Level should be 1, 2, or 3" required>
                                        @error('level')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('level') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Code</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" value="{{$chargingCode->code}}" class="form-control" disabled>
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
