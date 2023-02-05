@extends('layouts.dashboard-master')

@section('title','Create Banned-Word')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Banned-Word</h1>
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
                            <h4>Add a New Banned-Word</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.banned-words.store') }}">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Word</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="word" value="{{old('word')}}"
                                               class="form-control @error('word') is-invalid @enderror">
                                        @error('word')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('word') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('category') is-invalid @enderror" name="category">
                                            <option {{old('category')=='ABUSE'?' selected':''}}>ABUSE</option>
                                            <option {{old('category')=='POLITICAL'?' selected':''}}>POLITICAL</option>
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('category') }}</p>
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
