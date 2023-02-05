<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class userLogin extends Model {
    protected $table = 'users';
    public $timestamps = false;
    protected $primaryKey = "Id";
        protected $guarded = ['Id'];

}
