@extends('layouts.dashboard-master')

@section('title','Create Contact')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Contact</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('my.account.contacts.index',$account->Id)}}"
               class="ml-2 btn btn-primary">Return Back</a>
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
                            <h4>Add a New Contact</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('my.account.contacts.store') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="accountId" value="{{$account->Id}}">

                                <!--Account Id-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Account
                                        Id</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text"  value="{{old('Id',$account->Id)}}"
                                               class="form-control @error('AccountId') is-invalid @enderror" disabled/>

                                        @error('AccountId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('AccountId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Contact Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Account
                                        Name</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text"  value="{{old('Name',$account->Name)}}"
                                               class="form-control @error('Name') is-invalid @enderror" disabled/>

                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Account Type -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Account
                                        Type</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text"  value="{{old('AccountTypeId',optional($account->Type)->Name)}}"
                                               class="form-control @error('AccountTypeId') is-invalid @enderror" disabled/>

                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>




























                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Phone Type</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('PhoneTypeId') is-invalid @enderror"
                                                name="PhoneTypeId" id="PhoneTypeId">
                                            @foreach($phoneTypes as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('PhoneTypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('PhoneTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>


                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Phone Number</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="number" name="PhoneNumber" min="0"
                                               class="form-control @error('PhoneNumber') is-invalid @enderror"/>

                                        @error('PhoneNumber')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('PhoneNumber') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>




                                <!-- Contact Gender -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Gender</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('GenderId') is-invalid @enderror"
                                                name="GenderId" id="gender">
                                            @foreach($gender as $id => $value)
                                                <option
                                                     value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('GenderId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('GenderId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Age</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="number" name="AgeId"  min="15" max="100"
                                               class="form-control @error('AgeId') is-invalid @enderror"/>

                                        @error('AgeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('AgeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <!-- Contact Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Title</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('TitleId') is-invalid @enderror"
                                                name="TitleId" id="title">
                                            @foreach($titles as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('TitleId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('TitleId') }}</p>
                                        </div>
                                        @enderror
                                    </div>


                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Contact
                                        Name</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="Name"
                                               class="form-control @error('Name') is-invalid @enderror"/>

                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                <!-- Contact Job Title -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Job Title</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="JobTitle"
                                               class="form-control @error('JobTitle') is-invalid @enderror"/>

                                        @error('TitleId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('JobTitle') }}</p>
                                        </div>
                                        @enderror
                                    </div>


                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Email</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="Email"
                                               class="form-control @error('Email') is-invalid @enderror"/>

                                        @error('Email')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Email') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <!-- Contact Comments -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Comments</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" name="Comments"
                                               class="form-control @error('Comments') is-invalid @enderror"/>

                                        @error('Comments')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Comments') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
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
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.city-search').select2();
            $('.area-search').select2();
            $('.call-search').select2();
        });
    </script>
@endsection
