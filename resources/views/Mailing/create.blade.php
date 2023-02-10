@include('layouts.header')

<style>
    .com_data {
        display: none;
    }
</style>
<style>
    .loader {
        position: absolute;
        left:40%;
        top:10%;
        border: 16px solid #666; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 60px;
        height: 60px;
        z-index: 1001;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="content-wrapper">

    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <!-- Main content -->
    <section class="content">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Create Mailing item </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="glyphicon glyphicon-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            {{Form::Open(array('url'=>'mailing', 'method'=>"Post","onsubmit"=>"javascript:if(!all_valid){alert('validate fields'); return false; }"))}}
            <div class="box-body">
                <div class="row">

                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Type <font color="red">*</font></label>
                        {{Form::select("type" ,$srTypesList,null, array('class'=>"form-control select",'required'=>'required' , 'id' => 'srType' ))}}
                        {{Form::hidden("type" ,null, array('id' => 'srTypeTxt' ))}}

                    </div>
                </div>
                    
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Type  <font color="red">*</font></label>

                        {{Form::select("subType" ,array(),null, array('class'=>"form-control select",'required'=>'required' , 'id' => 'srSubType' ))}}
                        {{Form::hidden("subType" ,null, array('id' => 'srSubTypeTxt' ))}}
                    </div>
                </div>
                
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Type 2 <font color="red">*</font></label>
                        {{Form::select("subType2" ,array(),null, array('class'=>"form-control select",'required'=>'required' , 'id' => 'srSubType2' ))}}
                        {{Form::hidden("subType2" ,null, array('id' => 'srSubType2Txt' ))}}

                    </div>
                </div>
                
                    
                        <div class="col-md-4">

                    <div class="form-group">
                        <label>Status <font color="red"></font></label>
                        {{Form::select("status" ,$SRStatusList,null, array('class'=>"form-control select" , 'id' => 'statusId' ,'required'=>'required'))}}

                    </div>

                </div>
                    
                    <div class="col-md-4">

                    <div class="form-group">
                        <label>Brand <font color="red"></font></label>
                        {{Form::select("brand" ,$brandsList,null, array('class'=>"form-control select" , 'id' => 'brandId' ,'required'=>'required'))}}

                    </div>

                </div>
                    
                    <div class="col-md-4" id='serviceCenterIdDiv'>

                    <div class="form-group">
                        <label>Service Center <font color="red"></font></label>
                        {{Form::select("branch" ,$serviceCentersList,null, array('class'=>"form-control select",'id'=>"serviceCenterId" ,'required'=>'required' ))}}

                    </div>

                </div>

              
                   
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Subject</label>
                            {{Form::text('subject',null,array("class"=>"form-control","required"=>"required"))}}

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>To</label>
                            {{Form::textarea('mailTo',null,array("class"=>"form-control","onchange"=>"validate(this)","required"=>"required"))}}

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>CC</label>
                            {{Form::textarea('mailCC',null,array("class"=>"form-control","onchange"=>"validate(this)"))}}

                        </div>
                    </div>

                    <div style="text-align: right;" class="col-md-12">
                        <div class="form-group">
                            <label style="visibility: hidden">Save</label><br />
                            <input type="submit" class="btn btn-primary btn-md" value="Save">
                        </div>


                    </div>
                    <input type="hidden" id="Url" value="{{URL::to('requests')}}" />

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>


            </form>
            <!-- /.box-body -->

        </div>
    </section>  
    <!-- /.content -->
</div>

<script>
    var all_valid = true;
    
    function validate(e){   
    //remove last semicolon if any
    var lastChar = e.value.trim().slice(-1);
    if (lastChar == ';') {
        e.value = e.value.trim().slice(0, -1);
    }
    var emailsArr = e.value.split(";");
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var valid = true;
    for (var i = 0; i < emailsArr.length; i++) {
         if(! regex.test(emailsArr[i])){
             valid = false;
         }
    }
    if (!valid)
    {
        alert('not valid');
        all_valid = false;
    }
    else
        all_valid = true;
    }
    </script>
    
    
    <script>
    
    
    $("#srType").change(function () {
        getsrSubType();
        $("#srTypeTxt").val($("#srType option:selected").text());
    });
    
    
    /*$("#serviceCenterId").change(function () {
        if ($("#srSubType").val() == '119')
            getServiceAdvisor();

    });*/

    function getsrSubType() {
        var formData = {
            srType: $("#srType").val()
        };


        $.ajax({
            type: 'get',
            url: $("#Url").val() + '/subType',
            data: formData,
            dataType: 'json',
            beforeSend: function ()
            {
                document.getElementById('srSubType').disabled = "disabled";
                $('.form-group').css('opacity', '0.2');

            },
            success: function (data) {

                var parentSelect = document.getElementById('srSubType');
                var srSubTypeList = data['srSubTypeList'];
                parentSelect.length = 0;
                var field;

                var option = document.createElement("option");
                option.text = "";
                option.value = "";
                parentSelect.add(option);

                for (i = 0; i < srSubTypeList.length; i++)
                {
                    field = srSubTypeList[i];
                    var option = document.createElement("option");
                    option.text = field['Name'];
                    option.value = field['Id'];
                    parentSelect.add(option);
                }
                document.getElementById('srSubType').disabled = false;
                $('.form-group').css('opacity', '1');

            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
            }
        });

    }


    $("#srSubType").change(function () {
        getsrSubType2();
        
        $("#srSubTypeTxt").val($("#srSubType option:selected").text());
        
    });

    function getsrSubType2() {
        var formData = {
            srSubType: $("#srSubType").val()
        };

        $.ajax({
            type: 'get',
            url: $("#Url").val() + '/subType2',
            data: formData,
            dataType: 'json',
            beforeSend: function ()
            {
                document.getElementById('srSubType').disabled = "disabled";
                $('.form-group').css('opacity', '0.2');

            },
            success: function (data) {

                var parentSelect = document.getElementById('srSubType2');
                var srSubType2List = data['srSubType2List'];
                parentSelect.length = 0;
                var field;
                var option = document.createElement("option");
                option.text = "";
                option.value = "";
                parentSelect.add(option);
                for (i = 0; i < srSubType2List.length; i++)
                {
                    field = srSubType2List[i];
                    var option = document.createElement("option");
                    option.text = field['Name'];
                    option.value = field['Id'];
                    parentSelect.add(option);
                }
                document.getElementById('srSubType').disabled = false;
                $('.form-group').css('opacity', '1');
                

            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
            }
        });

    }

    
        $("#srSubType2").change(function () {
        $("#srSubType2Txt").val($("#srSubType2 option:selected").text());
        
    });

    

   
</script>

<script>
    $("#srSubType2").change(function(){
        if($("#srSubType2").val() == 590) {
           $("#qu").fadeIn('400'); 
        }else {
           $("#qu").val("");
           $("#qu").fadeOut('400'); 
        }
        if($("#srSubType2").val() == 592) {
           $("#ageBlock").fadeIn(400);
           $("#dealerBlock").fadeIn(400);
        }else {
            $("#age_agent").val(0);
            $("#dealer").val();
            $("#ageBlock").fadeOut(400);
            
        }
        
        if($("#srSubType2").val() == "681") {
            document.getElementById('vehicleId').required = false;
            document.getElementById('serviceCenterId').required = false;
            document.getElementById('serviceCenterIdDiv').style.display = "none";

        }
        else
        {
//            document.getElementById('vehicleId').required = true;
//            document.getElementById('serviceCenterId').required = true;
//            document.getElementById('serviceCenterIdDiv').style.display = "block";
              setRequiredFields();
//            
        }
        }
    )
    
    
</script>


@extends('layouts.left_nav')
@include('layouts.footer')