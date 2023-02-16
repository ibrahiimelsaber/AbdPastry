<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Request extends Model
{

    protected $table = 'service_requests';
    protected $guarded = ['Id'];
    public const CREATED_AT = 'Created';
    public const UPDATED_AT = 'Modified';


    public function account()
    {
        return $this->belongsTo(Account::class, 'AccountId', 'Id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'ContactId', 'Id');
    }

    public function callDirection()
    {
        return $this->belongsTo(Picklist::class, 'CallDirectionId', 'Id');
    }

    public function type()
    {
        return $this->belongsTo(Picklist::class, 'TypeId', 'Id');
    }

    public function subType()
    {
        return $this->belongsTo(Picklist::class, 'SubTypeId', 'Id');
    }

    public function subSubType()
    {
        return $this->belongsTo(Picklist::class, 'SubSubTypeId', 'Id');
    }

    public function status()
    {
        return $this->belongsTo(Picklist::class, 'StatusId', 'Id');
    }


    public function product()
    {
        return $this->belongsTo(Picklist::class, 'ProductId', 'Id');
    }

    public function subProduct()
    {
        return $this->belongsTo(Picklist::class, 'SubProductId', 'Id');
    }

    public function branch()
    {
        return $this->belongsTo(Picklist::class, 'BranchId', 'Id');
    }

    public function complaintType()
    {
        return $this->belongsTo(Picklist::class, 'ComplaintTypeId', 'Id');
    }


    public function scopeSearch($query, $data)
    {
        if (isset($data['from']) && isset($data["to"]) && $data['from'] != "" && $data["to"] != "") {

            $query = $query->whereDate('Created', '>=', $data['from'])
                ->whereDate('Created', '<=', $data['to']);
        }

        if (isset($data['BranchId'])) {

            $query = $query->where('BranchId', $data['BranchId']);
        }


        if (isset($data['StatusId'])) {
            $query = $query->where('StatusId', $data['StatusId']);
        }

        if (isset($data['TypeId'])) {

            $query = $query->where('TypeId', $data['TypeId']);
        }

        return $query;
    }


}
