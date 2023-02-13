@extends('layouts.dashboard-master')

@section('title','Room Requests')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Room Requests</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-rooms')
                <div class="card">
                    <div class="card-header">
                        <h4>This Room Requests <span>({{ $total }})</span></h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($requests)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Member</th>
                                        <th>Notes</th>

                                        <th></th>
                                    </tr>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>{{ $request->member->name ?? $request->member }}</td>
                                            <td>{{ $request->notes }}</td>

                                            <td class="text-right">
                                                @can('edit-rooms')
                                                    <a href="{{route('dashboard.rooms.requests.accept',['roomId'=>$request->chat_room_id,'requestId'=>$request->id])}}"
                                                       class="btn btn-primary">
                                                        <i class="far fa-check-circle"></i>
                                                    </a>

                                                    <a href="{{route('dashboard.rooms.requests.reject',['roomId'=>$request->chat_room_id,'requestId'=>$request->id])}}"
                                                       class="btn btn-danger">
                                                        <i class="far fa-times-circle"></i>
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
                                    <p>No new requests!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($requests)>0)
                    <div class="text-center">
                        {{$requests->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection
