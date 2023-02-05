@extends('layouts.dashboard-master')

@section('title','Manage Exam-Rounds')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Exam-Rounds</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-exam-rounds')
                <div class="card">
                    <div class="card-header">
                        <h4>Exam-Rounds <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-exam-rounds')
                                <a href="{{route('dashboard.exams.rounds.create')}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($examRounds)>0)
                                <table class="table table-striped text-center">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Investors</th>
                                        <th>Packages</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach($examRounds as $round)
                                        <tr>
                                            <td>{{ $round->name }}</td>
                                            <td>{{ $round->investors->count() }}</td>
                                            <td>{{ $round->packages->count() }}</td>
                                            <td>{{$round->start_date->format('Y-m-d H:i')}}</td>
                                            <td>{{$round->end_date->format('Y-m-d H:i')}}</td>
                                            <td class="text-right">
                                                @can('view-exam-round-packages')
                                                    <a href="{{route('dashboard.exams.packages.index',
                                                ['round'=>$round->id])}}" class="btn btn-dark">
                                                        Name Packages <i class="far fa-folder-open"></i>
                                                    </a>
                                                @endcan
                                                @can('edit-exam-rounds')
                                                    <a href="{{route('dashboard.exams.rounds.edit', $round->id)}}"
                                                       class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-exam-rounds')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$round->id}}" type="button">
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
                                    <p>Looks like you have not added any exam rounds yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($examRounds)>0)
                    <div class="text-center">
                        {{$examRounds->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
