@extends('layouts.dashboard-master')

@section('title','Manage Items')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Items</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._header_search')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-items')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Items <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
                                    @can('create-items')
                                        <a href="{{route('dashboard.items.create')}}"
                                           class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($items)>0)
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Uploader</th>
                                                <th>Sales</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>
                                                        <a href="{{ $item->uploader_id? route('dashboard.users.show',$item->uploader_id) : '#'}}">
                                                            {{ $item->uploader->name ?? '' }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $item->usersHaveBought->count() }}</td>
                                                    <td>{{ $item->status }}</td>

                                                    <td class="text-right">
                                                        @if($item->type == config('enums.item_types.LIVE_URL'))
                                                            @if($item->external_url!=null)
                                                                <a href="{{url($item->external_url)}}"
                                                                   class="btn btn-outline-secondary">
                                                                    <i class="fa fa-link"></i>
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a href="{{$item->file_link}}" target="_blank"
                                                               class="btn btn-outline-secondary">
                                                                <i class="fa fa-file-pdf"></i>
                                                            </a>
                                                        @endif

                                                        @can('edit-items')
                                                            <a href="{{route('dashboard.items.edit',$item->id)}}"
                                                               class="btn btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('delete-items')
                                                            <button class="btn btn-danger delete"
                                                                    data-id="{{$item->id}}" type="button">
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
                                            <p>Looks like you have not added any items yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($items)>0)
                            <div class="text-center">
                                {{$items->links()}}
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
