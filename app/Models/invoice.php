<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_code',
        'code',
        'name',
        'price',
        'size',
        'color',
        'customer_id',
    ];

    // Relasi banyak ke satu dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
