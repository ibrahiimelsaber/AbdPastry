@extends('layouts.dashboard-master')

@section('title','Edit Item '.$item->title)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Item</h1>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Item</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.items.update',$item->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Item Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" value="{{old('name',$item->name)}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- subject / course / session --}}
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subject </label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('subject_id') is-invalid @enderror"
                                                name="subject_id">
                                            <option>None</option>
                                            @foreach($subjects as $subject)
                                                <option {{$item->subject_id== $subject->id?' selected':''}} value="{{$subject->id}}">{{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('subject_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course </label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('course_id') is-invalid @enderror"
                                                name="course_id">
                                            <option>None</option>
                                            @foreach($courses as $course)
                                                <option {{$item->course_id== $course->id?' selected':''}} value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('course_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Session </label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('course_session_id') is-invalid @enderror"
                                                name="course_session_id">
                                            <option>None</option>
                                            @foreach($courseSessions as $courseSession)
                                                <option {{$item->course_session_id== $courseSession->id?' selected':''}} value="{{$courseSession->id}}">{{$courseSession->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('course_session_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('course_session_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4 field_for_university">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Student Grade </label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('student_grade_id') is-invalid @enderror"
                                                name="student_grade_id">
                                            @foreach($studentGrades as $studentGrade)
                                                <option {{$item->student_grade_id== $studentGrade->id?' selected':''}} value="{{$studentGrade->id}}">{{$studentGrade->grade}}</option>
                                            @endforeach
                                        </select>
                                        @error('student_grade_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('student_grade_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('type') is-invalid @enderror"
                                                name="type">
                                            <option {{$item->type=='BOOK'?' selected':''}}>BOOK</option>
                                            <option {{$item->type=='SHEET'?' selected':''}}>SHEET</option>
                                            <option {{$item->type=='SUMMARY'?' selected':''}}>SUMMARY</option>
                                            <option {{$item->type=='OTHER'?' selected':''}}>OTHER</option>
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('type') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('status') is-invalid @enderror"
                                                name="status">
                                            <option {{$item->status=='APPROVED'?' selected':''}}>APPROVED</option>
                                            <option {{$item->status=='PENDING_REVIEW'?' selected':''}}>PENDING_REVIEW</option>
                                           </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('status') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Level</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('level') is-invalid @enderror"
                                                name="level">
                                            @foreach($levels as $level)
                                                <option {{$item->level==$level->label?' selected':''}}>{{$level->label}}</option>
                                            @endforeach
                                        </select>
                                        @error('level')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('level') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New File</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="file"
                                               class="form-control @error('file') is-invalid @enderror">
                                        @error('file')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('file') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    @if($item->image_link)
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <img src="{{ $item->image_link }}" alt="image"
                                                     class="avatar-presence mr-1" width="80">
                                            </div>
                                        </div>
                                    @endif
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="image"
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
                                        <input type="text" name="author" value="{{old('author',$item->author)}}"
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
                                        <input type="number" step="0.01" name="price" value="{{old('price',$item->price)}}"
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
                                                  id="description" name="description" rows="4">{{old('description',$item->description)}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('description') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">School Subject</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('school_subject_id') is-invalid @enderror"
                                                name="school_subject_id">
                                            @foreach($schoolSubjects as $schoolSubject)
                                                <option {{ $item->school_subject_id==$schoolSubject->id?' selected':'' }}
                                                        value="{{$schoolSubject->id}}">{{$schoolSubject->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('school_subject_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('school_subject_id') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">University Subject</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('university_subject_id') is-invalid @enderror"
                                                name="university_subject_id">
                                            @foreach($universitySubjects as $universitySubject)
                                                <option {{ $item->university_subject_id==$universitySubject->id?' selected':'' }}
                                                        value="{{$universitySubject->id}}">{{$universitySubject->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('university_subject_id')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('university_subject_id') }}</p>
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
