@extends('layouts.dashboard-master')

@section('title','Create CreatorStudent')

@section('content')
    <section class="section">
        <div class="section-header"><h1>Add CreatorStudent</h1></div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @if(session('message'))
                        <div class="alert {{ session('class') }} alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert"><span>×</span></button>
                                {{ session('message') }}
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Add a New CreatorStudent</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.creator-students.store') }}">
                                @csrf

                                {{-- Governorate --}}
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
                                <div class="form-group row mb-4">
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
                                <div class="form-group row mb-4">
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

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name')}}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Full name.">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" name="email" value="{{old('email')}}"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Email address (should be unique).">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" name="password" autocomplete="new-password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Set an account password.">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Confirm
                                        Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" name="password_confirmation" autocomplete="new-password"
                                               class="form-control @error('password_confirmation') is-invalid @enderror"
                                               placeholder="Confirm account password.">
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password_confirmation') }}</p>
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
                    success: function (data) {
                        const $el = $("#universities_list");
                        $el.empty(); // remove old options
                        $.each(data, function (value, key) {
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
