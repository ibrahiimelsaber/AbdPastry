@extends('layouts.dashboard-master')

@section('title','Edit Activity')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Activity</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('all.account.contact.request.activities.index',$activity->request->Id)}}"
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
                            <h4>Update Activity</h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('all.account.contact.request.activities.update', $activity->Id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


                                <input type="hidden" name="SRId" value="{{$activity->request->Id}}">


                                <!--Call Status and Call Back Status-->

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Call Status</label>
                                    <div class="col-sm-6 col-md-2">
                                        <select class="form-control @error('CallStatusId') is-invalid @enderror"
                                                name="CallStatusId" id="CallStatusId">
                                            @foreach($activityCallStatus as $id => $value)
                                                <option
                                                    {{$activity->CallStatusId==$id?' selected ':''}}     value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('CallStatusId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('CallStatusId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Call Back Status</label>
                                    <div class="col-sm-6 col-md-3">
                                        <select class="form-control @error('CallBackStatusId') is-invalid @enderror"
                                                name="CallBackStatusId" id="CallBackStatusId">
                                            @foreach($activityCallBackStatus as $id => $value)
                                                <option
                                                    {{$activity->CallBackStatusId==$id?' selected ':''}}      value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('CallBackStatusId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('CallBackStatusId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Contact Trial</label>
                                    <div class="col-sm-6 col-md-2">
                                        <input type="number" name="ContactTrial" min="0" max="100" value="{{old('ContactTrial',$activity->ContactTrial)}}"
                                               class="form-control @error('ContactTrial') is-invalid @enderror"/>
                                        @error('ContactTrial')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('ContactTrial') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!--Activity Type and Sub Type-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Activity Type</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('ActTypeId') is-invalid @enderror"
                                                name="ActTypeId" id="ActTypeId">
                                            <option hidden>Choose Activity Type</option>
                                            @foreach($activityTypes as $id => $value)
                                                <option
                                                    {{$activity->ActTypeId==$id?' selected ':''}}      value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('ActTypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('ActTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Activity Sub Type</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('ActSubTypeId') is-invalid @enderror"
                                                name="ActSubTypeId" id="ActSubTypeId">
                                            <option hidden>Choose Activity Sub Type</option>
                                            @foreach($activitySubTypes as $id => $value)
                                                <option
                                                    {{$activity->ActSubTypeId==$id?' selected ':''}}     value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('ActSubTypeId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('ActSubTypeId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>



                                <!--Branch and focal point-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Branches</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('BranchId') is-invalid @enderror"
                                                name="BranchId" id="BranchId">
                                            @foreach($branches as $id => $value)
                                                <option
                                                    {{$activity->BranchId==$id?' selected ':''}}        value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('BranchId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('BranchId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Focal Point Branch Status</label>



                                    <div class="col-sm-6 col-md-4">
                                        <select class="form-control @error('FocalPointId') is-invalid @enderror"
                                                name="FocalPointBranchStatusId" id="FocalPointBranchStatusId">
                                            @foreach($activityFocalPointBranchStatus as $id => $value)
                                                <option
                                                    {{$activity->FocalPointBranchStatusId==$id?' selected ':''}}         value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('FocalPointBranchStatusId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('FocalPointBranchStatusId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <!-- Customer Comments -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Customer Activity Comments</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" name="CustomerActivityComments" value="{{old('CustomerActivityComments',$activity->CustomerActivityComments)}}"
                                               class="form-control @error('CustomerActivityComments') is-invalid @enderror"/>

                                        @error('CustomerActivityComments')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('CustomerActivityComments') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Agent Comments -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Customer Activity Agent Comments</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" name="CustomerActivityAgentComments" value="{{old('CustomerActivityAgentComments',$activity->CustomerActivityAgentComments)}}"
                                               class="form-control @error('CustomerActivityAgentComments') is-invalid @enderror"/>

                                        @error('CustomerActivityAgentComments')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('CustomerActivityAgentComments') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Update Activity</button>
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
