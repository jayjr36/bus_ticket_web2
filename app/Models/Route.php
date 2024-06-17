<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'bus_id', 'fare'
    ];

    // Relationship to Bus
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // Relationship to Tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
