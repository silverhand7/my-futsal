<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function get($date = null)
    {
        if ($date == "null") {
            $date = date('Y-m-d');
        }
        // dd($date);
        $data = Field::with(['bookings' => function ($query) use ($date){
            $query->where('date', '=', $date)
            ->whereNotIn('status', ['rejected', 'canceled']);
        }])
        ->get();

        return $data;
    }
}
