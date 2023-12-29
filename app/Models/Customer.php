<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    # Each customer can have many instances of nvoices
    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}