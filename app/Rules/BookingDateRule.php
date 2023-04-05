<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\InvokableRule;

class BookingDateRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ($value < Carbon::now()->toDateString()) {
            $fail('Tidak dapat membooking pada tanggal tersebut');
        }
    }
}
