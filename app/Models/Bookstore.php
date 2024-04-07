<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Bookstore extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'bookstore';

    protected $fillable = [
        'store_id',
        'book_id'
    ];

    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }
}
