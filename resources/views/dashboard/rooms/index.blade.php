@extends('layouts.dashboard-master')

@section('title','Manage Rooms')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Rooms</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-rooms')
                <div class="card">
                    <div class="card-header">
                        <h4>Rooms <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-rooms')
                                <a href="{{route('dashboard.rooms.create')}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($rooms)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Members</th>
                                        <th>New Requests</th>
                                        <th></th>
                                    </tr>
                                    @foreach($rooms as $room)
                                        <tr>
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $room->members_count }}</td>
                                            <td>
                                                @if($room->requests_count > 0)
                                                <a class="btn btn-dark" href="{{route('dashboard.rooms.requests.pending',['roomId'=>$room->id])}}">
                                                    <span class="badge badge-transparent">{{ $room->requests_count }}</span>
                                                </a>
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @can('edit-rooms')
                                                    <a href="{{route('dashboard.rooms.edit',$room->id)}}"
                                                       class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-rooms')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$room->id}}" type="button">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center p-3 text-muted">
                                    <h5>No Results</h5>
                                    <p>Looks like you have not added any rooms yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($rooms)>0)
                    <div class="text-center">
                        {{$rooms->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
