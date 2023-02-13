@extends('layouts.dashboard-master')

@section('title', 'Show Profile ' . $post->id)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Show Post</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{ $post->user->name }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Faculty</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{ $post->faculty->name }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Text</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea style="width: 100% ;height: auto" disabled>{{ $post->text }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Likes</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{ $post->likes_count ?? '' }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post
                                    Comments</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{ $post->comments_count ?? '' }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Archived</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{ $post->archived == 1 ? 'Yes' : 'No' }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Created At</label>
                                <div class="col-sm-12 col-md-7">
                                    <input disabled type="text" value="{{ $post->created_at }}" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
