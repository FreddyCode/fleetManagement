<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarOwnerDetail extends Model
{
    protected $table = 'ownercardetails';
    protected $fillable = [
        'code','owner_id','model_id','car_number','car_color','car_image','start_detail'
    ];
    protected $primaryKey = 'detail_id';
    public $timestamps = true;

}
