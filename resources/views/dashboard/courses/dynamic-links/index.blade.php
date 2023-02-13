@extends('layouts.dashboard-master')

@section('title','Manage Course DynamicLinks')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Course DynamicLinks</h1>
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
                                    @if(count($dynamicLinks)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Link</th>
                                                <th>Charging Code</th>
                                                <th>Created At</th>
                                                <th>Used At</th>
                                                <th></th>
                                            </tr>
                                            @foreach($dynamicLinks as $dynamicLink)
                                                <tr>
                                                    <td>{{ $dynamicLink->link }}</td>
                                                    <td>
                                                        <a href="{{ route('dashboard.charging-codes.show', $dynamicLink->chargingCode->id) }}"
                                                        >{{ $dynamicLink->chargingCode->code }}</a>
                                                    </td>
                                                    <td>{{ $dynamicLink->created_at }}</td>
                                                    <td>{{ $dynamicLink->chargingCode->used_at }}</td>

                                                    <td class="text-right">

                                                        @can('view-course-sessions')
                                                            <a href="{{route('dashboard.courses.dynamic-links.show',
                                                            ["course"=>$course->id,"dynamic_link"=>$dynamicLink->id]
                                                            )}}"
                                                               class="btn btn-warning"><i class="fa fa-eye"></i>
                                                            </a>
                                                        @endcan

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
                        @if(count($dynamicLinks)>0)
                            <div class="text-center">
                                {{$dynamicLinks->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
