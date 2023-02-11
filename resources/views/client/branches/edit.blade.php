@extends('layouts.dashboard-master')

@section('title','Edit Service Request')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Service Request</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('branch.requests.index',$request->BranchId)}}"
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
                            <h4>Update Service Request</h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('branch.requests.update',$request->Id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!--Status-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Status</label>
                                    <div class="col-sm-12 col-md-9">
                                        <select class="form-control @error('StatusId') is-invalid @enderror"
                                                name="StatusId" id="StatusId">
                                            @foreach($status as $id => $value)
                                                <option
                                                    {{$request->status->Id==$id?' selected ':''}}    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('StatusId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('StatusId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                    <!--Resolution-->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1">Resolution</label>
                                        <div class="col-sm-12 col-md-9">
                                            <textarea name="resolution"     class="form-control @error('resolution') is-invalid @enderror"> {{old('resolution', $request->resolution)}}</textarea>
                                            @error('resolution')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('resolution') }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Update Service Request</button>
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
                        url: '/getSubTypes/' + TypeID,
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
                        url: '/getSubProducts/' + ProductId,
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
