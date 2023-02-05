@extends('layouts.dashboard-master')

@section('title','All Sessions')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>All sessions</h1>
        </div>
        @include('dashboard.common._alert_message')
        @include('dashboard.common._alert_validation_errors')
        <div class="section-body">
            @can('view-course-sessions')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Sessions <span>({{ $total }})</span></h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($sessions)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Session</th>
                                                <th>Video LastUpdate</th>
                                                <th>Secret</th>
                                                <th>Video URL</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sessions as $session)
                                                <form id="{{"session".$session->id."form"}}"
                                                      action="{{ route('dashboard.sessions.update',$session->id) }}"
                                                      method="POST" style="display: none;">
                                                    @method('PUT')
                                                    @csrf
                                                    <tr>
                                                        <td>
                                                            <div>{{ $session->title }}</div>
                                                            <div class="small text-muted">
                                                                {{ $session->course->name ?? "" }}
                                                            </div>
                                                        </td>
                                                        <td>{{ $session->external_video_last_update}}</td>
                                                        <td>
                                                            <div>{{ $session->youtube_video_id}}</div>
                                                            <div class="small text-muted">
                                                                {{ $session->session_type }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <textarea name="external_video"
                                                                  rows="3" {{$session->session_type != "EXTERNAL_VIDEO"?' disabled':''}}>{{ $session->external_video}}</textarea>
                                                        </td>
                                                        <td class="text-right">
                                                            @can('edit-course-sessions')
                                                                @if($session->session_type == "EXTERNAL_VIDEO")
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                                                @else
                                                                    <button class="btn btn-dark" disabled><i class="fa fa-edit"></i></button>
                                                                @endif
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                </form>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any Sessions yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($sessions)>0)
                            <div class="text-center">
                                {{$sessions->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
