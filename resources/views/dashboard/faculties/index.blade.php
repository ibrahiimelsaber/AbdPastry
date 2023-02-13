@extends('layouts.dashboard-master')

@section('title','Manage Faculties')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Faculties</h1>
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
                                <div class="card-stats-item-count">{{$university->name}}</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @can('view-faculties')
                <div class="card">
                    <div class="card-header">
                        <h4>Faculties <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-faculties')
                                <a href="{{route('dashboard.faculties.create',['university'=>$university->id])}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($faculties)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>Governorate</th>
                                        <th>{{ __('Archived') }}</th>
                                        <th></th>
                                    </tr>
                                    @foreach($faculties as $faculty)
                                        <tr>
                                            <td>{{ $faculty->name ?? '' }}</td>
                                            <td>{{ $faculty->country->name ?? '' }}</td>
                                            <td>{{ $faculty->governorate->name ?? '' }}</td>
                                            <td>{{ $faculty->archived == 1 ? 'YES' : 'NO' }}</td>

                                            <td class="text-right">
                                                @can('view-majors')
                                                    <a href="{{route('dashboard.majors.index',
                                                        ['university'=>$faculty->university_id,
                                                    'faculty'=>$faculty->id])}}" class="btn btn-dark">
                                                        Majors <i class="far fa-folder-open"></i>
                                                    </a>
                                                @endcan
                                                @can('view-subjects')
                                                    <a href="{{route('dashboard.university-subjects.index',
                                                        ['university'=>$faculty->university_id,
                                                    'faculty'=>$faculty->id])}}" class="btn btn-dark">
                                                        Subjects <i class="far fa-folder-open"></i>
                                                    </a>
                                                @endcan
                                                @can('edit-faculties')
                                                    <a href="{{route('dashboard.faculties.edit',
                                                        ['university'=>$faculty->university_id,
                                                    'faculty'=>$faculty->id])}}" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-faculties')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$faculty->id}}" type="button">
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
                                    <p>Looks like you have not added any faculties yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($faculties)>0)
                    <div class="text-center">
                        {{$faculties->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
