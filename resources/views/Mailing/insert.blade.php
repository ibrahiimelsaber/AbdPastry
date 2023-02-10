<html>
<head>
    <style>* {
            font-family: tahoma;
        }

        table {
            margin: 0 auto;
        }

        td {
            padding: 8px;
        }

        h3 {
            padding: 8px;
        }

        p {
            color: #666
        }</style>
</head>
<h4 style='font-family: tahoma;'>Dears,</h4>
<p>{{$mailInfo ?? ''}}<strong>{{$row->contact->Name ?? ''}}</strong></p>
<body>
<table width='80%'>
    <tr style='background-color: #2F9ABE;color: white; text-align: left;'>
        <th colspan='2' style='padding:8px;'> Account Name: <span class="bg-dark"> {{$row->contact->Name ?? ''}}</span></th>
    </tr>
    <tr style='background-color: #2F9ABE;color: white; text-align: left;'>
        <th colspan='2' style='padding:8px;'>Contact Name MR/MS:<span class="bg-dark">
                {{$row->contact->Name ?? ''}}</span>
        </th>
    </tr>

    <tr style='background-color: #2F9ABE;color: white; text-align: left;'>
        <th colspan='2' style='padding:8px;'>Account Phone Type:<span class="bg-dark">
                {{$row->contact->phoneType->Name ?? ''}}</span>
        </th>
    </tr>
    <tr style='background-color: #2F9ABE;color: white; text-align: left;'>
        <th colspan='2' style='padding:8px;'>Account Phone:<span class="bg-dark">
                {{$row->contact->PhoneNumber ?? ''}}</span>
        </th>
    </tr>

    <tr>
        <td style='padding:8px;'>Customer Comment</td>
        <td style='padding:8px;'>{{$row->CustomerComments ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Agent Comments:</td>
        <td style='padding:8px;'>{{$row->AgentComments ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>SR Number:</td>
        <td style='padding:8px;'>{{$row->Id ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>SR Type:</td>
        <td style='padding:8px;'>{{$row->type->Name ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>SR Sub Type:</td>
        <td style='padding:8px;'>{{$row->subType->Name ?? ''}}</td>
    </tr>

    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>SR Status:</td>
        <td style='padding:8px;'>{{$row->status->Name ?? ''}}</td>
    </tr>

    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Call Direction:</td>
        <td style='padding:8px;'>{{$row->callDirection->Name ?? ''}}</td>
    </tr>

    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Complaints Type:</td>
        <td style='padding:8px;'>{{$row->complaintType->Name ?? ''}}</td>
    </tr>

    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Product:</td>
        <td style='padding:8px;'>{{$row->product->Name ?? ''}}</td>
    </tr>

    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Sub Product:</td>
        <td style='padding:8px;'>{{$row->subProduct->Name ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Account Address:</td>
        <td style='padding:8px;'>{{$row->contact->account->Address ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Account City:</td>
        <td style='padding:8px;'>{{$row->contact->account->city->Name ?? ''}}</td>
    </tr>

    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Account Area:</td>
        <td style='padding:8px;'>{{$row->contact->account->area->Name ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>AlAbd Branch:</td>
        <td style='padding:8px;'>{{$row->branch->Name ?? ''}}</td>
    </tr>


    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Created By:</td>
        <td style='padding:8px;'>{{$row->CreatedBy ?? ''}}</td>
    </tr>

    <tr style='background-color: #f2f2f2'>
        <td style='padding:8px;'>Created On:</td>
        <td style='padding:8px;'>{{$row->Created ?? ''}}</td>
    </tr>
</table>
<p>Thanks,</p>
<p>Alabd Pastry</p>
</body>
</html>
