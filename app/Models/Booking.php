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
        'date_iso',
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

    public static function getBookedTime($date, $startingTime, $endingTime, $id = null)
    {
        return self::where(function($query) use ($startingTime, $endingTime){
            $query->whereRaw("'$startingTime' BETWEEN starting_timestamp and ending_timestamp");
            $query->orWhereRaw("'$endingTime' BETWEEN starting_timestamp and ending_timestamp");
        })
        ->where(function($query) use ($startingTime, $endingTime) {
            $query->where('starting_timestamp', '!=', $endingTime)
            ->orWhere('ending_timestamp', $startingTime);
        })
        ->where('date', $date)        
        ->whereNotIn('status', ['rejected', 'canceled'])
        ->when(!empty($id), function ($query) use($id) {
            $query->where('id', '!=', $id);
        })
        ->get();
    }
}
