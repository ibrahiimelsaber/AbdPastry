@extends('layouts.dashboard-master')

@section('title','Manage Subjects of Faculty')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Subjects of Faculty</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._header_search')
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
            @can('view-subjects')
                <div class="card">
                    <div class="card-header">
                        <h4>Faculty Subjects <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-subjects')
                                <a href="{{route('dashboard.university-subjects.create',['university'=>$university->id, 'faculty' => $faculty->id])}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($universitySubjects)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Major</th>
                                        <th>Level</th>

                                        <th></th>
                                    </tr>
                                    @foreach($universitySubjects as $universitySubject)
                                        <tr>
                                            <td>{{ $universitySubject->name }}</td>
                                            <td>{{ $universitySubject->major->name ?? null }}</td>
                                            <td>{{ $universitySubject->level }}</td>
                                            <td class="text-right">
                                                @can('edit-subjects')
                                                    <a href="{{route('dashboard.university-subjects.edit',
                                                        ['university'=>$university->id,'faculty'=>$universitySubject->faculty_id,
                                                        'major'=>$universitySubject->id])}}" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-subjects')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$universitySubject->id}}" type="button">
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
                                    <p>Looks like you have not added any university-subjects yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($universitySubjects)>0)
                    <div class="text-center">
                        {{$universitySubjects->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
