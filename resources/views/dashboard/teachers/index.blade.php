@extends('layouts.dashboard-master')

@section('title','Manage Teachers')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Teachers</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-users')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Teachers <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-teachers')
                                        <a href="{{route('dashboard.teachers.create')}}"
                                           class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($teachers)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>City</th>
                                                <th>Registered</th>
                                                <th></th>
                                            </tr>
                                            @foreach($teachers as $teacher)
                                                <tr>
                                                    <td>
                                                        <img class="mr-3 rounded-circle" width="40"
                                                             src="{{ $teacher->avatar_link }}" alt="avatar">
                                                    </td>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->email }}</td>
                                                    <td>{{ $teacher->city->name ??'' }}</td>
                                                    <td>{{ $teacher->created_at->diffForHumans() }}</td>
                                                    <td class="text-right">
                                                        @can('delete-teachers')
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$teacher->id}}" type="button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endcan
                                                        @can('edit-teachers')
                                                            <a href="{{route('dashboard.teachers.edit', $teacher->id)}}"
                                                               class="btn btn-primary">
                                                                <i class="fa fa-edit"></i>
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
                                            <p>Looks like you have not added any teachers yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($teachers)>0)
                            <div class="text-center">
                                {{$teachers->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
