@extends('layouts.dashboard-master')

@section('title','Manage Subject-Specializations')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Subject-Specializations</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-subject-specializations')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Subject-Specializations <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-subject-specializations')
                                        <a href="{{route('dashboard.subject-specializations.create')}}"
                                           class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($specializations)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($specializations as $specialization)
                                                <tr>
                                                    <td>{{ $specialization->name }}</td>

                                                    <td class="text-right">
                                                        @can('view-subjects')
                                                            <a href="{{route("dashboard.subject-specializations.subjects.index",$specialization->id)}}"
                                                               class="btn btn-dark">Subjects</a>
                                                        @endcan
                                                        @can('edit-subject-specializations')
                                                            <a href="{{route('dashboard.subject-specializations.edit',$specialization->id)}}"
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
                                            <p>Looks like you have not added any subject-specialization yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($specializations)>0)
                            <div class="text-center">
                                {{$specializations->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
