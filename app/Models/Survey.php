<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Survey extends Model

{
    protected $table = 'Norm_survey';
    protected $guarded = ['Id'];


    public function account()
    {
        return $this->belongsTo(Account::class, 'AccountId');
    }

    public function callStatus()
    {
        return $this->belongsTo(Picklist::class,'normCallStatusId','Id');
    }
}
