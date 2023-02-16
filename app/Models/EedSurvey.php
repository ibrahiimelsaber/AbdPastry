<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class EedSurvey extends Model

{
    protected $table = 'Eedsurvey';
    protected $guarded = ['Id'];


    public function account()
    {
        return $this->belongsTo(Account::class, 'AccountId');
    }

    public function callStatus()
    {
        return $this->belongsTo(Picklist::class,'EidCallStatusId','Id');
    }
}
