@extends('layouts.dashboard-master')

@section('title','Manage Course sessions')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Course sessions</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-body">

                    <div class="card-stats">
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-label">Course</div>
                                <div class="card-stats-item-count">{{$course->name}}</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @can('view-course-sessions')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Course Sessions <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-course-sessions')
                                        <a href="{{route('dashboard.courses.sessions.create', $course->id)}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Course
                                            Session</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($course_sessions)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Title</th>
                                                <th>Free Preview</th>
                                                <th>Session Type</th>
                                                <th>Available From</th>
                                                <th>Available To</th>
                                                <th></th>
                                            </tr>
                                            @foreach($course_sessions as $course_session)
                                                <tr>
                                                    <td>{{ $course_session->title }}</td>
                                                    <td>{{ $course_session->free_preview === 1 ? 'Yes' : 'No' }}</td>
                                                    <td>{{ $course_session->session_type}}</td>
                                                    <td>{{ Carbon\Carbon::parse($course_session->available_from)->format("Y-m-d")}}</td>
                                                    <td>{{ Carbon\Carbon::parse($course_session->available_to)->format("Y-m-d")}}</td>
                                                    <td class="text-right">

                                                        @can('view-course-sessions')
                                                            <a href="{{route('dashboard.courses.sessions.show',
                                                            ["course"=>$course->id,"session"=>$course_session->id]
                                                            )}}"
                                                               class="btn btn-warning"><i class="fa fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        @can('edit-course-sessions')
                                                            <a href="{{route('dashboard.courses.sessions.edit',
                                                            ["course"=>$course->id,"session"=>$course_session->id]
                                                            )}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        {{--                                                        @can('delete-course-sessions')--}}
                                                        {{--                                                            <button class="btn btn-danger delete"--}}
                                                        {{--                                                                    data-id="{{$course_session->id}}" type="button">--}}
                                                        {{--                                                                <i class="fa fa-trash"></i>--}}
                                                        {{--                                                            </button>--}}
                                                        {{--                                                        @endcan--}}

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any sessions yet!</p>
                                        </div>
                                    @endif
                                </div>
                                {{--<div class="text-center p-4 text-muted">
                                    <h5>Loading</h5>
                                    <p>Please wait, data is being loaded...</p>
                                </div>--}}
                            </div>
                        </div>
                        @if(count($course_sessions)>0)
                            <div class="text-center">
                                {{$course_sessions->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection

{{--@section('scripts')--}}
{{--    @include('dashboard.common._modal_delete')--}}
{{--@endsection--}}
