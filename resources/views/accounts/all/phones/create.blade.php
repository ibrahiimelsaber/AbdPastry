@extends('layouts.dashboard-master')

@section('title','Create Phone')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Phone</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('all.account.phones.index', $account->Id)}}"
               class="ml-2 btn btn-primary">Go To Phones</a>
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
                            <h4>Add a New Phone</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('all.account.phones.store') }}"
                                  enctype="multipart/form-data">
                                @csrf


                                <input name="AccountId" value="{{$account->Id}}" hidden/>


                                <!--  -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Account Id</label>
                                    <div class="col-sm-12 col-md-4">
                                        <input type="text" name="accountId" value="{{$account->Id}}"
                                               class="form-control font-weight-bolder text-center" disabled/>

                                        @error('TypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('TypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Account Name</label>
                                    <div class="col-sm-12 col-md-4">
                                        <input type="text" name="Name" value="{{$account->Name}}"
                                               class="form-control font-weight-bolder text-center" disabled/>

                                        @error('Phone')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Phone') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Phone Type -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Phone Type</label>
                                    <div class="col-sm-12 col-md-4">
                                        <select class="form-control @error('TypeId') is-invalid @enderror"
                                                name="TypeId" id="TypeId">
                                            @foreach($phoneTypes as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>

                                        @error('TypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('TypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Phone Number</label>
                                    <div class="col-sm-12 col-md-4">
                                        <input type="number" name="Phone" min="0"
                                               class="form-control @error('Phone') is-invalid @enderror"/>

                                        @error('Phone')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Phone') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save New Phone</button>
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
