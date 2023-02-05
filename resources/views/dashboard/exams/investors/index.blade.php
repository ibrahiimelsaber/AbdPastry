@extends('layouts.dashboard-master')

@section('title','Manage ExamRound Investors')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage ExamRound Investors</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-exam-round-investors')
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="card-stats">
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-label">Round</div>
                                    <div class="card-stats-item-count">
                                        <a href="{{route("dashboard.exams.packages.index",["round"=>$round->id])}}">{{$round->name}}</a>
                                    </div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-label">Package</div>
                                    <div class="card-stats-item-count">
                                        @foreach($package->names as $name) {{"$name - "}} @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Investors <span>({{ $total }})</span></h4>
                            <div class="card-header-action">
                                @can('create-exam-round-investors')
                                    <a href="{{route('dashboard.exams.investors.create',['round'=>$round->id, 'package' => $package->id])}}"
                                       class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                @if(count($investors)>0)
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>Serial</th>
                                            <th>Active</th>
                                            <th>Last IP</th>
                                            <th></th>

                                            <th></th>
                                        </tr>
                                        @foreach($investors as $investor)
                                            <tr>
                                                <td>{{ $investor->username }}</td>
                                                <td>{{ $investor->serial }}</td>
                                                <td>{{ $investor->active }}</td>
                                                <td>{{ $investor->last_ip }}</td>
                                                <td class="text-right">
                                                    @can('edit-exam-round-investors')
                                                        <a href="{{route('dashboard.exams.investors.edit', ['investor' => $investor->id,'package' => $package->id,'round' => $round->id,])}}"
                                                           class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete-exam-round-investors')
                                                        <button class="btn btn-danger delete"
                                                                data-id="{{$investor->id}}" type="button">
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
                                        <p>Looks like you have not added any Investors yet!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(count($investors)>0)
                        <div class="text-center">
                            {{$investors->links()}}
                        </div>
                    @endif
                @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
