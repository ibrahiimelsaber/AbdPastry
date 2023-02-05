@extends('layouts.dashboard-master')

@section('title','Manage Doctors')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Manage Doctors</h1></div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-users')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Doctors <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-doctors')
                                        <a href="{{route('dashboard.doctors.create')}}"
                                           class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($doctors)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                {{--<th>Email</th>--}}
                                                <th>University</th>
                                                <th>Faculty</th>
                                                <th>Registered</th>
                                                <th></th>
                                            </tr>
                                            @foreach($doctors as $doctor)
                                                <tr>
                                                    <td>
                                                        <img class="mr-3 rounded-circle" width="40"
                                                             src="{{ $doctor->avatar_link }}" alt="avatar">
                                                    </td>
                                                    <td>{{ $doctor->name }}</td>
                                                    {{--<td>{{ $doctor->email }}</td>--}}
                                                    <td>{{ $doctor->university->name ??'' }}</td>
                                                    <td>{{ $doctor->faculty->name ??'' }}</td>
                                                    <td>{{ $doctor->created_at->diffForHumans() }}</td>
                                                    <td class="text-right">
                                                        @can('delete-doctors')
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$doctor->id}}" type="button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endcan
                                                        @can('edit-doctors')
                                                            <a href="{{route('dashboard.doctors.edit',$doctor->id)}}"
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
                                            <p>Looks like you have not added any doctors yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($doctors)>0)
                            <div class="text-center">
                                {{$doctors->links()}}
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
