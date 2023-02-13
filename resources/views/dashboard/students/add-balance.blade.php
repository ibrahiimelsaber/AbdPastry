@extends('layouts.dashboard-master')

@section('title','Add Balance to '.$student->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Balance to {{$student->name}}</h1>
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
                                <div class="col-sm-6 col-md-2">
                                    <input disabled type="text" value="{{$moneyAccount->balance}} EGP"
                                           class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Add Balance Details</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.students.addBalance',$student->id) }}">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Amount</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="amount" value="{{old('amount')}}"
                                               class="form-control @error('amount') is-invalid @enderror"
                                               placeholder="Balance amount">
                                        @error('amount')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('amount') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Notes</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="notes" value="{{old('notes')}}"
                                               class="form-control @error('notes') is-invalid @enderror"
                                               placeholder="Notes of this transaction">
                                        @error('notes')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('notes') }}</p>
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
