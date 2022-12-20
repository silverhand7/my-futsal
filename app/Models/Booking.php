<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id',
        'date',
        'starting_hour',
        'starting_timestamp',
        'duration',
        'ending_hour',
        'ending_timestamp',
        'note',
        'proof_of_payment',
        'status', //'pending', 'paid', 'rejected', 'booked', 'canceled'
        'customer_id'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    protected $appends = [
        'date_iso', 'event_color',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getDateIsoAttribute()
    {
        return $this->date->toISOString();
    }

    public function getEventColorAttribute()
    {
        $color = $this->status === 'booked' ? '#2761CE' : 'RGBA(39,97,206,0.46)';
        if ($this->field_id == 2) {
            $color = $this->status === 'booked' ? '#378006' : 'RGBA(55,128,6,0.55)';
        }
        if ($this->field_id == 3) {
            $color =  $this->status === 'booked' ? '#FFA500' : 'RGBA(255,165,0,0.51)';
        }
        return $color;
    }

    public static function getBookedTime($fieldId, $date, $startingTime, $endingTime, $id = null)
    {
        return self::where(function($query) use ($startingTime, $endingTime){
            $query->whereRaw("'$startingTime' BETWEEN starting_timestamp and ending_timestamp");
            $query->orWhereRaw("'$endingTime' BETWEEN starting_timestamp and ending_timestamp");
        })
        ->where(function($query) use ($startingTime, $endingTime) {
            $query->where('ending_timestamp', '!=', $startingTime)
            ->where('starting_timestamp', '!=', $endingTime);
        })
        ->when($fieldId != 3, function($query) use($fieldId){
            $query->whereIn('field_id', [$fieldId, 3]);
        })
        ->where('date', $date)
        ->whereNotIn('status', ['rejected', 'canceled'])
        ->when(!empty($id), function ($query) use($id) {
            $query->where('id', '!=', $id);
        })
        ->get();
    }
}
