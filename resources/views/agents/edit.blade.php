@extends('layouts.dashboard-master')

@section('title','Edit Agent')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Agent</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('agents.index')}}"
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
                            <h4>Update Agent</h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('agents.update',$user->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')



                                <!-- Agent Name -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Agent Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="username" value="{{old('username',$user->username)}}"
                                               class="form-control @error('username') is-invalid @enderror"/>

                                        @error('username')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('username') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Agent Image -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Agent Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="image" id="formFileLg"
                                               value="{{$user->name}}"
                                               class="form-control form-control-file border border-danger @error('image') is-invalid @enderror"/>
                                        @error('image')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('image') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div>

                                    </div>
                                </div>

                                <input type="text" name="old_path" value="{{$user->path}}" hidden>
                                <input type="text" name="old_name" value="{{$user->name}}" hidden>

                                <!-- Agent Percentage -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Agent Percentage</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="percentage" max="100"
                                               value="{{old('percentage',$user->percentage)}}"
                                               class="form-control @error('percentage') is-invalid @enderror"/>

                                        @error('percentage')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('percentage') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Update Agent</button>
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
                        url: "{{ url('/getSubTypes') }}" + "/" + TypeID,
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
                        url: "{{ url('/getSubProducts') }}" + "/" + ProductId,
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
