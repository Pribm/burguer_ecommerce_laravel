<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $table = 'phones';

    protected $fillable = [
        'user_id',
        'phone_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
