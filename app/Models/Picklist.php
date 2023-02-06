<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Picklist extends Model
{

    protected $table = 'picklists';
    public $timestamps = false;

//
//    public function contacts()
//    {
//        return $this->hasMany(Contact::class);
//    }//

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function requestsHistory()
    {
        return $this->hasMany(RequestHistory::class);
    }

    public function accounts()
    {
        return $this->hasMany(Request::class);
    }
}
