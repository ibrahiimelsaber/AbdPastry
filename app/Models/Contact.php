<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{


    protected $table = 'contacts';
    protected $primaryKey = "Id";
    protected $guarded = ['Id'];
    public const CREATED_AT = 'CreatedOn';
    public const UPDATED_AT = 'ModifiedOn';


    public function account()
    {
        return $this->belongsTo(Account::class, 'AccountId');
    }
    public function gender()
    {
        return $this->belongsTo(Picklist::class,'GenderId','Id');
    }

    public function phoneType()
    {
        return $this->belongsTo(Picklist::class,'PhoneTypeId','Id');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

}
