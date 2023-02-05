@extends('layouts.dashboard-master')

@section('title','Create Notification')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Custom Notification</h1></div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    @include('dashboard.common._alert_validation_errors')
                    <div class="card">
                        {{--<div class="card-header">
                            <h4>Add a New Notification</h4>
                        </div>--}}
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.notifications.store') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <h5>Target Segment</h5>

                                {{-- Notification For --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Notification For</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="notification_for_university" name="notification_for"
                                                   value="UNIVERSITY" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="notification_for_university">University Students</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="notification_for_school" name="notification_for"
                                                   value="SCHOOL" class="custom-control-input"
                                                    {{ old('notification_for') == 'SCHOOL' ? ' checked' : ''}}>
                                            <label class="custom-control-label" for="notification_for_school">School Students</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Country --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Country</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('country_id') is-invalid @enderror"
                                                name="country_id" id="countries_list">
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('country_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- governorate --}}
                                <div class="form-group row mb-4 notification_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">governorate</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('governorate_id') is-invalid @enderror"
                                                name="governorate_id" id="governorates_list">
                                            @foreach($governorates as $governorate)
                                                <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('governorate_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('governorate_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- University --}}
                                <div class="form-group row mb-4 notification_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">University</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('university_id') is-invalid @enderror"
                                                name="university_id" id="universities_list">
                                            @foreach($universities as $university)
                                                <option value="{{$university->id}}">{{$university->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('university_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('university_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Faculty --}}
                                <div class="form-group row mb-4 notification_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Faculty</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('faculty_id') is-invalid @enderror"
                                                name="faculty_id" id="faculties_list">
                                            @foreach($faculties as $faculty)
                                                <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('faculty_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('faculty_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Level --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Level</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('level') is-invalid @enderror"
                                                name="level" id="levels_list">
                                            @foreach($levels as $level)
                                                <option>{{$level->label}}</option>
                                            @endforeach
                                        </select>
                                        @error('level')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('level') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <h5>Payload</h5>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" value="{{old('title')}}"
                                               class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('title') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                           for="description">Message</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control @error('message') is-invalid @enderror"
                                                  id="message" name="message" rows="4">{{old('message')}}</textarea>
                                        @error('message')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('message') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                         <button type="submit" class="btn btn-primary">Send</button>
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
        $(document).ready(function(){

            /* -------------------------//
            // --- Select Notification For --- //
            //------------------------- */

            //  select notification type at initialization
            let notificationFor = $("input[name='notification_for']:checked").val();
            selectNotificationFor(notificationFor);
            hydrateLevels(notificationFor);

            //  select notification type on change
            $("input[type=radio][name='notification_for']").change(function() {
                notificationFor = $("input[name='notification_for']:checked").val();
                selectNotificationFor(notificationFor);
                hydrateLevels(notificationFor);
            });

            function selectNotificationFor(notificationFor) {
                if (notificationFor==='UNIVERSITY'){
                    $('.notification_university').show();
                    $('.notification_school').hide();
                } else if(notificationFor==='SCHOOL'){
                    $('.notification_university').hide();
                    $('.notification_school').show();
                }
            }


            /* -----------------------//
            // --- Hydrate Levels --- //
            //----------------------- */
           function hydrateLevels(notificationFor) {
               $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
               $.ajax({
                   type: "GET",
                   data: {type: notificationFor},
                   url: '{{route('dashboard.levels.index')}}',
                   dataType: 'json',
                   success: function(data) {
                       const $el = $("#levels_list");
                       $el.empty(); // remove old options
                       $.each(data, function(value, key) {
                           $el.append($("<option></option>").attr("value", key.label).text(key.label));
                       });
                   }
               });
           }

            /* -----------------------//
            // --- Hydrate governorates --- //
            //----------------------- */
            $('#countries_list').on('change', function (e) {
                const countryIdSelected = this.value;
                hydrateGovernorates(countryIdSelected);
            });
            function hydrateGovernorates(countryId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {countryId: countryId},
                    url: '{{route('dashboard.json.governorates')}}',
                    dataType: 'json',
                    success: function(data) {
                        const $el = $("#governorates_list");
                        $el.empty(); // remove old options
                        $.each(data, function(value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.name));
                        });

                        hydrateUniversities($('#governorates_list').val());
                    }
                });
            }

            /* ---------------------------//
            // -- Hydrate Universities -- //
            //--------------------------- */
            $('#governorates_list').on('change', function (e) {
                const governorateIdSelected = this.value;
                hydrateUniversities(governorateIdSelected);
            });
            function hydrateUniversities(governorateId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {governorateId: governorateId},
                    url: '{{route('dashboard.json.universities')}}',
                    dataType: 'json',
                    success: function(data) {
                        const $el = $("#universities_list");
                        $el.empty(); // remove old options
                        $.each(data, function(value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.name));
                        });

                        hydrateFaculties($('#universities_list').val());
                    }
                });
            }

            /* --------------------------//
            // --- Hydrate Faculties --- //
            //-------------------------- */
            $('#universities_list').on('change', function (e) {
                const universityIdSelected = this.value;
                hydrateFaculties(universityIdSelected);
            });
            function hydrateFaculties(universityId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {universityId: universityId},
                    url: '{{route('dashboard.json.faculties')}}',
                    dataType: 'json',
                    success: function(data) {
                        const $el = $("#faculties_list");
                        $el.empty(); // remove old options
                        $.each(data, function(value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.name));
                        });

                        hydrateUniversitySubjects($('#faculties_list').val());
                    }
                });
            }

            /* ---------------------------------//
            // -- Hydrate UniversitySubjects -- //
            //--------------------------------- */
            $('#faculties_list').on('change', function (e) {
                const facultyIdSelected = this.value;
                hydrateUniversitySubjects(facultyIdSelected);
            });
            function hydrateUniversitySubjects(facultyId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {facultyId: facultyId},
                    url: '{{route('dashboard.json.university-subjects')}}',
                    dataType: 'json',
                    success: function(data) {
                        const $el = $("#university_subjects_list");
                        $el.empty(); // remove old options
                        $.each(data, function(value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.name));
                        });
                    }
                });
            }

        });
    </script>
@endsection
