@extends('layouts.dashboard-master')

@section('title','Create Account')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Account</h1>
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
                            <h4>Add a New Account</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('my.accounts.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Account
                                        Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Name"
                                               class="form-control @error('Name') is-invalid @enderror"/>

                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Account Type -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Account
                                        Type</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('AccountTypeId') is-invalid @enderror"
                                                name="AccountTypeId" id="accountTypes_list">
                                            @foreach($accountTypes as $id => $value)
                                                <option
                                                   value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('AccountTypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('AccountTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Account Phone Type -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone
                                        Type</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('AccountTypeId') is-invalid @enderror"
                                                name="PhoneTypeId" id="phonetypes">
                                            @foreach($phoneTypes as $id => $value)
                                                <option
                                                   value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('PhoneTypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('PhoneTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Account Phone Number -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone
                                        Number</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="PhoneNumber"

                                               class="form-control @error('PhoneNumber') is-invalid @enderror"/>

                                        @error('PhoneNumber')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('PhoneNumber') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Account Gender -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gender</label>
                                    <div class="col-sm-12 col-md-7">
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
                                </div>

                                <!-- Account Address -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Address"
                                               class="form-control @error('Address') is-invalid @enderror"/>

                                        @error('Address')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Address') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Account City -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">City</label>
                                    <div class="col-sm-12 col-md-6">
                                        <select
                                            class="form-control city-search @error('CityId') is-invalid @enderror"
                                            name="CityId" id="CityId">
                                            @foreach($cities as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('CityId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('AccountTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Account District -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">District</label>
                                    <div class="col-sm-12 col-md-6">
                                        <select class="form-control area-search @error('DistrictId') is-invalid @enderror"
                                                name="DistrictId" id="DistrictId">

                                        </select>
                                        @error('DistrictId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('DistrictId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>



                                <!-- Account District -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Call
                                        Source</label>
                                    <div class="col-sm-12 col-md-6">
                                        <select class="form-control call-search @error('call_source') is-invalid @enderror"
                                                name="call_source" id="call_source">
                                            @foreach($callSource as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('call_source')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('call_source') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Account Comments -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Comments</label>
                                    <div class="col-sm-12 col-md-7">
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
@section('scripts')


    <script>
        $(document).ready(function () {
            $('.city-search').select2();
            $('.area-search').select2();
            $('.call-search').select2();
        });
    </script>



        <script>
            $(document).ready(function () {
                $('#CityId').on('change', function () {
                    var CityId = $(this).val();
                    if (CityId) {
                        $.ajax({
                            url: '/getAreas/' + CityId,
                            type: "GET",
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {
                                if (data) {
                                    $('#DistrictId').empty();
                                    $('#DistrictId').append('<option hidden>Choose Sub District</option>');
                                    $.each(data, function (key, val) {
                                        console.log('<option value="'+ key +'">' + val+ '</option>');
                                        $('select[name="DistrictId"]').append('<option value="' + key + '">' + val + '</option>');
                                    });
                                } else {
                                    $('#DistrictId').empty();
                                }
                            }
                        });
                    } else {
                        $('#DistrictId').empty();
                    }
                });

            });
        </script>


@endsection
