<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    protected $fillable = ['name'];

    protected $table = 'product_status';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
