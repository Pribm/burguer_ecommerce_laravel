<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = ['id'];
    protected $fillable = [
        'main_text',
        'secondary_text',
        'price',
        'image'
    ];

    public function users()
    {
        $this->belongsToMany(User::class, 'cart', 'product_id', 'user_id');
    }
}
