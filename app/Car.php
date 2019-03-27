<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = [
        'car_name'
    ];
    protected $primaryKey = 'car_id';
    public $timestamps = true;
}
