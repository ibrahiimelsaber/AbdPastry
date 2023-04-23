@extends('layouts.dashboard-master')

@section('title','Manage Agents')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage Agents</h1>

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
                            <h4>Agents <span>({{ $total }})</span></h4>
                            <div class="card-header-action">
                                <a href="{{route('agents.create')}}"
                                   class="btn btn-primary"><i class="fas fa-plus"></i> Add New Agent</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">

                                @if(count($agents)>0)
                                    <table class="table table-responsive-sm table-hover table-outline">
                                        <thead>
                                        <tr>
                                            <th>Agent Id</th>
                                            <th>User Name</th>
                                            <th>Photo</th>
                                            <th>Percentage</th>
                                            <th>Created At</th>
                                            <th>Created By</th>

                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($agents as $agent)
                                            <tr>
                                                <td>{{ $agent->id }}</td>
                                                <td>{{ $agent->username}}</td>
                                                <td><img src="{{$agent->path}}"  class="rounded-circle" alt=""></td>
                                                {{--                                                <td><img src="{{asset('/agents/images').'/'.$agent->name}}" alt=""></td>--}}
                                                <td>{{ $agent->percentage}} %</td>
                                                <td>{{ $agent->created_at}}</td>
                                                <td>{{ $agent->created_by}}</td>

                                                <td>
                                                    <a href="{{route('agents.edit',$agent->id)}}"
                                                       class="btn btn-primary"><i class="fa fa-user-cog"> Update
                                                            Agent</i>
                                                    </a>
                                                    <a href="{{route('agents.delete',$agent->id)}}"
                                                       class="btn btn-danger"><i class="fa fa-trash"> Delete
                                                            Agent</i>
                                                    </a>
                                                </td>



                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center p-3 text-muted">
                                        <h5>No Results</h5>
                                        <p>Looks like you have not added any agents yet!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(count($agents)>0)
                        <div class="text-center">
                            {{ $agents->links() }}
                            {{--                                 {{ $requests->appends(Request::except('page'))->links() }}--}}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
@endsection
