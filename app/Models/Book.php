<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'price', 'published_year',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
