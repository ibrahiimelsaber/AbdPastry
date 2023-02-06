<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{

    protected $table = 'activities';
    protected $guarded = ['Id'];
    public const CREATED_AT = 'Created';
    public const UPDATED_AT = 'Modified';


    public function request()
    {
        return $this->belongsTo(Request::class, 'SRId','Id');
    }

    public function status()
    {
        return $this->belongsTo(Picklist::class,'CallStatusId','Id');
    }

    public function statusBack()
    {
        return $this->belongsTo(Picklist::class,'CallBackStatusId','Id');
    }

    public function type()
    {
        return $this->belongsTo(Picklist::class,'ActTypeId','Id');
    }

    public function subType()
    {
        return $this->belongsTo(Picklist::class,'ActSubTypeId','Id');
    }

    public function focalStatus()
    {
        return $this->belongsTo(Picklist::class,'FocalPointBranchStatusId','Id');
    }

    public function branch()
    {
        return $this->belongsTo(Picklist::class,'BranchId','Id');
    }



}
