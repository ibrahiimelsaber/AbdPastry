@extends('layouts.dashboard-master')

@section('title','Edit User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update User</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('users.index')}}"
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
                            <h4>Update User</h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('users.update',$user->Id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')



                                <!-- User Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">User Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Username" value="{{old('Username',$user->Username)}}"
                                               class="form-control @error('Username') is-invalid @enderror"/>

                                        @error('Username')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Username') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>



                                <!--Call Status and Call Back Status-->

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">User Group</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('GroupId') is-invalid @enderror"
                                                name="GroupId" id="GroupId">

                                            <option {{$user->GroupId==1?' selected ':''}}  value="1">Agent</option>
                                            <option {{$user->GroupId==2?' selected ':''}}  value="2">Team Leader</option>

                                        </select>
                                        @error('GroupId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('GroupId') }}</p>
                                        </div>
                                        @enderror
                                    </div>


                                </div>


                                <!--Call Status and Call Back Status-->

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">User Activation</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('Active') is-invalid @enderror"
                                                name="Active" id="Active">

                                            <option {{$user->Active==1?' selected ':''}}  value="1">Active</option>
                                            <option {{$user->Active==0?' selected ':''}}  value="0">Deactivate</option>

                                        </select>
                                        @error('Active')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Active') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Update User</button>
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
            $('#TypeId').on('change', function () {
                var TypeID = $(this).val();
                if (TypeID) {
                    $.ajax({
                        url: "{{ url('/getSubTypes') }}"+"/"+TypeID,
                        type: "GET",
                        data: {"_token": "{{ csrf_token() }}"},
                        dataType: "json",
                        success: function (data) {
                            if (data) {
                                $('#SubTypeId').empty();
                                $('#SubTypeId').append('<option hidden>Choose Sub Type</option>');
                                $.each(data, function (key, val) {
                                    // console.log('<option value="'+ key +'">' + val+ '</option>');
                                    $('select[name="SubTypeId"]').append('<option value="' + key + '">' + val + '</option>');
                                });
                            } else {
                                $('#SubTypeId').empty();
                            }
                        }
                    });
                } else {
                    $('#SubTypeId').empty();
                }
            });


            $('#ProductId').on('change', function () {
                var ProductId = $(this).val();
                if (ProductId) {
                    $.ajax({
                        url: "{{ url('/getSubProducts') }}"+"/"+ProductId,
                        type: "GET",
                        data: {"_token": "{{ csrf_token() }}"},
                        dataType: "json",
                        success: function (data) {
                            if (data) {
                                $('#SubProductId').empty();
                                $('#SubProductId').append('<option hidden>Choose Sub Product</option>');
                                $.each(data, function (key, val) {
                                    // console.log('<option value="'+ key +'">' + val+ '</option>');
                                    $('select[name="SubProductId"]').append('<option value="' + key + '">' + val + '</option>');
                                });
                            } else {
                                $('#SubProductId').empty();
                            }
                        }
                    });
                } else {
                    $('#SubProductId').empty();
                }
            });

            $('#SubTypeId').on('change', function () {
                var SubTypeId = $(this).val();
                if (SubTypeId == 782) {
                    $('#subsubDiv').removeClass('invisibleDiv');
                    if (SubTypeId) {
                        $.ajax({
                            url: '/getSubSubType/' + SubTypeId,
                            type: "GET",
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {

                                if (data) {
                                    $('#SubSubType').empty();
                                    $('#SubSubType').append('<option hidden>Choose Sub Sub Product</option>');
                                    $.each(data, function (key, val) {
                                        // console.log('<option value="' + key + '">' + val + '</option>');
                                        $('select[name="SubSubType"]').append('<option value="' + key + '">' + val + '</option>');
                                    });
                                } else {
                                    $('#SubSubType').empty();
                                }
                            }
                        });
                    } else {
                        $('#SubSubType').empty();
                    }
                } else {
                    $('#SubSubType').empty();
                    $('#subsubDiv').addClass('invisibleDiv');

                }

            });
        });
    </script>
@endsection
