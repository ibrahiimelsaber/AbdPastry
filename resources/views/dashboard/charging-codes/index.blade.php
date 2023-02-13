@extends('layouts.dashboard-master')

@section('title','Manage Charging Codes')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Charging Codes</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._header_search')
            </div>
        </div>
        <div class="section-body">

            @can('view-charging-codes')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Charging Codes <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-charging-codes')
                                        <a href="{{route('dashboard.charging-codes.create')}}"
                                           class="btn btn-primary">Generate <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($chargingCodes)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Code</th>
                                                <th>Money Amount</th>
                                                <th>Created At</th>
                                                <th>Expires At</th>
                                                <th>Used By User</th>
                                                <th></th>
                                            </tr>
                                            @foreach($chargingCodes as $chargingCode)
                                                <tr>
                                                    <td>{{ $chargingCode->code }}</td>
                                                    <td>{{ $chargingCode->money .' EGP' }}</td>
                                                    <td>{{ $chargingCode->created_at }}</td>
                                                    <td>{{ $chargingCode->expires_at }}</td>
                                                    <td>
                                                        @if($chargingCode->used_by_user_id)
                                                            <a href="{{  route('dashboard.users.show',$chargingCode->used_by_user_id)}}">
                                                                {{ $chargingCode->usedByUser->name ?? '' }}
                                                            </a>
                                                        @else
                                                            ..
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="{{route('dashboard.charging-codes.show',$chargingCode->id)}}"
                                                           class="btn btn-warning"><i class="fa fa-eye"></i></a>

                                                        @can('delete-charging-codes')
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$chargingCode->id}}" type="button">
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
                                            <p>Looks like you have not added any charging-codes yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($chargingCodes)>0)
                            <div class="text-center">
                                {{$chargingCodes->links()}}
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
