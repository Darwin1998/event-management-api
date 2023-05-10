<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'status',
    ];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant')
            ->withPivot('registration_date')
            ->withTimestamps();
    }
}
