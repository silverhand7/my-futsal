<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'hourly_rate',
        'note'
    ];

    protected $appends = [
        'event_unconfirmed_color', 'event_confirmed_color',
    ];

    public function getEventUnconfirmedColorAttribute()
    {
        $color = 'RGBA(39,97,206,0.46)';
        if ($this->id == 2) {
            $color ='RGBA(55,128,6,0.55)';
        }
        if ($this->id == 3) {
            $color = 'RGBA(255,165,0,0.51)';
        }
        if ($this->id == 4) {
            $color = 'rgba(84, 84, 84, 0.8)';
        }
        return $color;
    }

    public function getEventConfirmedColorAttribute()
    {
        $color = '#2761CE';
        if ($this->id == 2) {
            $color = '#378006';
        }
        if ($this->id == 3) {
            $color = '#FFA500';
        }
        if ($this->id == 4) {
            $color = 'rgba(84, 84, 84, 0.8)';
        }
        return $color;
    }
}
