<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'product_id',
        'sold_at',
        'qty',
        'user_id',
    ];

    protected $casts = [
        'sold_at' => 'dateTime'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            $sale->user_id = auth()->user()->id ?? 1;
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDefaultSalesNumber()
    {
        return $this->prefixNumber($this->get()->count() + 1);
    }

    public function prefixNumber($number)
    {
        return sprintf('%04s', $number);
    }
}
