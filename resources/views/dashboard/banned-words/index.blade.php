@extends('layouts.dashboard-master')

@section('title','Manage Banned-Words')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Banned-Words</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-banned-words')
                <div class="card">
                    <div class="card-header">
                        <h4>Banned-Words <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-banned-words')
                                <a href="{{route('dashboard.banned-words.create')}}"
                                   class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($bannedWords)>0)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Category</th>
                                        <th>Word</th>

                                        <th></th>
                                    </tr>
                                    @foreach($bannedWords as $bannedWord)
                                        <tr>
                                            <td>{{ $bannedWord->category }}</td>
                                            <td>{{ $bannedWord->word }}</td>
                                            <td class="text-right">
                                                @can('edit-banned-words')
                                                    <a href="{{route('dashboard.banned-words.edit',$bannedWord->id)}}"
                                                       class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-banned-words')
                                                    <button class="btn btn-danger delete"
                                                            data-id="{{$bannedWord->id}}" type="button">
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
                                    <p>Looks like you have not added any banned-words yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($bannedWords)>0)
                    <div class="text-center">
                        {{$bannedWords->links()}}
                    </div>
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
