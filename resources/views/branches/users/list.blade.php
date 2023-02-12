@extends('layouts.dashboard-master')

@section('title','Manage Branch Users, ' .$branch->Name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage Branch Users <strong  class="bg-whitesmoke"> {{$branch->Name}}</strong></h1>
     <h1 class="ml-2">|| </h1>
            <a href="{{route('branches.index')}}"
               class="ml-2 btn btn-primary">Return Back</a>
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
                                <h4>Branch Users <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                        <a href="{{route('branch.users.create',$branch->Id)}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Branch User</a>
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
                                                <th>Branch Name</th>
                                                <th>Created At</th>
                                                <th>Created By</th>
                                                <th>Updated At</th>
                                                <th>Updated By</th>

                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->Id }}</td>
                                                    <td>{{ $user->Name}}</td>
                                                    <td>{{ $user->branch->Name}}</td>
                                                    <td>{{ $user->created_at}}</td>
                                                    <td>{{ $user->created_by}}</td>
                                                    <td>{{ $user->updated_at}}</td>
                                                    <td>{{ $user->updated_by}}</td>

                                                    <td>
                                                            <a href="{{route('branch.users.edit',$user->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-user-cog"> Update User</i>
    @if($user->Active == 1)
                                                            </a>
                                                                         <a href="{{route('branch.users.deactivate',$user->Id)}}"
                                                               class="btn btn-danger"><i class="fa fa-user-times"> Deactivate User</i>
                                                            </a>
@else
    <a href="{{route('branch.users.activate',$user->Id)}}"
                                                               class="btn btn-success ml-1"><i class="fa fa-user-check"> Activate User</i>
                                                            </a>

@endif
                                                          <button class="btn btn-danger delete"
                                                            data-id="{{$user->Id}}" type="button">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
