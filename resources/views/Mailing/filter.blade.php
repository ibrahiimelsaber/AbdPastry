<div style="float:right;">
    {{ Form::open(array('url' => 'mailing', 'class'=>'form navbar-form navbar-right searchform','method'=>'get')) }}
    {{ Form::select('filter_status', $SRStatusList->pluck('Name','Name')->prepend('Select status','') ,(isset($_GET['filter_status']))?$_GET['filter_status']:null, array('class' => 'form-control')) }}
    {{ Form::select('filter_srType', $SRTypeList->pluck('Name','Id')->prepend('Select type','') ,(isset($_GET['filter_srType']))?$_GET['filter_srType']:null, array('class' => 'form-control','onchange'=>'getsrSubType()' , 'id'=>'srType')) }}
    {{ Form::hidden('filter_srTypeTxt' ,(isset($_GET['filter_srType']))?$SRTypeList->where('Id',$_GET['filter_srType']):null, array('class' => 'form-control', 'id'=>'filter_srTypeTxt')) }}
    {{ Form::select('filter_srSubType', array(''=>'Select sub type') ,(isset($_GET['filter_srSubType']))?$_GET['filter_srSubType']:null, array('class' => 'form-control','onchange'=>'getSrSubtype2(); getBranch();' , 'id'=>'srSubType')) }}
    {{ Form::hidden('filter_srSubTypeTxt', null, array('class' => 'form-control' , 'id'=>'filter_srSubTypeTxt')) }}
    {{ Form::select('filter_srSubType2', array(''=>'Select sub type2') ,(isset($_GET['filter_srSubType2']))?$_GET['filter_srSubType2']:null, array('class' => 'form-control', 'id'=>'srSubType2','onchange'=>'Subtype2OnChange();')) }}
    {{ Form::hidden('filter_srSubType2Txt', null, array('class' => 'form-control' , 'id'=>'filter_srSubType2Txt')) }}
    {{ Form::select('filter_sc', array(''=>'Select branch') ,(isset($_GET['filter_sc']))?$_GET['filter_sc']:null, array('class' => 'form-control', 'id'=>'sc','onchange'=>'branchOnChange()')) }}
    {{ Form::hidden('filter_scTxt', null, array('class' => 'form-control' , 'id'=>'filter_scTxt')) }}
    {{ Form::select('filter_brandId', $brandsList->pluck('Name','Id')->prepend('Select brand','') ,(isset($_GET['filter_brandId']))?$_GET['filter_brandId']:null, array('class' => 'form-control', 'id'=>'filter_brandId','onchange'=>'brandOnChange()')) }}
    {{ Form::hidden('filter_brandIdTxt', null, array('class' => 'form-control' , 'id'=>'filter_brandIdTxt')) }}
    {{ Form::submit('Filter',array('class'=>'btn btn-default')) }}
    {{ Form::close() }}
</div>

<script>

