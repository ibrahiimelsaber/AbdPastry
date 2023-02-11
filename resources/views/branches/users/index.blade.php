

{{--@section('scripts')--}}
{{--    @include('dashboard.common._modal_delete')--}}
{{--@endsection--}}
@extends('layouts.dashboard-master')

@section('title','Manage Branches')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="ml-2">Manage Branches</h1>
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
                                <h4>Branches <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                        <a href="{{route('branches.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Branch</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">

                                    @if(count($branches)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>User Name</th>

                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($branches as $branch)
                                                <tr>
                                                    <td>{{ $branch->Id }}</td>
                                                    <td>{{ $branch->Name}}</td>

                                                    <td>
                                                            <a href="{{route('branches.edit',$branch->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-user-cog"> Update Branch</i>
    @if($branch->Active == 1)
                                                            </a>
                                                                         <a href="{{route('branches.deactivate',$branch->Id)}}"
                                                               class="btn btn-danger"><i class="fa fa-user-times"> Deactivate Branch</i>
                                                            </a>
@else
    <a href="{{route('branches.activate',$branch->Id)}}"
                                                               class="btn btn-success ml-1"><i class="fa fa-user-check"> Activate Branch</i>
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
                                            <p>Looks like you have not added any $branches yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($branches)>0)
                            <div class="text-center">
                                {{ $branches->links() }}
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
