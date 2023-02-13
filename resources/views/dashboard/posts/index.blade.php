@extends('layouts.dashboard-master')

@section('title','Manage Posts')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Posts</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._header_search')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">
            @can('view-posts')
                <div class="card">
                    <div class="card-header">
                        <h4>Posts <span>({{ $total }})</span></h4>
                        <div class="card-header-action">
                            @can('create-posts')
                                <a href="{{route('dashboard.posts.create')}}"
                                   class="btn btn-primary"><i class="fas fa-plus"></i> Add New Post</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            @if(count($posts)>0)
                                <table class="table table-responsive-sm table-hover table-outline">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Post Text</th>
                                        {{--<th>Likes</th>--}}
                                        {{--<th>Comments</th>--}}
                                        <th>Created At</th>
                                        <th>Archived</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>
                                                <div>{{ $post->user->name }}</div>
                                                <div class="small text-muted">{{ $post->faculty->name }}</div>
                                            </td>
                                            <td class="col-3">
                                                @if(strlen($post->text) > 100)
                                                    {{ substr($post->text, 0,100)."..." }}
                                                    <a href="{{route('dashboard.posts.show',  $post->id)}}">(More)</a>
                                                @else
                                                    {{ substr($post->text, 0,100) }}
                                                @endif
                                            </td>
                                            {{--<td>{{$post->likes_count}}</td>--}}
                                            {{--<td>{{$post->comments_count}}</td>--}}
                                            <td> <div class="small text-muted">{{ $post->created_at }}</div></td>
                                            <td>{{ $post->archived == 1 ? 'YES' : 'NO' }}</td>

                                            <td>
                                                <div>
                                                    <form method="POST"
                                                          action="{{route('dashboard.posts.archive',["post"=>$post->id])}}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="btn btn-dark"> {{$post->archived == 1 ? 'Unarchive' : 'Archive'}}
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="ml-1">
                                                    @can('view-posts')
                                                        <a href="{{route('dashboard.posts.show',$post->id)}}"
                                                           class="btn btn-warning"><i class="fa fa-eye"></i>
                                                        </a>
                                                    @endcan

                                                    {{--
                                                    @can('edit-posts')
                                                        <a href="{{route('dashboard.posts.edit',$post->id)}}"
                                                           class="btn btn-primary"><i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete-posts')
                                                        <button class="btn btn-danger delete"
                                                                data-id="{{$post->id}}" type="button">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endcan
                                                    --}}
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center p-3 text-muted">
                                    <h5>No Results</h5>
                                    <p>Looks like you have not added any posts yet!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($posts)>0)
                    {{ $posts->links() }}
                @endif
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
    @include('dashboard.common._modal_delete')
@endsection
