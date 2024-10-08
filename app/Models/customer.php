<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi satu ke banyak dengan Invoice
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
