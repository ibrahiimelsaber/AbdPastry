<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RequestHistory extends Model
{

    protected $table = 'requests_history';
    protected $guarded = ['Id'];
    public const CREATED_AT = 'Created';
    public const UPDATED_AT = 'Modified';


    public function contact()
    {
        return $this->belongsTo(Contact::class, 'ContactId','Id');
    }

    public function callDirection()
    {
        return $this->belongsTo(Picklist::class,'CallDirectionId','Id');
    }

    public function type()
    {
        return $this->belongsTo(Picklist::class,'TypeId','Id');
    }

    public function subType()
    {
        return $this->belongsTo(Picklist::class,'SubTypeId','Id');
    }

    public function subSubType()
    {
        return $this->belongsTo(Picklist::class,'SubSubTypeId','Id');
    }

    public function status()
    {
        return $this->belongsTo(Picklist::class,'StatusId','Id');
    }


    public function product()
    {
        return $this->belongsTo(Picklist::class,'ProductId','Id');
    }

    public function subProduct()
    {
        return $this->belongsTo(Picklist::class,'SubProductId','Id');
    }

    public function branch()
    {
        return $this->belongsTo(Picklist::class,'BranchId','Id');
    }

    public function complaintType()
    {
        return $this->belongsTo(Picklist::class,'ComplaintTypeId','Id');
    }


}
