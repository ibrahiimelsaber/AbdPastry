@extends('layouts.dashboard-master')

@section('title','Edit Doctor, '.$doctor->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Doctor, {{$doctor->name}}</h1>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    {{--@include('dashboard.common._alert_validation_errors')--}}
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Doctor</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.doctors.update',$doctor->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- City --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">City</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('city_id') is-invalid @enderror"
                                                name="city_id" id="cities_list">
                                            @foreach($cities as $city)
                                                <option {{$city->id==$doctor->city_id?' selected ':''}}
                                                        value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('city_id') }}</p>
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
                                                <option {{$university->id==$doctor->university_id?' selected ':''}}
                                                        value="{{$university->id}}">{{$university->name}}</option>
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
                                                <option {{$faculty->id==$doctor->faculty_id?' selected ':''}}
                                                        value="{{$faculty->id}}">{{$faculty->name}}</option>
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
                                        <input type="text" name="name" value="{{old('name',$doctor->name)}}"
                                               class="form-control @error('name') is-invalid @enderror">
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
                                        <input type="text" name="email" value="{{old('email',$doctor->email)}}"
                                               class="form-control @error('email') is-invalid @enderror">
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
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               autocomplete="new-password"
                                               placeholder="New password (Only if you want to change the password)">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Confirm Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password"
                                               name="password_confirmation"
                                               class="form-control @error('password_confirmation') is-invalid @enderror"
                                               autocomplete="new-password">
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('password_confirmation') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    @if($doctor->avatar_link)
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <img src="{{ $doctor->avatar_link }}" alt="avatar"
                                                     class="avatar-presence mr-1" width="80">
                                            </div>
                                        </div>
                                    @endif
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="avatar"
                                               class="form-control @error('avatar') is-invalid @enderror">
                                        @error('avatar')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('avatar') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
            $('#cities_list').on('change', function (e) {
                const cityIdSelected = this.value;
                hydrateUniversities(cityIdSelected);
            });

            function hydrateUniversities(cityId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {cityId: cityId},
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
