@extends('layouts.dashboard-master')

@section('title','Manage Specialization Subjects')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Subjects</h1>
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
                                <div class="card-stats-item-label">Specialization</div>
                                <div class="card-stats-item-count">{{$specialization->name}}</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @can('view-subjects')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Subjects <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-subjects')
                                        <a href="{{route('dashboard.subject-specializations.subjects.create', [$specialization->id])}}"
                                           class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($subjects)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>{{ __('Archived') }}</th>
                                                <th></th>
                                            </tr>
                                            @foreach($subjects as $subject)
                                                <tr>
                                                    <td>{{ $subject->name }}</td>
                                                    <td>{{ $subject->archived == 1 ? 'YES' : 'NO' }}</td>

                                                    <td class="text-right">
                                                        @can('edit-subjects')
                                                            <a href="{{route('dashboard.subject-specializations.subjects.edit',['subjectSpecialization'=>$specialization->id, 'subject'=>$subject->id])}}"
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
                                            <p>Looks like you have not added any subjects yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($subjects)>0)
                            <div class="text-center">
                                {{$subjects->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
