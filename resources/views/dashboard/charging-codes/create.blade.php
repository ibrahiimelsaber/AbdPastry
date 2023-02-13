@extends('layouts.dashboard-master')

@section('title','Generate Charging Code')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Generate Charging Codes</h1>
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
                            <h4>Generate New Charging Codes</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.charging-codes.store') }}">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Money Amount</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="money" value="{{old('money')}}"
                                               class="form-control @error('money') is-invalid @enderror"
                                               placeholder="Money-amount charged per code" required>
                                        @error('money')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('money') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
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
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Number of Codes</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" min="1" name="count" value="{{old('count')}}"
                                               class="form-control @error('count') is-invalid @enderror"
                                               placeholder="How many charging codes do you want?" required>
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
