@extends('layouts.dashboard-master')

@section('title','Manage CreatorStudents')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Manage CreatorStudents</h1></div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>CreatorStudents <span>({{ $total }})</span></h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        @if(count($creatorStudentRequests)>0)
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th>Student</th>
                                    <th>Status</th>
                                    <th>Answers</th>
                                </tr>
                                @foreach($creatorStudentRequests as $request)
                                    <tr>
                                        <td>
                                            <a href="{{route('dashboard.users.show',$request->student_id)}}">{{ $request->student->name ?? '' }}</a>
                                        </td>
                                        <td>{{ $request->status }}</td>
                                        <td>
                                            <div class="alert alert-light">
                                                @foreach($request->questions as $row)
                                                    <ul>
                                                        <li>{{ $row->question }}</li>
                                                        <li>{{ $row->answer }}</li>
                                                    </ul>
                                                @endforeach
                                            </div>
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
            @if(count($creatorStudentRequests)>0)
                <div class="text-center">
                    {{$creatorStudentRequests->links()}}
                </div>
            @endif

        </div>
    </section>
@endsection
