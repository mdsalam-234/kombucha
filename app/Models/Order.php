<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false; 

    public function customer()
    {
        return $this->hasOne('App\Models\Customer','id','c_id');
    }
    public function orderitems()
    {
        return $this->hasMany('App\Models\Orderitem','o_id','id');
    }
}
