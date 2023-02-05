@extends('layouts.dashboard-master')

@section('title','Manage Governorates')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Governorates</h1>
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
                                <div class="card-stats-item-label">Country</div>
                                <div class="card-stats-item-count">{{$country->name}}</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @can('view-governorates')
                <div class="card">
                    <div class="card-header">
                        <h4>Governorates <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-governorates')
                                <a href="{{route('dashboard.governorates.create',['country'=>$country->id])}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($governorates)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>

                                        <th></th>
                                    </tr>
                                    @foreach($governorates as $governorate)
                                        <tr>
                                            <td>{{ $governorate->name }}</td>
                                            <td class="text-right">
                                                @can('view-cities')
                                                    <a href="{{route('dashboard.cities.index',
                                                        ['country'=>$governorate->country_id,
                                                    'governorate'=>$governorate->id])}}" class="btn btn-dark">
                                                        Cities <i class="far fa-folder-open"></i>
                                                    </a>
                                                @endcan
                                                @can('edit-governorates')
                                                    <a href="{{route('dashboard.governorates.edit',
                                                        ['country'=>$governorate->country_id,
                                                    'governorate'=>$governorate->id])}}" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-governorates')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$governorate->id}}" type="button">
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
                                    <p>Looks like you have not added any governorates yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($governorates)>0)
                    <div class="text-center">
                        {{$governorates->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
