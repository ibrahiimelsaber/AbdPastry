<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Account extends Model
{


    protected $table = 'accounts';
    protected $primaryKey = "Id";
    protected $guarded = ['Id'];
    protected $softDelete = false;


    public const CREATED_AT = 'CreatedOn';
    public const UPDATED_AT = 'ModifiedOn';

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'AccountId');
    }
    public function Type()
    {
        return $this->belongsTo(Picklist::class,'AccountTypeId','Id');
    }

    public function area()
    {
        return $this->belongsTo(Picklist::class,'AreaId','Id');
    }





}
