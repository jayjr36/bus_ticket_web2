<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relationship to Routes
    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    // Relationship to Tickets through Routes
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, Route::class);
    }
}
