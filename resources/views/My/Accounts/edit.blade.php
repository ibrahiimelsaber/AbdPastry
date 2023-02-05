@extends('layouts.dashboard-master')

@section('title','Edit Account, '.$account->Name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Edit Account</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('my.accounts')}}"
               class="ml-2 btn btn-primary">Return Back
            </a>

            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Account</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('my.accounts.update',$account->Id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


                                <!-- Account Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Account
                                        Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Name" value="{{old('name',$account->Name)}}"
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
                                                    {{$account->AccountTypeId==$id?' selected ':''}} value="{{$id}}">{{$value}}</option>
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
                                                    {{$account->PhoneTypeId==$id?' selected ':''}} value="{{$id}}">{{$value}}</option>
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
                                               value="{{old('PhoneNumber',$account->PhoneNumber)}}"
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
                                                    {{$account->GenderId==$id?' selected ':''}} value="{{$id}}">{{$value}}</option>
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
                                        <input type="text" name="Address" value="{{old('Address',$account->Address)}}"
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
                                                    {{$account->CityId==$id?' selected ':''}} value="{{$id}}">{{$value}}</option>
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
                                                name="AreaId" id="AreaId">
                                            <option value="{{$account->area->Id}}">{{$account->area->Name}}</option>
{{--                                            @foreach($districts as $id => $value)--}}
{{--                                                <option--}}
{{--                                                    {{$account->DistrictId==$id?' selected ':''}} value="{{$id}}">{{$value}}</option>--}}
{{--                                            @endforeach--}}
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
                                                    {{$account->call_source==$id?' selected ':''}} value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('call_source')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('call_source') }}</p>
                                        </div>
                                        @enderror
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
                // console.log(CityId)
                if (CityId) {
                    $.ajax({
                        url: '/getAreas/' + CityId,
                        type: "GET",
                        data: {"_token": "{{ csrf_token() }}"},
                        dataType: "json",
                        success: function (data) {
                            if (data) {
                                $('#AreaId').empty();
                                $('#AreaId').append('<option hidden>Choose District</option>');
                                $.each(data, function (key, val) {
                                    // console.log('<option value="'+ key +'">' + val+ '</option>');
                                    $('select[name="AreaId"]').append('<option value="' + key + '">' + val + '</option>');
                                });
                            } else {
                                $('#AreaId').empty();
                            }
                        }
                    });
                } else {
                    $('#AreaId').empty();
                }
            });

        });
    </script>
@endsection
