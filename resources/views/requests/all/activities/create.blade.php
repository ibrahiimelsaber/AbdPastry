@extends('layouts.dashboard-master')

@section('title','Create Activity')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Activity</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('all.request.activities.index',$sr->Id)}}"
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
                            <h4>Add a New Activity</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('all.request.activities.store') }}"
                                  enctype="multipart/form-data">
                                @csrf


                                <input type="hidden" name="SRId" value="{{$sr->Id}}">


                                <!--Call Status and Call Back Status-->

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1">Call Status</label>
                                    <div class="col-sm-6 col-md-2">
                                        <select class="form-control @error('CallStatusId') is-invalid @enderror"
                                                name="CallStatusId" id="CallStatusId">
                                            @foreach($activityCallStatus as $id => $value)
                                                <option
                                                    value="{{$id}}">{{$value}}</option>
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
                                                    value="{{$id}}">{{$value}}</option>
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
                                        <input type="number" name="ContactTrial" min="0" max="100"
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
                                                    value="{{$id}}">{{$value}}</option>
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
                                                    value="{{$id}}">{{$value}}</option>
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
                                                    value="{{$id}}">{{$value}}</option>
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
                                                    value="{{$id}}">{{$value}}</option>
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
                                        <input type="text" name="CustomerActivityComments"
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
                                        <input type="text" name="CustomerActivityAgentComments"
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
                                        <button type="submit" class="btn btn-primary">Save New Activity</button>
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
