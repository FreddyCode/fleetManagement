<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'models';
    protected $fillable = [
        'car_id',
        'model_name'

    ];
    protected $primaryKey = 'model_id';
    public $timestamps = true;
}
