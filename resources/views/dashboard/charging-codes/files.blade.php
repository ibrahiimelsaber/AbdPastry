@extends('layouts.dashboard-master')

@section('title', 'Manage Files of Charging Codes')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Files of Charging Codes</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            @can('view-charging-codes')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Files <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-charging-codes')
                                        <a href="{{route('dashboard.charging-codes.create')}}"
                                           class="btn btn-primary">Generate <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($files)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>File Name</th>
                                                <th>Codes Count</th>
                                                <th>Money Amount</th>
                                                <th>Created At</th>
                                                <th>Expires At</th>
                                                <th></th>
                                            </tr>
                                            @foreach($files as $file)
                                                <tr>
                                                    <td>{{ $file->file_name }}</td>
                                                    <td>{{ $file->count }}</td>
                                                    <td>{{ $file->money .' EGP' }}</td>
                                                    <td>{{ $file->created_at }}</td>
                                                    <td>{{ $file->expires_at }}</td>
                                                    <td class="text-right">
                                                        <a href="{{route('dashboard.charging_codes_files.download',$file->id)}}"
                                                           class="btn btn-dark"><i class="fas fa-file-download"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any charging-codes yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($files)>0)
                            <div class="text-center">
                                {{$files->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection