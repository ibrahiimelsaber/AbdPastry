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
                <h3 class="box-title">Edit Mailing item </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="glyphicon glyphicon-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
             {{Form::model($item,array('url'=>'mailing/'.$item->Id, 'method'=>"Put","onsubmit"=>"javascript:if(!all_valid){alert('validate fields'); return false; }"))}}
            <div class="box-body">
                <div class="row">

                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Type <font color="red">*</font></label>
                        {{Form::text("type" ,null, array('id' => 'srTypeTxt' ,'class'=>"form-control",'readonly'=>'readonly'))}}

                    </div>
                </div>
                    
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Type  <font color="red">*</font></label>

                        {{Form::text("subType" ,null, array('id' => 'srSubTypeTxt','class'=>"form-control",'readonly'=>'readonly' ))}}
                    </div>
                </div>
                
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Type 2 <font color="red">*</font></label>
                        {{Form::text("subType2" ,null, array('id' => 'srSubType2Txt','class'=>"form-control",'readonly'=>'readonly' ))}}

                    </div>
                </div>
                
                    <div class="col-md-4">

                    <div class="form-group">
                        <label>Status <font color="red"></font></label>
                        {{Form::text("status" ,null, array('id' => 'statusId','class'=>"form-control",'readonly'=>'readonly' ))}}

                    </div>

                </div>
                    
                    <div class="col-md-4">

                    <div class="form-group">
                        <label>Brand <font color="red"></font></label>
                        {{Form::text("brand" ,null, array('id' => 'brandId','class'=>"form-control",'readonly'=>'readonly' ))}}

                    </div>

                </div>
                    
                    <div class="col-md-4" id='serviceCenterIdDiv'>

                    <div class="form-group">
                        <label>Service Center <font color="red"></font></label>
                        {{Form::text("branch" ,null, array('id' => 'branchId','class'=>"form-control",'readonly'=>'readonly' ))}}


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
    
    
    


@extends('layouts.left_nav')
@include('layouts.footer')