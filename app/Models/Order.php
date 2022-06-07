<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order', 'order_id', 'product_id')->withPivot(['quantity']);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
