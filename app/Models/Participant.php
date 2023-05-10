<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participant')
            ->withPivot('registration_date')
            ->withTimestamps();
    }
}
