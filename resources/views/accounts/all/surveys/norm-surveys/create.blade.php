@extends('layouts.dashboard-master')

@section('title','Create  Survey')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Survey</h1>
            <h1 class="ml-2">|| </h1>
            <a href="{{route('all.account.surveys.index',$account->Id)}}"
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
                            <h4>Add a New Survey</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('all.account.surveys.store') }}"
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


                                <!--  Call Status -->
                                <div class="form-group row  mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>

                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder btn btn-outline-primary"
                                                  id="inputGroup-sizing-default">Call Status</span>
                                        </div>
                                        <select
                                            class="form-control @error('EidCallStatusId') is-invalid @enderror text-center"
                                            name="normCallStatusId" id="normCallStatusId">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($status as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('normCallStatusId')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('normCallStatusId') }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <!--  Main Q-->
                                <div class="form-group row  mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>

                                    <div class="input-group col-sm-12 col-md-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Main Question</span>
                                        </div>
                                        <input type="text" value="ايه اكتر منتجات حضرتك بتشتريها من العبد ؟"
                                               class="form-control btn btn-outline-primary text-center" disabled/>
                                    </div>

                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                    <div class="col-sm-6 col-md-6 text-right">
                                        <input type="text" name="norm_mainQ_comment"
                                               class="form-control @error('norm_mainQ_comment') is-invalid @enderror text-right"
                                               placeholder="التـــوضيــــح"/>
                                        @error('norm_mainQ_comment')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('norm_mainQ_comment') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <select class="form-control @error('MainQId') is-invalid @enderror text-center"
                                                name="norm_mainQ" id="norm_mainQ">
                                            <option value="0">إختر الإجابة</option>
                                            @foreach($mainQuestion as $id => $value)
                                                <option value="{{$id}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('norm_mainQ')
                                        <div class="invalid-feedback">
                                            <p>{{ $errors->first('norm_mainQ') }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="invisibleDiv" id="group1">
                                    <!-- START OF GROUP ONE SURVEY حلويات المولد-->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="input-group col-sm-12 col-md-9">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 1</span>
                                            </div>
                                            <input type="text"
                                                   value=" ما مدى رضاء حضرتك عن منتجات حلويات المولد بشكل عام ؟"
                                                   class="form-control btn btn-outline-primary text-center" disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="col-sm-6 col-md-6 text-right">
                                            <input type="text" name="norm_q1_comment"
                                                   class="form-control @error('norm_q1_comment') is-invalid @enderror text-right"
                                                   placeholder="التـــوضيــــح"/>
                                            @error('norm_q1_comment')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q1_comment') }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 col-md-3 text-right">
                                            <select
                                                class="form-control @error('norm_q1ID') is-invalid @enderror text-center"
                                                name="norm_q1ID" id="norm_q1ID">
                                                <option value="0">إختر الإجابة</option>
                                                @foreach($NormQ1 as $id => $value)
                                                    <option value="{{$id}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('norm_q1ID')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q1ID') }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <!--  Survey Q2 -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="input-group col-sm-12 col-md-9">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 2</span>
                                            </div>
                                            <input type="text" value="هل حضرتك بتشترى منتجات حلويات المولد من حد تاني ؟"
                                                   class="form-control btn btn-outline-primary  text-center " disabled/>

                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="col-sm-6 col-md-6 text-right">
                                            <input type="text" name="norm_q3_comment"
                                                   class="form-control @error('norm_q3_comment') is-invalid  @enderror text-right "
                                                   placeholder="التـــوضيــــح"/>
                                            @error('norm_q3_comment')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q3_comment') }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6 col-md-3 text-right">
                                            <select
                                                class="form-control @error('norm_q3ID') is-invalid @enderror text-center"
                                                name="norm_q3ID" id="norm_q3ID">
                                                <option value="0">إختر الإجابة</option>
                                                @foreach($NormQ3 as $id => $value)
                                                    <option value="{{$id}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('norm_q3ID')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q3ID') }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!--  Survey Q2 sub -->
                                    <div class="form-group row mb-4 invisibleDiv" id="Ques3Sub">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="input-group col-sm-12 col-md-9">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 3 Sub</span>
                                            </div>
                                            <select
                                                class="form-control @error('norm_q3_subID') is-invalid @enderror text-center"
                                                name="norm_q3_subID" id="norm_q3_subID">
                                            </select>
                                            @error('norm_q3_subID')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q3_subID') }}</p>
                                            </div>
                                            @enderror

                                        </div>
                                    </div>


                                    <!--  Survey Q3 -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="input-group col-sm-12 col-md-9">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 3</span>
                                            </div>
                                            <input type="text"
                                                   value="حضرتك اشتريت حلويات المولد من أى منفذ لحلوانى العبد ؟"
                                                   class="form-control btn btn-outline-primary  text-center " disabled/>

                                        </div>

                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="col-sm-6 col-md-6 text-right">
                                            <input type="text" name="norm_q4_comment"
                                                   class="form-control @error('norm_q4_comment') is-invalid  @enderror text-right "
                                                   placeholder="التـــوضيــــح"/>
                                            @error('norm_q4_comment')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q4_comment') }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 col-md-3 text-right">
                                            <select
                                                class="form-control @error('norm_q1ID') is-invalid @enderror text-center"
                                                name="norm_q1ID" id="norm_q1ID">
                                                <option value="0">إختر الإجابة</option>
                                                @foreach($NormQ4 as $id => $value)
                                                    <option value="{{$id}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('norm_q1ID')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q1ID') }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                    </div>


                                    <!--  Survey Q5 -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="input-group col-sm-12 col-md-9">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 4</span>
                                            </div>
                                            <input type="text"
                                                   value="هل واجه حضرتك اي مشكلة في الفرع و حضرتك بتشترى اي منتج من المنتجات ؟"
                                                   class="form-control btn btn-outline-primary  text-center " disabled/>

                                        </div>

                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="col-sm-6 col-md-6 text-right">
                                            <input type="text" name="norm_q5_comment"
                                                   class="form-control @error('norm_q5_comment') is-invalid  @enderror text-right "
                                                   placeholder="التـــوضيــــح"/>
                                            @error('norm_q5_comment')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q5_comment') }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 col-md-3 text-right">
                                            <select
                                                class="form-control @error('norm_q5ID') is-invalid @enderror text-center"
                                                name="norm_q5ID" id="norm_q5ID">
                                                <option value="0">إختر الإجابة</option>
                                                @foreach($NormQ5 as $id => $value)
                                                    <option value="{{$id}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('norm_q5ID')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q5ID') }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                    </div>

                                    <!--  Survey Q6 -->
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="input-group col-sm-12 col-md-9">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 5</span>
                                            </div>
                                            <input type="text" value="ماهو أكثر منتج بتفضله من منتجات المولد ؟"
                                                   class="form-control btn btn-outline-primary  text-center " disabled/>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="col-sm-6 col-md-6 text-right">
                                            <input type="text" name="norm_q6_comment"
                                                   class="form-control @error('norm_q6_comment') is-invalid  @enderror text-right "
                                                   placeholder="التـــوضيــــح"/>
                                            @error('norm_q6_comment')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q6_comment') }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6 col-md-3 text-right">
                                            <select
                                                class="form-control @error('norm_q6ID') is-invalid @enderror text-center"
                                                name="norm_q6ID" id="norm_q6ID">
                                                <option value="0">إختر الإجابة</option>
                                                @foreach($NormQ6 as $id => $value)
                                                    <option value="{{$id}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('norm_q6ID')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q6ID') }}</p>
                                            </div>
                                            @enderror
                                        </div>

                                    </div>


                                    <!--  Survey Q6 sub -->
                                    <div class="form-group row mb-4 invisibleDiv" id="Ques6Sub">
                                        <label class="col-form-label  col-12 col-md-2 col-lg-1"></label>
                                        <div class="input-group col-sm-12 col-md-9">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bolder"
                                                  id="inputGroup-sizing-default">Question 5 Sub</span>
                                            </div>
                                            <select
                                                class="form-control @error('norm_q6_subID') is-invalid @enderror text-center"
                                                name="norm_q6_subID" id="norm_q6_subID">
                                            </select>
                                            @error('norm_q6_subID')
                                            <div class="invalid-feedback">
                                                <p>{{ $errors->first('norm_q6_subID') }}</p>
                                            </div>
                                            @enderror
                                        </div>
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

            $('#norm_q3ID').on('change', function () {
                var norm_q3ID = $(this).val();
                console.log(norm_q3ID)
                if (norm_q3ID == 1836) {
                    $('#Ques3Sub').removeClass('invisibleDiv');
                    if (norm_q3ID) {
                        $.ajax({
                            url: '/getSubQuestion/' + norm_q3ID,
                            type: "GET",
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {

                                if (data) {
                                    $('#norm_q3_subID').empty();
                                    $('#norm_q3_subID').append('<option value="0" hidden>إختر المكان</option>');
                                    $.each(data, function (key, val) {
                                        $('select[name="norm_q3_subID"]').append('<option value="' + key + '">' + val + '</option>');
                                    });
                                } else {
                                    $('#norm_q3_subID').empty();
                                }
                            }
                        });
                    } else {
                        $('#norm_q3_subID').empty();
                    }
                } else {
                    $('#norm_q3_subID').empty();
                    $('#Ques3Sub').addClass('invisibleDiv');

                }

            });
            $('#norm_q6ID').on('change', function () {
                var norm_q6ID = $(this).val();

                if (norm_q6ID == 1870 || norm_q6ID == 1872 || norm_q6ID == 1873 || norm_q6ID == 1874) {
                    $('#Ques6Sub').removeClass('invisibleDiv');
                    if (norm_q6ID) {
                        $.ajax({
                            url: '/getSubQuestion/' + norm_q6ID,
                            type: "GET",
                            data: {"_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {

                                if (data) {
                                    $('#norm_q6_subID').empty();
                                    $('#norm_q6_subID').append('<option value="0" hidden>إختر المنتج</option>');
                                    $.each(data, function (key, val) {
                                        // console.log('<option value="' + key + '">' + val + '</option>');
                                        $('select[name="norm_q6_subID"]').append('<option value="' + key + '">' + val + '</option>');
                                    });
                                } else {
                                    $('#norm_q6_subID').empty();
                                }
                            }
                        });
                    } else {
                        $('#norm_q6_subID').empty();
                    }
                } else {
                    $('#norm_q6_subID').empty();
                    $('#Ques6Sub').addClass('invisibleDiv');

                }

            });

            $('#norm_mainQ').on('change', function () {
                var norm_mainQ = $(this).val();

                if (norm_mainQ == 915) {
                    $('#group1').removeClass('invisibleDiv');
                } else {
                    $('#group1').addClass('invisibleDiv');
                }
            });


        });
    </script>
@endsection
