@extends('layouts.dashboard-master')

@section('title','Edit Account, '.$account->Name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Edit Account</h1>
            <h1 class="ml-2">|| </h1>
            <button class="ml-2 btn btn-primary" onclick="history.back()">Return Back</button>

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
                            <form method="POST" action="{{ route('all.accounts.update',$account->Id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')



                                <!-- Account Type -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Account
                                        Type</label>
                                    <div class="col-sm-12 col-md-4">
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


                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Account Name</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="Name" value="{{old('name',$account->Name)}}"
                                               class="form-control @error('Name') is-invalid @enderror"/>


                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <!-- Account Phone Type -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Phone
                                        Type</label>
                                    <div class="col-sm-12 col-md-4">
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

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Phone
                                        Number</label>
                                    <div class="col-sm-12 col-md-4">
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
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Gender</label>
                                    <div class="col-sm-12 col-md-4">
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

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Address</label>
                                    <div class="col-sm-12 col-md-4">
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
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">City</label>
                                    <div class="col-sm-12 col-md-9">
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
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Area</label>
                                    <div class="col-sm-12 col-md-9">
                                        <select class="form-control area-search @error('DistrictId') is-invalid @enderror"
                                                name="AreaId" id="AreaId">
                                            <option value="{{optional($account->area)->Id}}">{{optional($account->area)->Name}}</option>
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
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Call
                                        Source</label>
                                    <div class="col-sm-12 col-md-9">
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

                                <!-- Account Comments -->
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label  col-12 col-md-2 col-lg-1">Comments</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" name="Comments" value="{{old('Comments',$account->Comments)}}"
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
                                $('#AreaId').append('<option hidden value="0">Choose Area</option>');
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
