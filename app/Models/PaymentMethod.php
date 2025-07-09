<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'description',
        'account_number',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}