if('{{isset($_GET['filter_srType'])}}' == '1')
{   

getsrSubType();
getBranch();

}
    //getSrSubtype2();

    
    function getSrSubtype2()
    {
        if($("#srSubType").val() == '')
            $("#filter_srSubTypeTxt").val("");
        else
            $("#filter_srSubTypeTxt").val($("#srSubType :selected").text());

        var formData = {
          srSubType: $("#srSubType").val()
        };

        $.ajax({
            type: 'get',
            url: "{{URL::to('requests/')}}" + '/subType2',
            data: formData,
            dataType: 'json',
            beforeSend: function ()
            {
                //document.getElementById('loader').className = 'loader';
                document.getElementById('srSubType').disabled = "disabled";
                $('.form-group').css('opacity', '0.2');

            },
            success: function (data) {

                var parentSelect = document.getElementById('srSubType2');
                var srSubType2List = data['srSubType2List'];
                parentSelect.length = 0;
                var field;
                var option = document.createElement("option");
                option.text = "Select subtype 2";
                option.value = "";
                parentSelect.add(option);
                for (i = 0; i < srSubType2List.length; i++)
                {
                    field = srSubType2List[i];
                    var option = document.createElement("option");
                    option.text = field['Name'];
                    option.value = field['Id'];
                    parentSelect.add(option);
                   if(field['Id'] == '{{(isset($_GET['filter_srSubType2']))? $_GET['filter_srSubType2'] :""}}')
                        option.selected = true;
                }
                //document.getElementById('loader').className = '';
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
    
    
     function getsrSubType() {
         if($("#srType").val() == '')
            $("#filter_srTypeTxt").val("");
        else
             $("#filter_srTypeTxt").val($("#srType :selected").text());
         
        var formData = {
            srType: $("#srType").val()
        };


        $.ajax({
            type: 'get',
            url: "{{URL::to('requests/')}}" + '/subType',
            data: formData,
            dataType: 'json',
            beforeSend: function ()
            {
                //document.getElementById('loader').className = 'loader';
                document.getElementById('srSubType').disabled = "disabled";
                $('.form-group').css('opacity', '0.2');

            },
            success: function (data) {

                var parentSelect = document.getElementById('srSubType');
                var srSubTypeList = data['srSubTypeList'];
                parentSelect.length = 0;
                var field;

                var option = document.createElement("option");
                option.text = "select sub type";
                option.value = "";
                parentSelect.add(option);

                for (i = 0; i < srSubTypeList.length; i++)
                {
                    field = srSubTypeList[i];
                    var option = document.createElement("option");
                    option.text = field['Name'];
                    option.value = field['Id'];
                    parentSelect.add(option);
                     if(field['Id'] == '{{(isset($_GET['filter_srSubType']))? $_GET['filter_srSubType'] :""}}')
                        option.selected = true;
                }
                //document.getElementById('loader').className = '';
                document.getElementById('srSubType').disabled = false;
                $('.form-group').css('opacity', '1');
                
                getSrSubtype2();
                //getBranch();
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
    
     function getBranch()
    {
        var formData = {
            srSubType: $("#srSubType").val()
        };

        
        //if($("#srSubType").val() == '120' || $("#srSubType").val() == '122')
        //{
        //        var parentSelect = document.getElementById('sc');
        //        parentSelect.length = 0;
        //        var option = document.createElement("option");
        //        option.text = "Select branch";
        //        option.value = "";
        //        parentSelect.add(option);
        //        branchOnChange();
        //        return;
        //}
        
        $.ajax({
            type: 'get',
            url: "{{URL::to('requests/')}}" + '/getBranchs',
	data: formData ,

            dataType: 'json',
            beforeSend: function ()
            {
                //document.getElementById('loader').className = 'loader';
                document.getElementById('srSubType').disabled = "disabled";
                $('.form-group').css('opacity', '0.2');

            },
            success: function (data) {

                var parentSelect = document.getElementById('sc');
                var scList = data['scList'];
                parentSelect.length = 0;
                var field;
                var option = document.createElement("option");
                option.text = "Select branch";
                option.value = "";
                parentSelect.add(option);
                for (i = 0; i < scList.length; i++)
                {
                    field = scList[i];
                    var option = document.createElement("option");
                    option.text = field['Name'];
                    option.value = field['Id'];
                    parentSelect.add(option);
                   if(field['Id'] == '{{(isset($_GET['filter_sc']))? $_GET['filter_sc'] :""}}')
                        option.selected = true;
                }
                //document.getElementById('loader').className = '';
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
    
function Subtype2OnChange()
    {
         if($("#srSubType2").val() == '')
            $("#filter_srSubType2Txt").val("");
        else
            $("#filter_srSubType2Txt").val($("#srSubType2 :selected").text());
    }
function branchOnChange()
    {
        
         if($("#sc").val() == '')
            $("#filter_scTxt").val("");
        else
            $("#filter_scTxt").val($("#sc :selected").text());
    }
function brandOnChange()
    {
         if($("#filter_brandId").val() == '')
            $("#filter_brandIdTxt").val("");
        else
            $("#filter_brandIdTxt").val($("#filter_brandId :selected").text());
    }
</script>