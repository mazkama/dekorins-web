<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Disesuaikan dengan kolom di database
    protected $fillable = ['name'];

    // Relasi ke Dekorin (jika ada)
    public function dekorins()
    {
        return $this->hasMany(Dekorin::class);
    }

 
}
