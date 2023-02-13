@extends('layouts.dashboard-master')

@section('title','Manage Fields')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Manage Fields</h1></div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-fields')
                <div class="card">
                    <div class="card-header">
                        <h4>Fields <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-fields')
                                <a href="{{route('dashboard.fields.create')}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($fields)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Label</th>

                                        <th></th>
                                    </tr>
                                    @foreach($fields as $field)
                                        <tr>
                                            <td>{{ $field->label }}</td>
                                            <td class="text-right">
                                                @can('edit-fields')
                                                    <a href="{{route('dashboard.fields.edit',$field->id)}}"
                                                       class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-fields')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$field->id}}" type="button">
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
                                    <p>Looks like you have not added any fields yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($fields)>0)
                    <div class="text-center">
                        {{$fields->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
