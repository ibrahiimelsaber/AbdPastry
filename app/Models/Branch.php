<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Branch extends Authenticatable
{

    protected $table = 'branch_users';
    protected $guarded = ['Id'];


    public function branch()
    {
        return $this->belongsTo(Picklist::class,'BranchId','Id');
    }


}
