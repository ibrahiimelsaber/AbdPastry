@extends('layouts.dashboard-master')
@section('title','Manage Configurations')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Configurations</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            <div class="card">

                <div class="card-header">
                    <div class="section-header-breadcrumb">
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        @if(count($configurations)>0)
                            <table class="table table-responsive-sm table-hover table-outline">
                                <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                    <th>Edit Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($configurations as $configuration)
                                    <tr>
                                        <td>{{ $configuration->key }}</td>
                                        <td>{{ $configuration->value}}</td>
                                        <td>
                                            <a href="{{route('dashboard.configurations.edit', $configuration->id)}}"
                                               class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
        </div>
    </section>
@endsection

