<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $fillable = [
        'first_name','last_name','telephone','email',
        'image','detail_id','insurance',
        'license','identity'
    ];
    protected $primaryKey = 'id';
    public $timestamps = true;
}
