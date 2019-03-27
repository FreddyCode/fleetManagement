<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'month','year','payment_date','reg_amount',
        'fuel_amount','repairs_amount','description',
        'owner_id','user_id','total_expense','total_amount'
    ];
    protected $primaryKey = 'payment_id';
    public $timestamps = true;
}
