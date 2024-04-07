<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Stores extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'address',
        'active',
    ];

    public function books()
    {
        return $this->belongsToMany(Books::class, 'bookstore');
    }
}
