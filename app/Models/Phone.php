<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Phone extends Model

{
    protected $table = 'account_phones';
    protected $guarded = ['Id'];


    public function account()
    {
        return $this->belongsTo(Account::class, 'AccountId');
    }

    public function phoneType()
    {
        return $this->belongsTo(Picklist::class,'TypeId','Id');
    }
}
