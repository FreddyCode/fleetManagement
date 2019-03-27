<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarOwner extends Model
{
    protected $table = 'carowners';
    protected $fillable = [
        'code','first_name','last_name','last_name','email','image','address','telephone',
        'bank','account_number','branch'
    ];
    protected $primaryKey = 'owner_id';
    public $timestamps = true;
}
