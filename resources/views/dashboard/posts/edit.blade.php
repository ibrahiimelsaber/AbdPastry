@extends('layouts.dashboard-master')

@section('title','Edit Post '.$post->id)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Post</h1>
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
                            <h4>Update Post</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.posts.update',$post->id) }}">
                                @csrf
                                @method('PUT')

                                {{-- governorate --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Governorate</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('governorate_id') is-invalid @enderror"
                                                name="governorate_id" id="governorates_list">
                                            @foreach($governorates as $governorate)
                                                <option {{$post->faculty->governorate_id ==$governorate->id}}
                                                        value="{{old('governorate_id', $governorate->id)}}">{{$governorate->name}}</option>
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
                                                    <option {{$post->faculty->university_id==$university->id?' selected ':''}}  value="{{old('university_id',$university->id)}}">{{$university->name}}</option>
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
                                                <option {{$post->faculty_id==$faculty->id?' selected ':''}}
                                                        value="{{old('faculty_id',$faculty->id)}}">{{$faculty->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('faculty_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('faculty_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                {{--Text--}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Text</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="text" rows="10"
                                                  class="form-control @error('text') is-invalid @enderror" >{{old('text',$post->text)}}</textarea>
                                        @error('text')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('text') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{--Archived--}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Archived</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror"
                                                   type="radio" name="archived" id="archived1" value="1"
                                                {{ old('archived') == 1 ? ' checked' : ''}}>
                                            <label class="form-check-label" for="archived1">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror"
                                                   type="radio" name="archived" id="archived2" value="0"
                                                {{ old('archived') == 0 ? ' checked' : ''}}>
                                            <label class="form-check-label" for="archived2">No</label>
                                        </div>
                                        @error('archived')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('archived') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
            //
            // /* -------------------------//
            // // --- Select User Role --- //
            // //------------------------- */
            //
            // //  select user role at initialization
            // let role = $("input[name='role']:checked").val();
            // selectUserRole(role);
            //
            // //  select user role on change
            // $("input[type=radio][name='role']").change(function () {
            //     role = $("input[name='role']:checked").val();
            //     selectUserRole(role);
            // });
            //
            // function selectUserRole(role) {
            //     if (role === 'UNIVERSITY_STUDENT') {
            //         hydrateLevels('UNIVERSITY');
            //         $('.field_for_university').show();
            //         $('.field_for_school').hide();
            //     } else if (role === 'SCHOOL_STUDENT') {
            //         hydrateLevels('SCHOOL');
            //         $('.field_for_university').hide();
            //         $('.field_for_school').show();
            //     }
            // }


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
