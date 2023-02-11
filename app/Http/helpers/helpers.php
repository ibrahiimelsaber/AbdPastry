<?php


use App\Models\Request as SR;
use Illuminate\Support\Facades\DB;

const senderId = "22";



function EmailAfterInsert($SRId)
{

    $bodyData = getSRDetails($SRId);


    if ($bodyData) {
        $body = createMailBody($bodyData, 'create');

        sendMail($body);
    }
}

function EmailAfterUpdate($SRId)
{

    $bodyData = getSRDetails($SRId);


    if ($bodyData) {
        $body = createMailBody($bodyData, 'update');

        sendMail($body);
    }
}


function getSRDetails($id)
{


    $srInfo = SR::with('contact', 'callDirection', 'type', 'subType', 'subSubType', 'status', 'product', 'subProduct', 'branch', 'complaintType')->where('Id', '=', $id)->first();


    return ['srData' => $srInfo];
//    dd($srInfo);
}


function createMailBody($data, $operation)
{
    $mailInfo = "";
    if ($operation == 'create') {
        $mailInfo .= "Complaint From Customer: ";
    }
    if ($operation == 'update') {
        $mailInfo .= "Update On Complaint From Customer: ";
    }


    foreach ($data as $r) {
        $row = $r;
    }
//    dd($row);
    $body = view('Mailing.insert')->with(['row' => $row, 'mailInfo' => $mailInfo]);
    return ['body' => $body];

}

function sendMail($body)
{
    $to = "ibrahim_melsaber@rayacx.com";
    $cc = "ibrahimelsaber8@gmail.com";
//    $cc = "mohamed_alatif@rayacx.com;nesma_mgad@rayacx.com";
    $subject = "El-Abd Foods Say Hi";

    $to = str_replace(",", ";", $to);
    $cc = str_replace(",", ";", $cc);
    $subject = str_replace("'", "''", $subject);

    $body = str_replace("'", "''", $body['body']);
    $createdBy = session('userName');

//    dd($body);
    try {

        $server = "Dtdb\wfmsql";
        $db_user = "Email";
        $db_pass = "Email@123";
        $db = "RCCEmail_Service";

        $_connection = sqlsrv_connect($server, array("Database" => $db, "UID" => $db_user, "PWD" => $db_pass, "CharacterSet" => "UTF-8"))
        or die("Couldn't connect to SQL Server on $server");

        $Sql = "insert into Messages (SenderId,Email_To,Email_CC,Email_Subject,Email_Body,Status,CreatedBy) values ('" . senderId . "','" . $to . "','" . $cc . "',N'" . $subject . "',N'" . $body . "',0,N'" . $createdBy . "')";
        $result = sqlsrv_query($_connection, $Sql) or die(sqlsrv_errors());

        if (!$result) {
            $errors = str_replace("'", "''", sqlsrv_errors());

            $Sql = "exec SP_InsertError @ErrorMsg=N'$errors',@ErrorTrace='senderId.PHP CRM',@Username=N'$createdBy' ";

            sqlsrv_query($_connection, $Sql);
            return false;
        }

        return true;

    } catch (\Throwable $th) {
        throw $th;
    }
}

