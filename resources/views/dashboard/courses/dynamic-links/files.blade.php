@extends('layouts.dashboard-master')

@section('title', 'Manage Course DynamicLinks Files')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Course DynamicLinks Files</h1>
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
            @can('view-course-dynamic-links')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Course DynamicLinks <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-course-sessions')
                                        <a href="{{route('dashboard.courses.dynamic-links.create', $course->id)}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Generate DynamicLinks</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($files)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>File Name</th>
                                                <th>DynamicLinks Count</th>
                                                <th>Created At</th>
                                                <th>Expires At</th>
                                                <th></th>
                                            </tr>
                                            @foreach($files as $file)
                                                <tr>
                                                    <td>{{ $file->file_name }}</td>
                                                    <td>{{ $file->count }}</td>
                                                    <td>{{ $file->created_at }}</td>
                                                    <td>{{ $file->expires_at }}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('dashboard.courses.dynamic-links.files.download',['course'=>$course->id,'file'=>$file->id])}}"
                                                           class="btn btn-dark"><i class="fas fa-file-download"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any dynamic links yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($files)>0)
                            <div class="text-center">
                                {{$files->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
