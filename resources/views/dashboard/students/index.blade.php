@extends('layouts.dashboard-master')

@section('title','Manage Students')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Students</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.students.export')}}" class="btn btn-outline-info">Export All</a>
                @include('dashboard.common._header_search')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="row">
            <div class="col-md-12">
                <users-filter></users-filter>
            </div>
        </div>
        <div class="section-body">
            @can('view-students')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Students <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-students')
                                        <a href="{{route('dashboard.students.create')}}"
                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Student</a>
                                        <a href="{{route('dashboard.students.import-view')}}"
                                           class="btn btn-primary"><i class="fas fa-file-import"></i> Import Excel</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($students)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>University</th>
                                                <th>Student Grade</th>
                                                <th></th>
                                            </tr>
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>
                                                        <img src="{{$student->avatar_link}}" class="avatar avatar-sm">
                                                    </td>

                                                    <td>
                                                        <div>{{$student->name}}</div>
                                                        <div class="small text-muted">{{$student->phone}}</div>
                                                    </td>

                                                    <td>
                                                        <div>{{ $student->university->name??'' }}</div>
                                                        <div class="small text-muted">{{ $student->faculty->name??'' }}</div>
                                                    </td>

                                                    <td>
                                                        @if($student->studentGrade)
                                                            {{$student->studentGrade->educational_level." - ".$student->studentGrade->grade}}
                                                        @endif
                                                    </td>

                                                    <td class="text-right">
                                                        <a href="{{route('dashboard.students.statement',$student->id)}}"
                                                           class="btn btn-dark"><i class="fa fa-dollar-sign" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{route('dashboard.students.show',$student->id)}}"
                                                           class="btn btn-warning"><i class="fa fa-eye"></i>
                                                        </a>
                                                        @can('edit-students')
                                                            <a href="{{route('dashboard.students.edit',$student->id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @if(auth()->user()->can('delete-students') && !$student->isme)
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$student->id}}" type="button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any students yet!</p>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        @if(count($students)>0)
                            <div class="text-center">
                                {{$students->links()}}
                                {{-- {{ $students->appends(Request::except('page'))->links() }} --}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection

@section('vue')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
