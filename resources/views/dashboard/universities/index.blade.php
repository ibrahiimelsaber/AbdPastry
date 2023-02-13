@extends('layouts.dashboard-master')

@section('title', 'Manage Universities')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Universities</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._header_search')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-universities')
                <div class="card">
                    <div class="card-header">
                        <h4>Universities <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-universities')
                                <a href="{{route('dashboard.universities.create')}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($universities)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>Governorate</th>
                                        <th></th>
                                    </tr>
                                    @foreach($universities as $university)
                                        <tr>
                                            <td>{{ $university->name ?? '' }}</td>
                                            <td>{{ $university->country->name ?? '' }}</td>
                                            <td>{{ $university->governorate->name ?? '' }}</td>
                                            <td class="text-right">
                                                @can('view-faculties')
                                                    <a href="{{route('dashboard.faculties.index',
                                                ['university'=>$university->id])}}" class="btn btn-dark">
                                                        Faculties <i class="far fa-folder-open"></i>
                                                    </a>
                                                @endcan
                                                @can('edit-universities')
                                                    <a href="{{route('dashboard.universities.edit',$university->id)}}"
                                                       class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-universities')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$university->id}}" type="button">
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
                                    <p>Looks like you have not added any universities yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($universities)>0)
                    <div class="text-center">
                        {{$universities->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
