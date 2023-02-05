@extends('layouts.dashboard-master')

@section('title','Edit Course, '.$course->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Course</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Course</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.courses.update',['course'=>$course->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name',$course->name)}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Student Grade --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Student Grade</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('student_grade_id') is-invalid @enderror"
                                                name="student_grade_id" id="student_grades_list">
                                            @foreach($student_grades as $student_grade)
                                                <option {{$student_grade->id==$course->student_grade?' selected ':''}}
                                                        value="{{$student_grade->id}}">{{$student_grade->grade}}</option>
                                            @endforeach
                                        </select>
                                        @error('student_grade_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('student_grade_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- subject --}}
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subject</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('subject_id') is-invalid @enderror"
                                                name="subject_id" id="subjects_list">
                                            @foreach($subjects as $subject)
                                                <option {{$subject->id==$course->subject_id?' selected ':''}}
                                                        value="{{$subject->id}}">{{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('subject_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Teacher --}}
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Teachers</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('teacher_id') is-invalid @enderror"
                                                name="teacher_id" id="teacher_list">
                                            @foreach($teachers as $teacher)
                                                <option {{$teacher->id==$course->teacher_id?' selected ':''}}
                                                        value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('teacher_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- subscription Type --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subscription Type</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('subscription_type') is-invalid @enderror"
                                                name="subscription_type" id="subscription_type">
                                            <option {{$course->subscription_type == 'MONTHLY'?' selected ':''}} value="MONTHLY">MONTHLY</option>
                                            <option {{$course->subscription_type == 'ONE_TIME_PAYMENT'?' selected ':''}} value="ONE_TIME_PAYMENT">ONE TIME PAYMENT</option>
                                        </select>
                                        @error('subscription_type')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('subscription_type') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- monthly_subscription_price --}}
                                <div class="form-group row mb-4 monthly_subscription_price">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Monthly Subscription Price</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" min="0" max="50000" name="monthly_subscription_price" value="{{old('monthly_subscription_price', $course->monthly_subscription_price)}}"
                                               class="form-control @error('monthly_subscription_price') is-invalid @enderror"
                                               placeholder="monthly subscription price">
                                        @error('monthly_subscription_price')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('monthly_subscription_price') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- one_time_payment_price --}}
                                <div class="form-group row mb-4 one_time_payment_price">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">One Time Payment Price</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" min="0" max="50000" name="one_time_payment_price" value="{{old('one_time_payment_price', $course->one_time_payment_price)}}"
                                               class="form-control @error('one_time_payment_price') is-invalid @enderror"
                                               placeholder="one time payment price">
                                        @error('one_time_payment_price')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('one_time_payment_price') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Start At --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start At</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" name="starts_at" value="{{old('starts_at', \Carbon\Carbon::parse($course->starts_at)->format('Y-m-d\TH:i'))}}"
                                               class="form-control @error('starts_at') is-invalid @enderror">
                                        @error('starts_at')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('starts_at') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Hides At --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hide At</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" name="hides_at" value="{{old('hides_at', \Carbon\Carbon::parse($course->hides_at)->format('Y-m-d\TH:i'))}}"
                                               class="form-control @error('hides_at') is-invalid @enderror">
                                        @error('hides_at')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('hides_at') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Archived --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Archived</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror" type="radio" name="archived" id="archived1" value="1" {{$course->archived == 1 ?' checked ':''}}>
                                            <label class="form-check-label" for="archived1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('archived') is-invalid @enderror" type="radio" name="archived" id="archived2" value="0" {{$course->archived == 0 ?' checked ':''}}>
                                            <label class="form-check-label" for="archived2">
                                                No
                                            </label>
                                        </div>
                                        @error('archived')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('archived') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Hidden --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hidden</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check">
                                            <input class="form-check-input @error('hidden') is-invalid @enderror" type="radio" name="hidden" id="hidden1" value="1" {{$course->hidden == 1 ?' checked ':''}}>
                                            <label class="form-check-label" for="hidden1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('hidden') is-invalid @enderror" type="radio" name="hidden" id="hidden2" value="0" {{$course->hidden == 0 ?' checked ':''}}>
                                            <label class="form-check-label" for="hidden2">
                                                No
                                            </label>
                                        </div>
                                        @error('hidden')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('hidden') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
            // --- Subscription Type --- //
            //-------------------------- */
            $(window).on('load', function (e) {
                const subscription_type_value = $('#subscription_type').val()
                if (subscription_type_value === 'MONTHLY') {
                    $('.one_time_payment_price').hide();
                    $('.monthly_subscription_price').show();
                }else{
                    $('.monthly_subscription_price').hide();
                    $('.one_time_payment_price').show();
                }
            });

            $('#subscription_type').on('change', function (e) {
                const subscription_type_value = this.value;
                if (subscription_type_value === 'MONTHLY') {
                    $('.one_time_payment_price').hide();
                    $('.monthly_subscription_price').show();
                }else{
                    $('.monthly_subscription_price').hide();
                    $('.one_time_payment_price').show();
                }
            });
        });
    </script>
@endsection
