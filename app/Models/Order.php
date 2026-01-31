<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    
    // Ini yang paling penting agar format() tidak error
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}