@extends('layouts.dashboard-master')

@section('title','Manage Exam Round Packages')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage ExamRound Packages</h1>
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
                                <div class="card-stats-item-label">Exam Round</div>
                                <div class="card-stats-item-count">{{$round->name}}</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @can('view-exam-round-packages')
                <div class="card">
                    <div class="card-header">
                        <h4>Packages <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-exam-round-packages')
                                <a href="{{route('dashboard.exams.packages.create',['round'=>$round->id])}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($packages)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Names</th>

                                        <th></th>
                                    </tr>
                                    @foreach($packages as $package)
                                        <tr>
                                            <td>
                                                @foreach($package->names as $name)
                                                {{"$name - "}}
                                                @endforeach
                                            </td>

                                            <td class="text-right">
                                                @can('view-exam-round-investors')
                                                    <a href="{{route('dashboard.exams.investors.index',
                                                ['round'=>$round->id, 'package'=>$package->id])}}" class="btn btn-dark">
                                                       Investors <i class="far fa-folder-open"></i>
                                                    </a>
                                                @endcan
{{--                                                @can('edit-exam-round-investors')--}}
{{--                                                    <a href="{{route('dashboard.exams.investors.edit',--}}
{{--                                                        ['package'=>$package->package_id,--}}
{{--                                                    'package'=>$package->id])}}" class="btn btn-primary">--}}
{{--                                                        <i class="fa fa-edit"></i>--}}
{{--                                                    </a>--}}
{{--                                                @endcan--}}
{{--                                                @can('delete-exam-round-package')--}}
{{--                                                    <button class="btn btn-danger delete"--}}
{{--                                                            data-id="{{$package->id}}" type="button">--}}
{{--                                                        <i class="fa fa-trash"></i>--}}
{{--                                                    </button>--}}
{{--                                                @endcan--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center p-3 text-muted">
                                    <h5>No Results</h5>
                                    <p>Looks like you have not added any ExamRound Packages yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($packages)>0)
                    <div class="text-center">
                        {{$packages->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
