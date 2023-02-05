@extends('layouts.dashboard-master')

@section('title','Manage CreatorStudents')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage CreatorStudents</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.creator-students.export')}}" class="btn btn-outline-info">Export All</a>
                @include('dashboard.common._header_search')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="row">
            <div class="col-md-12">
                <users-filter></users-filter>
            </div>
        </div>
        <div class="section-body">
            @can('view-users')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>CreatorStudents <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    <a href="{{route('dashboard.creator-students.create')}}"
                                       class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($creatorStudents)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>University</th>
                                                <th>Faculty</th>
                                                <th></th>
                                            </tr>
                                            @foreach($creatorStudents as $creatorStudent)
                                                <tr>
                                                    <td>{{ $creatorStudent->name }}</td>
                                                    <td>{{ $creatorStudent->email }}</td>
                                                    <td>{{ $creatorStudent->university->name??'' }}</td>
                                                    <td>{{ $creatorStudent->faculty->name??'' }}</td>
                                                    <td class="text-right">
                                                        @can('delete-creator-students')
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$creatorStudent->id}}" type="button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endcan
                                                        <a href="{{route('dashboard.creator-students.edit',$creatorStudent->id)}}"
                                                           class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any creator-students yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($creatorStudents)>0)
                            <div class="text-center">
                                {{--{{$creatorStudents->links()}}--}}
                                {{ $creatorStudents->appends(Request::except('page'))->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection

@section('vue')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
