@extends('layouts.dashboard-master')

@section('title','Show Session: '.$session->title)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Show Course Session</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.courses.sessions.edit',["course"=>$course->id,"session"=>$session->id])}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Edit Course Session
                </a>
                <a href="{{route('dashboard.courses.sessions.index', $course->id)}}"
                       class="btn btn-outline-primary ml-1">Back to all Sessions</a>
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Session Title</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$session->title}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$session->course->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Teacher Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$session->teacher->name}} (YOU)" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Free Preview</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$session->free_preview == 1 ? 'YES' : 'NO'}}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Session Type</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{$session->session_type}}" class="form-control">
                                </div>
                                @if($session->session_type==\App\Http\Enums\CourseSessionTypes::INTERNAL_VIDEO)
                                    <div class="col-12">
                                        <div class="col text-center">
                                            @if( $videoUrl != "")
                                                <video width="320" height="240" controls>
                                                    <source src="{{ $videoUrl }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                No video uploaded!
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if($session->session_type==\App\Http\Enums\CourseSessionTypes::EXTERNAL_VIDEO)
                                    <div class="col-12">
                                        <div class="col text-center">
                                            @if( $session->external_video !=null)
                                                <video width="320" height="240" controls>
                                                    <source src="{{ $session->external_video }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                No external video URL attached!
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Available From</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="datetime-local"
                                           value="{{\Carbon\Carbon::parse($session->available_from)->format('Y-m-d\TH:i')}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Available To</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="datetime-local"
                                           value="{{\Carbon\Carbon::parse($session->available_to)->format('Y-m-d\TH:i')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
