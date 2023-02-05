@extends('layouts.dashboard-master')

@section('title', 'Single DynamicLink of Course')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Single DynamicLink of Course</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>Course</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Teacher</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$course->teacher->name ?? ''}}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Dynamic Link</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$dynamicLink->link}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Created At</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" value="{{ $dynamicLink->chargingCode->created_at }}"
                                           class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Expires At</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" value="{{ $dynamicLink->chargingCode->expires_at }}"
                                           class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Used By Student</label>
                                @if($dynamicLink->chargingCode->used_by_user_id)
                                    <div class="col-sm-9 col-md-5">
                                        <input disabled type="text" value="{{ $dynamicLink->chargingCode->usedByUser->name ?? '' }}" class="form-control">
                                    </div>
                                    <div class="col-sm-3 col-md-2">
                                        <a href="{{route('dashboard.students.show', $dynamicLink->chargingCode->used_by_user_id)}}"
                                           class="btn btn-outline-info btn-block">
                                            <i class="fa fa-user"></i> View Student</a>
                                    </div>
                                @else
                                    <div class="col-sm-12 col-md-7">
                                        <input disabled type="text" value="Not used yet" class="form-control">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Used At</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" value="{{ $chargingCodeUsedAt }}" class="form-control" disabled>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
