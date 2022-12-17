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
        'status',
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
}
