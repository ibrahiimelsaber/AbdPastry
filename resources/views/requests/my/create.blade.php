@extends('layouts.dashboard-master')

@section('title','Create Service Request')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Service Request</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('my.requests.index',$contact->Id)}}"
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
                            <h4>Add a New Service Request</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('my.contact.requests.store') }}"
                                  enctype="multipart/form-data">
                                @csrf


                                <input type="hidden" name="ContactId" value="{{$contact->Id}}">


                                <!--Status and Direction-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Status</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('StatusId') is-invalid @enderror"
                                                name="StatusId" id="StatusId">
                                            @foreach($status as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('StatusId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('StatusId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Call Direction</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('CallDirectionId') is-invalid @enderror"
                                                name="CallDirectionId" id="CallDirectionId">
                                            @foreach($directions as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('CallDirectionId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('CallDirectionId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!--SR Type and Sub Type-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">SR Type</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('TypeId') is-invalid @enderror"
                                                name="TypeId" id="TypeId">
                                            <option hidden>Choose Sr Type</option>
                                            @foreach($srTypes as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('TypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('TypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">SR Sub Type</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('SubTypeId') is-invalid @enderror"
                                                name="SubTypeId" id="SubTypeId"></select>
                                        @error('SubTypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('SubTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- SR Sub Sub Type-->
                                <div class="form-group row mb-4 invisibleDiv" id="subsubDiv">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">SR Sub Sub Type</label>
                                    <div class="col-sm-12 col-md-9">
                                        <select class="form-control @error('SubSubType') is-invalid @enderror"
                                                name="SubSubType" id="SubSubType"></select>

                                        @error('SubSubType')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('SubSubType') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!--Product and Sub Product-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Products</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('ProductId') is-invalid @enderror"
                                                name="ProductId" id="ProductId">
                                            <option hidden>Choose Product</option>
                                            @foreach($products as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('ProductId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('ProductId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Sub Product</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('SubProductId') is-invalid @enderror"
                                                name="SubProductId" id="SubProductId">

                                        </select>
                                        @error('SubProductId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('SubProductId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!--Complaint Type and Branch-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Complaint Type</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('ComplaintTypeId') is-invalid @enderror"
                                                name="ComplaintTypeId" id="ComplaintTypeId">
                                            @foreach($complaintsTypes as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('ComplaintTypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('ComplaintTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Branches</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('BranchId') is-invalid @enderror"
                                                name="BranchId" id="BranchId">
                                            @foreach($branches as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('BranchId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('BranchId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Customer Comments -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Customer Comments</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" name="CustomerComments"
                                               class="form-control @error('CustomerComments') is-invalid @enderror"/>

                                        @error('CustomerComments')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('CustomerComments') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Agent Comments -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Agent Comments</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" name="AgentComments"
                                               class="form-control @error('AgentComments') is-invalid @enderror"/>

                                        @error('AgentComments')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('AgentComments') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save New Service Request</button>
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
