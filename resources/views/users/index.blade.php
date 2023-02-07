@extends('layouts.dashboard-master')

@section('title','Manage Users')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage Users</h1>
            <h1 class="ml-2">||</h1>
    <button class="ml-2 btn btn-primary" onclick="history.back()">Return Back</button>
    <button class="ml-2 btn btn-outline-light" onclick="window.location.reload()"> Reload Page</button>


            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Users <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                        <a href="{{route('users.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New User</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">

                                    @if(count($users)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>User Name</th>
                                                <th>User Role</th>

                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->Id }}</td>
                                                    <td>{{ $user->Username}}</td>
                                                    <td>{{ $user->GroupId == 2 ?'Team Leader' : 'Agent'}}</td>

                                                    <td>
                                                            <a href="{{route('users.edit',$user->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-user-cog"> Update User</i>
    @if($user->Active == 1)
                                                            </a>
                                                                         <a href="{{route('users.deactivate',$user->Id)}}"
                                                               class="btn btn-danger"><i class="fa fa-user-times"> Deactivate User</i>
                                                            </a>
@else
    <a href="{{route('users.activate',$user->Id)}}"
                                                               class="btn btn-success ml-1"><i class="fa fa-user-check"> Activate User</i>
                                                            </a>

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
                                {{ $users->links() }}
{{--                                 {{ $requests->appends(Request::except('page'))->links() }}--}}
                            </div>
                        @endif
                    </div>
                </div>

        </div>
    </section>
@endsection

{{--@section('scripts')--}}
{{--    @include('dashboard.common._modal_delete')--}}
{{--@endsection--}}
