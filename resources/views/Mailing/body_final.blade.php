<style>*{font-family: tahoma;} table{margin: 0 auto;} td{padding: 8px;} h3{padding: 10px;} p{color: #666}</style>
<h3 style='font-family: tahoma;'>Dears,</h3><p>Complaint {{$SR->account_relation ? $SR->account_relation->fullName : ""}} </p>
<table width="60%">
<tr style="background-color: #2F9ABE;color: white; text-align: left;">
    <th colspan="2" style="padding:8px;">Account Name {{ $SR->account_relation ? $SR->account_relation->fullName : "" }}</th>
</tr>
<tr style="background-color: #2F9ABE;color: white; text-align: left;">
    <th colspan="2" style="padding:8px;">Account Phone :
        @if ( $SR->account_relation )
            @foreach ($SR->account_relation->phones_relation as $phone)
                {{ $phone->phoneValue }} @if($loop->iteration != count($SR->account_relation->phones_relation)) - @endif
            @endforeach   
        @endif
    </th>
</tr>
<tr>
    <td style="padding:8px;">customer comment</td>
    <td style="padding:8px;">{{ $SR->customer_comment }}</td>
</tr>
<tr style="background-color: #f2f2f2">
    <td style="padding:8px;">agent comments</td>
    <td style="padding:8px;">{{ $SR->agent_comments }}</td>
</tr>
<tr style="background-color: #f2f2f2">
    <td style="padding:8px;">Model Year</td>
    <td style="padding:8px;">{{ $SR->model_year_relation ? $SR->model_year_relation->Name : "" }}</td>
</tr>
<tr style="background-color: #f2f2f2">
    <td style="padding:8px;"> Model</td>
    <td style="padding:8px;">{{ $SR->model_name_relation ? $SR->model_name_relation->Name : "" }}</td>
</tr>
<tr style="background-color: #f2f2f2">
    <td style="padding:8px;">Car Range</td>
    <td style="padding:8px;">{{ $SR->car_range_relation ? $SR->car_range_relation->Name : "" }}</td>
</tr>
<tr style="background-color: #f2f2f2">
    <td style="padding:8px;"> Chassis Number</td>
    <td style="padding:8px;">{{ $SR->chassis_number }}</td>
</tr>
<tr style="background-color: #f2f2f2">
    <td style="padding:8px;">Compilant Source</td>
    <td style="padding:8px;">{{ $SR->call_resource_relation ? $SR->call_resource_relation->Name : "" }}</td>
</tr>
</table>