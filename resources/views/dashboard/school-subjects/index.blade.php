@extends('layouts.dashboard-master')

@section('title','Manage School Subjects')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Manage School Subjects</h1></div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-subjects')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>School Subjects <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-subjects')
                                        <a href="{{route('dashboard.school-subjects.create')}}"
                                           class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($schoolSubjects)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>Level</th>
                                                <th>Department</th>
                                                <th>{{ __('Archived') }}</th>
                                                <th></th>
                                            </tr>
                                            @foreach($schoolSubjects as $schoolSubject)
                                                <tr>
                                                    <td>{{ $schoolSubject->name }}</td>
                                                    <td>{{ $schoolSubject->level }}</td>
                                                    <td>{{ $schoolSubject->department }}</td>
                                                    <td>{{ $schoolSubject->archived == 1 ? 'YES' : 'NO' }}</td>

                                                    <td class="text-right">
                                                        @can('delete-subjects')
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$schoolSubject->id}}" type="button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endcan
                                                        @can('edit-subjects')
                                                            <a href="{{route('dashboard.school-subjects.edit',$schoolSubject->id)}}"
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
                                            <p>Looks like you have not added any school-subjects yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($schoolSubjects)>0)
                            <div class="text-center">
                                {{$schoolSubjects->links()}}
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
