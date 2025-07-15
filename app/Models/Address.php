<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'order_address';
    protected $fillable = [
        'order_id', 'full_name', 'phone', 'city', 'street', 'house', 'apartment', 'comments'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
