<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Books extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'isbn',
        'value'
    ];

    public function stores()
    {
        return $this->belongsToMany(Stores::class, 'bookstore');
    }
}
