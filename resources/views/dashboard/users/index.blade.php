@extends('layouts.dashboard-master')

@section('title','Manage Users')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Users</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.users.export')}}" class="btn btn-outline-info">Export All</a>
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
                                <h4>Users <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-users')
                                        <a href="{{route('dashboard.users.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New User</a>
                                        <a href="{{route('dashboard.users.import-view')}}" class="btn btn-primary"><i class="fas fa-file-import"></i> Import Excel</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($users)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>University</th>
                                                <th>Student Grade</th>
                                                <th></th>
                                            </tr>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        <img src="{{$user->avatar_link}}" class="avatar avatar-sm">
                                                    </td>

                                                    <td>
                                                        <div>{{$user->name}}</div>
                                                        <div class="small text-muted">{{$user->phone}}</div>
                                                    </td>

                                                    <td>
                                                        <div>{{ $user->university->name??'' }}</div>
                                                        <div class="small text-muted">{{ $user->faculty->name??'' }}</div>
                                                    </td>

                                                    <td>
                                                        @if($user->studentGrade)
                                                        {{$user->studentGrade->educational_level." - ".$user->studentGrade->grade}}
                                                            @endif
                                                    </td>

                                                    <td class="text-right">
                                                        <a href="{{route('dashboard.users.statement',$user->id)}}"
                                                           class="btn btn-dark"><i class="fa fa-dollar-sign" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{route('dashboard.users.show',$user->id)}}"
                                                           class="btn btn-warning"><i class="fa fa-eye"></i>
                                                        </a>
                                                        @can('edit-users')
                                                            <a href="{{route('dashboard.users.edit',$user->id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @if(auth()->user()->can('delete-users') && !$user->isme)
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$user->id}}" type="button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
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
                        @if(count($users)>0)
                            <div class="text-center">
                                {{--{{$users->links()}}--}}
                                {{ $users->appends(Request::except('page'))->links() }}
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
