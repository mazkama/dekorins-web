<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'dekorin_id', 
        'user_id',
        'keterangan',
        'status',
        'biaya',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dekorin()
    {
        return $this->belongsTo(Dekorin::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
