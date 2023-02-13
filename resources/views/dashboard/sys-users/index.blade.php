@extends('layouts.dashboard-master')

@section('title','Manage System Users')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage System Users</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._header_search')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-users')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>System Users <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-users')
                                        <a href="{{route('dashboard.sys-users.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New System User</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($sysUsers)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th></th>
                                            </tr>
                                            @foreach($sysUsers as $sysUser)
                                                <tr>
                                                    <td>
                                                        <img src="{{$sysUser->avatar_link}}" class="avatar avatar-sm">
                                                    </td>
                                                    <td>{{ $sysUser->name }}</td>
                                                    <td>{{ $sysUser->roles->first()->name ?? '' }}</td>
                                                    <td class="text-right">

                                                        <a href="{{route('dashboard.sys-users.show',$sysUser->id)}}"
                                                           class="btn btn-warning"><i class="fa fa-eye"></i>
                                                        </a>
                                                        @can('edit-users')
                                                            <a href="{{route('dashboard.sys-users.edit',$sysUser->id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @if(auth()->user()->can('delete-users') && !$sysUser->isme)
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$sysUser->id}}" type="button">
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
                                            <p>Looks like you have not added any system users yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($sysUsers)>0)
                            <div class="text-center">
                                {{$sysUsers->links()}}
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
