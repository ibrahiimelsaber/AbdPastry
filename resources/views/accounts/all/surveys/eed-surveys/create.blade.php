@extends('layouts.dashboard-master')

@section('title','Create Eed Survey')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Eed Survey</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('all.account.eed-surveys.index',$account->Id)}}"
               class="ml-2 btn btn-primary">Return Back</a>
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
                            <h4>Add a New Eed Survey</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('all.account.eed-surveys.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <!--Account Id-->


                                <input name="AccountId" value="{{$account->Id}}" hidden/>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-3">
                                        <input type="text" name="accountId" value="Account Id"
                                               class="form-control font-weight-bolder text-center" disabled/>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <input type="text" name="accountId" value="{{old('Id',$account->Id)}}"
                                               class="form-control text-center @error('AccountId') is-invalid @enderror"
                                               disabled/>

                                        @error('AccountId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('AccountId') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!--Account Name-->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-3">
                                        <input type="text" value="Account Name"
                                               class="form-control font-weight-bolder text-center" disabled/>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <input type="text" name="Name" value="{{old('Name',$account->Name)}}"
                                               class="form-control text-center @error('Name') is-invalid @enderror"
                                               disabled/>

                                        @error('Name')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Name') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Eed Survey Q1 -->
                                <div class="form-group row  mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>

                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder btn btn-outline-primary"
                                                  id="inputGroup-sizing-default">Call Status</span>
                                        </div>
                                        <select
                                            class="form-control @error('EidCallStatusId') is-invalid @enderror text-center"
                                            name="EidCallStatusId" id="EidCallStatusId">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($status as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('EidCallStatusId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('EidCallStatusId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                <!-- Eed Survey Q1 -->
                                <div class="form-group row  mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>

                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 1</span>
                                        </div>
                                        <input type="text" value="حضرتك راضى عن منتجات العيد بشكل عام؟"
                                               class="form-control btn btn-outline-primary text-center" disabled/>
                                    </div>

                                </div>


                                <!-- Eed Survey Q1 Answer -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="Eid_q1_comment"
                                               class="form-control @error('Eid_q1_comment') is-invalid @enderror text-right"
                                               placeholder="التـــوضيــــح"/>
                                        @error('Eid_q1_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q1_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('Eid_q1ID') is-invalid @enderror text-center"
                                                name="Eid_q1ID" id="Eid_q1ID">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($EidQ1 as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('Eid_q1ID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q1ID') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>





                                <!-- Eed Survey Q2 -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 2</span>
                                        </div>
                                        <input type="text"
                                               value="هل لديك اى إقتراحات لتحسين منتجات العيد للسنة القادمة؟"
                                               class="form-control btn btn-outline-primary text-center" disabled/>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="Eid_q2_comment"
                                               class="form-control @error('Eid_q2_comment') is-invalid @enderror text-right"
                                               placeholder="التـــوضيــــح"/>
                                        @error('Eid_q2_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q2_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('Eid_q2ID') is-invalid @enderror text-center"
                                                name="Eid_q2ID" id="Eid_q2ID">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($EidQ2 as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('Eid_q2ID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q2ID') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Eed Survey Q3 -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 3</span>
                                        </div>
                                        <input type="text" value="هل حضرتك بتشترى منتجات العيد من مكان آخر؟"
                                               class="form-control btn btn-outline-primary  text-center " disabled/>

                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="Eid_q3_comment"
                                               class="form-control @error('Eid_q3_comment') is-invalid  @enderror text-right "
                                               placeholder="التـــوضيــــح"/>
                                        @error('Eid_q3_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q3_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('Eid_q3ID') is-invalid @enderror text-center"
                                                name="Eid_q3ID" id="Eid_q3ID">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($EidQ3 as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('Eid_q3ID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q3ID') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Eed Survey Q3 sub -->
                                <div class="form-group row mb-4 invisibleDiv" id="Ques3Sub">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 3 Sub</span>
                                        </div>
                                        <select
                                            class="form-control @error('Eid_q3_subID') is-invalid @enderror text-center"
                                            name="Eid_q3_subID" id="Eid_q3_subID">
                                        </select>
                                        @error('Eid_q3_subID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q3_subID') }}</p>
                                        </div>
                                        @enderror

                                    </div>
                                </div>


                                <!-- Eed Survey Q4 -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 4</span>
                                        </div>
                                        <input type="text" value="حضرتك إشتريت حلويات العيد من أى منفذ لحلويات العبد ؟"
                                               class="form-control btn btn-outline-primary  text-center " disabled/>

                                    </div>

                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="Eid_q4_comment"
                                               class="form-control @error('Eid_q4_comment') is-invalid  @enderror text-right "
                                               placeholder="التـــوضيــــح"/>
                                        @error('Eid_q4_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q4_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('Eid_q4ID') is-invalid @enderror text-center"
                                                name="Eid_q4ID" id="Eid_q4ID">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($EidQ4 as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('Eid_q4ID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q4ID') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <!-- Eed Survey Q5 -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 5</span>
                                        </div>
                                        <input type="text"
                                               value="هل واجه حضرتك أى مشكلة فى الفرع وحضرتك بتشترى أى منتج ؟"
                                               class="form-control btn btn-outline-primary  text-center " disabled/>

                                    </div>

                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="Eid_q5_comment"
                                               class="form-control @error('Eid_q5_comment') is-invalid  @enderror text-right "
                                               placeholder="التـــوضيــــح"/>
                                        @error('Eid_q5_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q5_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('Eid_q5ID') is-invalid @enderror text-center"
                                                name="Eid_q5ID" id="Eid_q5ID">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($EidQ5 as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('Eid_q5ID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q5ID') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <!-- Eed Survey Q6 -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 6</span>
                                        </div>
                                        <input type="text" value="ماهو أكثر منتج بتفضله من منتجات العيد ؟"
                                               class="form-control btn btn-outline-primary  text-center " disabled/>

                                    </div>

                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="Eid_q6_comment"
                                               class="form-control @error('Eid_q6_comment') is-invalid  @enderror text-right "
                                               placeholder="التـــوضيــــح"/>
                                        @error('Eid_q6_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q6_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('Eid_q6ID') is-invalid @enderror text-center"
                                                name="Eid_q6ID" id="Eid_q6ID">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($EidQ6 as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('Eid_q6ID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q6ID') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <!-- Eed Survey Q6 sub -->
                                <div class="form-group row mb-4 invisibleDiv" id="Ques6Sub">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 6 Sub</span>
                                        </div>
                                        <select
                                            class="form-control @error('Eid_q6_subID') is-invalid @enderror text-center"
                                            name="Eid_q6_subID" id="Eid_q6_subID">
                                        </select>
                                        @error('Eid_q6_subID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q6_subID') }}</p>
                                        </div>
                                        @enderror

                                    </div>
                                </div>

                                <!-- Eed Survey Q7 -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 7</span>
                                        </div>
                                        <input type="text"
                                               value="هل يوجد منتج محدد من منتجات العيد تقوم بشراؤه من أماكن أخرى ؟"
                                               class="form-control btn btn-outline-primary  text-center " disabled/>
                                    </div>

                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="Eid_q7_comment"
                                               class="form-control @error('Eid_q7_comment') is-invalid  @enderror text-right "
                                               placeholder="التـــوضيــــح"/>
                                        @error('Eid_q7_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q7_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('Eid_q7ID') is-invalid @enderror text-center"
                                                name="Eid_q7ID" id="Eid_q7ID">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($EidQ7 as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('Eid_q7ID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q7ID') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <!-- Eed Survey Q6 sub -->
                                <div class="form-group row mb-4 invisibleDiv" id="Ques7Sub">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 7 Sub</span>
                                        </div>
                                        <select
                                            class="form-control @error('Eid_q7_subID') is-invalid @enderror text-center"
                                            name="Eid_q7_subID" id="Eid_q7_subID">
                                        </select>
                                        @error('Eid_q7_subID')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('Eid_q7_subID') }}</p>
                                        </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-12 col-md-9">
                                        <button type="submit" class="btn btn-primary">Save Survey</button>
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

            $('#Eid_q3ID').on('change', function () {
                var Eid_q3ID = $(this).val();
                console.log(Eid_q3ID)
                if (Eid_q3ID == 1288) {
                    $('#Ques3Sub').removeClass('invisibleDiv');
                    if (Eid_q3ID) {
                        $.ajax({
                            url: '/getSubQuestion/' + Eid_q3ID,
                            type: "GET",
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {

                                if (data) {
                                    $('#Eid_q3_subID').empty();
                                    $('#Eid_q3_subID').append('<option value="0" hidden>إختر الإجابة</option>');
                                    $.each(data, function (key, val) {
                                        // console.log('<option value="' + key + '">' + val + '</option>');
                                        $('select[name="Eid_q3_subID"]').append('<option value="' + key + '">' + val + '</option>');
                                    });
                                } else {
                                    $('#Eid_q3_subID').empty();
                                }
                            }
                        });
                    } else {
                        $('#Eid_q3_subID').empty();
                    }
                } else {
                    $('#Eid_q3_subID').empty();
                    $('#Ques3Sub').addClass('invisibleDiv');

                }

            });
            $('#Eid_q6ID').on('change', function () {
                var Eid_q6ID = $(this).val();
                console.log(Eid_q6ID)
                if (Eid_q6ID == 1321 || Eid_q6ID == 1322 || Eid_q6ID == 1323 || Eid_q6ID == 1324 || Eid_q6ID == 1325 || Eid_q6ID == 1326) {
                    $('#Ques6Sub').removeClass('invisibleDiv');
                    if (Eid_q6ID) {
                        $.ajax({
                            url: '/getSubQuestion/' + Eid_q6ID,
                            type: "GET",
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {

                                if (data) {
                                    $('#Eid_q6_subID').empty();
                                    $('#Eid_q6_subID').append('<option value="0" hidden>إختر الإجابة</option>');
                                    $.each(data, function (key, val) {
                                        // console.log('<option value="' + key + '">' + val + '</option>');
                                        $('select[name="Eid_q6_subID"]').append('<option value="' + key + '">' + val + '</option>');
                                    });
                                } else {
                                    $('#Eid_q6_subID').empty();
                                }
                            }
                        });
                    } else {
                        $('#Eid_q6_subID').empty();
                    }
                } else {
                    $('#Eid_q6_subID').empty();
                    $('#Ques6Sub').addClass('invisibleDiv');

                }

            });
            $('#Eid_q7ID').on('change', function () {
                var Eid_q7ID = $(this).val();
                console.log(Eid_q7ID)
                if (Eid_q7ID == 1347) {
                    $('#Ques7Sub').removeClass('invisibleDiv');
                    if (Eid_q7ID) {
                        $.ajax({
                            url: '/getSubQuestion/' + Eid_q7ID,
                            type: "GET",
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {

                                if (data) {
                                    $('#Eid_q7_subID').empty();
                                    $('#Eid_q7_subID').append('<option value="0" hidden>إختر الإجابة</option>');
                                    $.each(data, function (key, val) {
                                        // console.log('<option value="' + key + '">' + val + '</option>');
                                        $('select[name="Eid_q7_subID"]').append('<option value="' + key + '">' + val + '</option>');
                                    });
                                } else {
                                    $('#Eid_q7_subID').empty();
                                }
                            }
                        });
                    } else {
                        $('#Eid_q7_subID').empty();
                    }
                } else {
                    $('#Eid_q7_subID').empty();
                    $('#Ques7Sub').addClass('invisibleDiv');

                }

            });
        });
    </script>
@endsection
