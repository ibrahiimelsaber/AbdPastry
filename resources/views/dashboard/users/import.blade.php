@extends('layouts.dashboard-master')

@section('title','Import Students')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Import Students</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('dashboard.users.index')}}"
                   class="btn btn-outline-primary">Back to All Users</a>
            </div>
        </div>
        @include('dashboard.common._alert_message')
        @include('dashboard.common._alert_validation_errors')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Import Students</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route("dashboard.users.import")}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >User Role</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="role_university_student" name="role"
                                                   value="{{\App\Http\Enums\UserRoles::ROLE_UNIVERSITY_STUDENT}}"
                                                   class="custom-control-input" checked>
                                            <label class="custom-control-label"
                                                   for="role_university_student">University Student</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="role_school_student" name="role"
                                                   value="{{\App\Http\Enums\UserRoles::ROLE_SCHOOL_STUDENT}}"
                                                   class="custom-control-input"
                                                {{ old('role') == 'SCHOOL_STUDENT' ? ' checked' : ''}}>
                                            <label class="custom-control-label"
                                                   for="role_school_student">School Student</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- governorate --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Governorate</label>
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
                                <div class="form-group row mb-4 field_for_university">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">University</label>
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
                                <div class="form-group row mb-4 field_for_university">
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

                                {{-- School Name --}}
                                <div class="form-group row mb-4 field_for_school">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                    >School Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="school_name" value="{{old('school_name')}}"
                                               class="form-control @error('school_name') is-invalid @enderror"
                                               placeholder="School Name of the user">
                                        @error('school_name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('school_name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Student Grade--}}
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Student
                                        Grade </label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('student_grade_id') is-invalid @enderror"
                                                name="student_grade_id">
                                            @foreach($studentGrades as $studentGrade)
                                                <option value="{{$studentGrade->id}}">{{"$studentGrade->educational_level - $studentGrade->grade"}}</option>
                                            @endforeach
                                        </select>
                                        @error('student_grade_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('student_grade_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Excel File--}}
                                <div class="form-group row mb-4 notification_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Excel
                                        File</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="file" name="file">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Import</button>
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

            /* -------------------------//
            // --- Select User Role --- //
            //------------------------- */

            //  select user role at initialization
            let role = $("input[name='role']:checked").val();
            selectUserRole(role);

            //  select user role on change
            $("input[type=radio][name='role']").change(function () {
                role = $("input[name='role']:checked").val();
                selectUserRole(role);
            });

            function selectUserRole(role) {
                if (role === 'UNIVERSITY_STUDENT') {
                    hydrateLevels('UNIVERSITY');
                    $('.field_for_university').show();
                    $('.field_for_school').hide();
                } else if (role === 'SCHOOL_STUDENT') {
                    hydrateLevels('SCHOOL');
                    $('.field_for_university').hide();
                    $('.field_for_school').show();
                }
            }


            /* -----------------------//
            // --- Hydrate Levels --- //
            //----------------------- */
            function hydrateLevels(itemFor) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {type: itemFor},
                    url: '{{route('dashboard.levels.index')}}',
                    dataType: 'json',
                    success: function (data) {
                        const $el = $("#levels_list");
                        $el.empty(); // remove old options
                        $.each(data, function (value, key) {
                            $el.append($("<option></option>").attr("value", key.label).text(key.label));
                        });
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
                    success: function (data) {
                        const $el = $("#faculties_list");
                        $el.empty(); // remove old options
                        $.each(data, function (value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.name));
                        });
                    }
                });
            }

        });
    </script>
@endsection
