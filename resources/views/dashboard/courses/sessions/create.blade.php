@extends('layouts.dashboard-master')

@section('title','Create Course Session')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Session for the Course, {{$course->name}}</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    @include('dashboard.common._alert_validation_errors')
                    <div class="card">
                        <div class="card-header">
                            <h4>Add new Session</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.courses.sessions.index',[$course->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                {{-- Session Title --}}
                                <div class="form-group row mb-4 field_for_school">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >Session Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" value="{{old('title')}}"
                                               class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Session title">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('title') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Free Perview --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Free Preview</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check">
                                            <input class="form-check-input @error('free_preview') is-invalid @enderror"
                                                   type="radio" name="free_preview" id="free_preview1" value="1">
                                            <label class="form-check-label" for="free_preview1">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('free_preview') is-invalid @enderror"
                                                   type="radio" name="free_preview" id="free_preview2" value="0"
                                                   checked>
                                            <label class="form-check-label" for="free_preview2">No</label>
                                        </div>
                                        @error('free_preview')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('free_preview') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- session Type --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Session Type</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('session_type') is-invalid @enderror"
                                                name="session_type" id="session_type">
                                            <option value="{{\App\Http\Enums\CourseSessionTypes::LIVE}}">Live</option>
                                            <option value="{{\App\Http\Enums\CourseSessionTypes::EXTERNAL_VIDEO}}">External Video</option>
                                            <option value="{{\App\Http\Enums\CourseSessionTypes::INTERNAL_VIDEO}}">Internal Video</option>
                                        </select>
                                        @error('session_type')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('session_type') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- External Video URL --}}
                                <div class="form-group row mb-4 session_type_external_video">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">External Video URL</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="external_video" value="{{old('external_video')}}"
                                               class="form-control @error('external_video') is-invalid @enderror">
                                        @error('external_video')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('external_video') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- SECRET --}}
                                <div class="form-group row mb-4 session_type_external_video">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Secret</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="secret" value="{{old('secret')}}"
                                               class="form-control @error('secret') is-invalid @enderror">
                                        @error('secret')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('secret') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Internal Video --}}
                                <div class="form-group row mb-4 session_type_internal_video">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Upload Video</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="internal_video" value="{{old('internal_video')}}"
                                               accept="video/mp4"
                                               class="form-control @error('internal_video') is-invalid @enderror">
                                        @error('internal_video')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('internal_video') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Avaliable From --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Available From</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" name="available_from"
                                               value="{{old('available_from')}}"
                                               class="form-control @error('available_from') is-invalid @enderror">
                                        @error('available_from')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('available_from') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Avaliable To --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Available To</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" name="available_to" value="{{old('available_to')}}"
                                               class="form-control @error('available_to') is-invalid @enderror">
                                        @error('available_to')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('available_to') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Save New Session</button>
                                        <a href="{{url()->previous()}}" class="btn btn-outline-dark">Cancel</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            /* --------------------------//
            // -- Select Session Type -- //
            //-------------------------- */

            //  select session type at initialization
            let sessionType = $("#session_type option:selected").val();
            selectNotificationFor(sessionType);

            //  select session type on change
            $("#session_type").change(function () {
                sessionType = $("#session_type option:selected").val();
                selectNotificationFor(sessionType);
            });

            function selectNotificationFor(sessionType) {

                const live = "{{\App\Http\Enums\CourseSessionTypes::LIVE}}";
                const externalVideo = "{{\App\Http\Enums\CourseSessionTypes::EXTERNAL_VIDEO}}";
                const internalVideo = "{{\App\Http\Enums\CourseSessionTypes::INTERNAL_VIDEO}}";

                if (sessionType === live) {
                    $('.session_type_live').show();
                    $('.session_type_external_video').hide();
                    $('.session_type_internal_video').hide();
                } else if (sessionType === externalVideo) {
                    $('.session_type_live').hide();
                    $('.session_type_external_video').show();
                    $('.session_type_internal_video').hide();
                } else if (sessionType === internalVideo) {
                    $('.session_type_live').hide();
                    $('.session_type_external_video').hide();
                    $('.session_type_internal_video').show();
                }
            }

        });
    </script>
@endsection
