@extends('layouts.dashboard-master')

@section('title','Manage Courses')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Courses</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-courses')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Courses <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-courses')
                                        <a href="{{route('dashboard.courses.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Course</a>

                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($courses)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Subject') }}</th>
                                                <th>{{ __('Teacher') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Archived') }}</th>
                                                <th>{{ __('Hidden') }}</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $course)
                                                <tr>

                                                    <td>{{ $course->name }}</td>

                                                    <td>
                                                        <div>{{ $course->subject_name??'' }}</div>
                                                        <div class="small text-muted">
                                                            {{"{$course->educational_level} - {$course->grade}"}}
                                                        </div>
                                                    </td>

                                                    <td>{{ $course->teacher_name ?? '' }}</td>

                                                    <td>
                                                        <div>
                                                            @if($course->subscription_type == 'MONTHLY')
                                                                {{ $course->monthly_subscription_price }}
                                                            @else
                                                                {{ $course->one_time_payment_price }}
                                                            @endif
                                                        </div>
                                                        <div class="small text-muted">
                                                            {{ $course->subscription_type }}
                                                        </div>
                                                    </td>

                                                    <td>{{ $course->archived == 1 ? 'YES' : 'NO' }}</td>
                                                    <td>{{ $course->hidden == 1 ? 'YES' : 'NO' }}</td>

                                                    <td class="text-right">

                                                        <a href="{{route("dashboard.courses.sessions.index",$course->id)}}"
                                                           class="btn btn-dark">Sessions</a>

                                                        <a href="{{route("dashboard.courses.students.index",$course->id)}}"
                                                           class="btn btn-success text-dark"><i class="far fa-user"></i>
                                                        </a>
                                                        <a href="{{route("dashboard.courses.dynamic-links.index",$course->id)}}"
                                                           class="btn btn-dark"><i class="fa fa-link"></i>
                                                        </a>
                                                        <a href="{{route("dashboard.courses.dynamic-links.files.index",$course->id)}}"
                                                           class="btn btn-dark"><i class="fa fa-print"></i>
                                                        </a>
                                                        <a href="{{route('dashboard.courses.show',$course->id)}}"
                                                           class="btn btn-warning"><i class="fa fa-eye"></i>
                                                        </a>
                                                        @can('edit-courses')
                                                            <a href="{{route('dashboard.courses.edit',$course->id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        {{--                                                        @if(auth()->user()->can('delete-courses'))--}}
                                                        {{--                                                            <button class="btn btn-danger delete"--}}
                                                        {{--                                                                    data-id="{{$course->id}}" type="button">--}}
                                                        {{--                                                                <i class="fa fa-trash"></i>--}}
                                                        {{--                                                            </button>--}}
                                                        {{--                                                        @endif--}}
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any users yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($courses)>0)
                            <div class="text-center">
                                {{ $courses->links() }}
                                {{-- {{ $courses->appends(Request::except('page'))->links() }}--}}
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
