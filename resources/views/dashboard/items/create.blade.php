@extends('layouts.dashboard-master')

@section('title','Create Item')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Item</h1>
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
                            <h4>Add a New Item</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.items.store') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                {{-- Subject --}}
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subject</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('subject_id') is-invalid @enderror"
                                                name="subject_id" id="subjects_list">
                                            <option>None</option>
                                            @foreach($subjects as $subject)
                                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('subject_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Course --}}
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('course_id') is-invalid @enderror"
                                                name="course_id" id="courses_list">
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('course_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Session --}}
{{--                                <div class="form-group row mb-4 field_for_university">--}}
{{--                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Session</label>--}}
{{--                                    <div class="col-sm-12 col-md-7">--}}
{{--                                        <select class="form-control @error('course_session_id') is-invalid @enderror"--}}
{{--                                                name="course_session_id" id="sessions_list">--}}
{{--                                            <option>None</option>--}}
{{--                                            @foreach($courseSessions as $courseSession)--}}
{{--                                                <option value="{{$courseSession->id}}">{{$courseSession->title}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('course_session_id')--}}
{{--                                        <div class="invalid-feedback">--}}
{{--                                            <p>{{ $errors->first('course_session_id') }}</p>--}}
{{--                                        </div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                {{-- Name --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Item Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name')}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Type --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('type') is-invalid @enderror" name="type"
                                                id="item_type">
                                            @foreach(config("enums.item_types") as $key=>$value)
                                                <option>{{$key}}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('type') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4" id="item_file_dev">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="file" value="{{old('file')}}"
                                               class="form-control @error('file') is-invalid @enderror">
                                        @error('file')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('file') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4" id="external_url_dev">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">External URL</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="url" name="external_url" value="{{old('external_url')}}"
                                               class="form-control @error('external_url') is-invalid @enderror">
                                        @error('external_url')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('external_url') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="image" value="{{old('image')}}"
                                               class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('image') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Author</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="author" value="{{old('author')}}"
                                               class="form-control @error('author') is-invalid @enderror">
                                        @error('author')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('author') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" step="0.01" name="price" value="{{old('price')}}"
                                               class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('price') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                           for="description">Description</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description"
                                                  rows="4">{{old('description')}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('description') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Add</button>
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

            $('#subjects_list').on('change', function (e) {
                const subjectIdSelected = this.value;
                hydrateCourses(subjectIdSelected);
            });
            /* --------------------------//
            // ---- Hydrate Courses ---- //
            //-------------------------- */
            function hydrateCourses(subjectId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {subjectId: subjectId},
                    url: '{{route('dashboard.json.courses')}}',
                    dataType: 'json',
                    success: function (data) {
                        const $el = $("#courses_list");
                        $el.empty(); // remove old options
                        $.each(data, function (value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.name));
                        });

                        hydrateCourseSessions($('#courses_list').val());
                    }
                });
            }

            $('#courses_list').on('change', function (e) {
                const courseIdSelected = this.value;
                hydrateCourseSessions(courseIdSelected);
            });
            /* ---------------------------//
            // - Hydrate CourseSessions - //
            //--------------------------- */
            function hydrateCourseSessions(courseId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {courseId: courseId},
                    url: '{{route('dashboard.json.course-sessions')}}',
                    dataType: 'json',
                    success: function (data) {
                        const $el = $("#sessions_list");
                        $el.empty(); // remove old options
                        $el.append($("<option></option>").text('None'));
                        $.each(data, function (value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.title));
                        });

                        // hydrateFaculties($('#sessions_list').val());
                    }
                });
            }

            /* -------------------------//
            // --- Change item Type --- //
            //------------------------- */
            const liveUrlConst = "{{config('enums.item_types.LIVE_URL')}}";
            $("#item_type").change(function () {
                const itemType = $("#item_type option:selected").val();
                if (itemType === liveUrlConst) {
                    $('#item_file_dev').hide();
                } else {
                    $('#item_file_dev').show();
                }
            });

        });
    </script>
@endsection
