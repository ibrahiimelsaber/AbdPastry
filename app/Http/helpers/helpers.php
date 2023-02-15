<?php


use App\Models\MailList;
use App\Models\Request as SR;
use Illuminate\Support\Facades\DB;

const senderId = "123456789";


function EmailAfterInsert($SRId)
{

    $typeId = '';
    $subTypeId = '';
    $branchId = '';
    $bodyData = getSRDetails($SRId);


    if ($bodyData) {
        foreach ($bodyData as $data) {
            $typeId = $data['TypeId'];
            $subTypeId = $data['SubTypeId'];
            $branchId = $data['BranchId'];
        }

        $body = createMailBody($bodyData, 'create');
        getMailVars($typeId, $subTypeId, $branchId, $body);

    }
}

function EmailAfterUpdate($SRId)
{
    $typeId = '';
    $subTypeId = '';
    $branchId = '';
    $bodyData = getSRDetails($SRId);


    if ($bodyData) {
        foreach ($bodyData as $data) {
            $typeId = $data['TypeId'];
            $subTypeId = $data['SubTypeId'];
            $branchId = $data['BranchId'];
        }

        $body = createMailBody($bodyData, 'update');
        getMailVars($typeId, $subTypeId, $branchId, $body);
    }
}

function getMailVars($typeId, $subTypeId, $branchId, $body)
{
    $branchesMailingList = MailList::where('branchCode', '=', 'branch')->pluck('branch_id')->toArray();
    if (isset($typeId) && isset($subTypeId) && isset($branchId)) {

        $hasMail = in_array($branchId, $branchesMailingList);
        // subject Product Quality
        if ($typeId == 848) {
            if ($subTypeId == 794) {
                if ($hasMail) {
                    $branchMailVars = MailList::where('TypeId', $typeId)->where('branch_id', '=', $branchId)->first();
                    if ($branchMailVars) {
                        sendMail($body, $branchMailVars);
                    }
                }
                else{
                    $mailVars = MailList::where('TypeId', $typeId)->where('branchCode', '=', 'Hubs')->first();
                    if ($mailVars) {
                        sendMail($body, $mailVars);
                    }
                }
                $defaultMailVars = MailList::where('TypeId', $typeId)->where('subTypeId', $subTypeId)->where('branchCode', '=', 'All')->first();
                if ($defaultMailVars) {
                    sendMail($body, $defaultMailVars);


                }

            }


            if ($subTypeId == 1823) {
                if ($hasMail) {
                    $branchMailVars = MailList::where('TypeId', $typeId)->where('branch_id', '=', $branchId)->first();
                    if ($branchMailVars) {
                        sendMail($body, $branchMailVars);
                    }
                } else{
                    $mailVars = MailList::where('TypeId', $typeId)->where('branchCode', '=', 'Hubs')->first();
                if ($mailVars) {
                    sendMail($body, $mailVars);
                }
            }
            $defaultMailVars = MailList::where('TypeId', $typeId)->where('subTypeId', $subTypeId)->where('branchCode', '=', 'All')->first();
            if ($defaultMailVars) {
                sendMail($body, $defaultMailVars);


            }

        }
        if ($subTypeId == 790) {
            if ($hasMail) {
                $branchMailVars = MailList::where('TypeId', $typeId)->where('branch_id', '=', $branchId)->first();
                if ($branchMailVars) {
                    sendMail($body, $branchMailVars);
                }
            }else {
                $mailVars = MailList::where('TypeId', $typeId)->where('branchCode', '=', 'Hubs')->first();
                if ($mailVars) {
                    sendMail($body, $mailVars);
                }
            }

            if ($branchId != 1824) {
                $defaultMailVars = MailList::where('TypeId', $typeId)->where('subTypeId', $subTypeId)->where('branchCode', '=', 'NoCallCenter')->first();
                if ($defaultMailVars) {
                    sendMail($body, $defaultMailVars);

                }
            }

        }
        if ($subTypeId == 1807) {
            if ($hasMail) {
                $branchMailVars = MailList::where('TypeId', $typeId)->where('branch_id', '=', $branchId)->first();
                if ($branchMailVars) {
                    sendMail($body, $branchMailVars);
                }
            } else {

                $mailVars = MailList::where('TypeId', $typeId)->where('branchCode', '=', 'Hubs')->first();
                if ($mailVars) {
                    sendMail($body, $mailVars);
                }
            }

//                dd('hello');
            $defaultMailVars = MailList::where('TypeId', $typeId)->where('subTypeId', $subTypeId)->where('branchCode', '=', 'All')->first();
            if ($defaultMailVars) {
                sendMail($body, $defaultMailVars);

            }
        }
        if ($subTypeId == 792) {
            if ($hasMail) {
                $branchMailVars = MailList::where('TypeId', $typeId)->where('branch_id', '=', $branchId)->first();
                if ($branchMailVars) {
                    sendMail($body, $branchMailVars);
                }
            }
            else{
                $mailVars = MailList::where('TypeId', $typeId)->where('branchCode', '=', 'Hubs')->first();
                if ($mailVars) {
                    sendMail($body, $mailVars);
                }
            }
            $defaultMailVars = MailList::where('TypeId', $typeId)->where('subTypeId', $subTypeId)->where('branchCode', '=', 'All')->first();
            if ($defaultMailVars) {
                sendMail($body, $defaultMailVars);
            }
        }

        if ($subTypeId != 794 && $subTypeId != 1823 && $subTypeId != 790 && $subTypeId != 1807 && $subTypeId != 792) {
            if ($hasMail) {
                $branchMailVars = MailList::where('TypeId', $typeId)->where('branch_id', '=', $branchId)->first();
                if ($branchMailVars) {
                    sendMail($body, $branchMailVars);
                }
            } else {
                $mailVars = MailList::where('TypeId', $typeId)->where('branchCode', '=', 'Hubs')->first();
                if ($mailVars) {
                    sendMail($body, $mailVars);
                }
            }
        }

    }
}

return true;
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

function sendMail($body, $mailVars)
{

    $to = $mailVars->mailTo;
    $cc = $mailVars->mailCC;
    $subject = $mailVars->subject;


    $to = str_replace(",", ";", $to);
    $cc = str_replace(",", ";", $cc);
    $subject = str_replace("'", "''", $subject);


    $body = str_replace("'", "''", $body['body']);
    $createdBy = session('userName');
//    dd($to, $cc, $subject,$body);


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

