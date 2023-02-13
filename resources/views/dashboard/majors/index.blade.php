@extends('layouts.dashboard-master')

@section('title','Manage Majors')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Majors</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-body">

                    <div class="card-stats">
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-label">University</div>
                                <div class="card-stats-item-count">
                                    <a href="{{route('dashboard.faculties.index',$university->id)}}">
                                        {{$university->name}}
                                    </a>
                                </div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-label">Faculty</div>
                                <div class="card-stats-item-count">{{$faculty->name}}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @can('view-majors')
                <div class="card">
                    <div class="card-header">
                        <h4>Majors <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-majors')
                                <a href="{{route('dashboard.majors.create',['university'=>$university->id, 'faculty' => $faculty->id])}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($majors)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>

                                        <th></th>
                                    </tr>
                                    @foreach($majors as $major)
                                        <tr>
                                            <td>{{ $major->name }}</td>
                                            <td class="text-right">
                                                @can('edit-majors')
                                                    <a href="{{route('dashboard.majors.edit',
                                                        ['university'=>$university->id,'faculty'=>$major->faculty_id,
                                                        'major'=>$major->id])}}" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-majors')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$major->id}}" type="button">
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
                                    <p>Looks like you have not added any majors yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($majors)>0)
                    <div class="text-center">
                        {{$majors->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
