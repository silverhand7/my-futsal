<?php

namespace App\Nova\Lenses;

use App\Nova\Metrics\BookingRevenue;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class BookingLedger extends Lens
{
    public $name = 'Booking Revenue';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select(self::columns())
                ->join('fields', 'fields.id', 'bookings.field_id')
                ->where('status', 'booked')
                ->where('fields.id', '!=', 4)
                ->orderBy('bookings.date', 'desc')
        ));
    }

    protected static function columns()
    {
        return [
            'bookings.*',
            DB::raw('fields.hourly_rate * duration as revenue')
        ];
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Field'),
            Date::make('Date', 'date')
                ->displayUsing(function($date){
                    return $date->format('d/m/Y');
                }),
            Text::make('Duration', 'duration')->displayUsing(fn($duration) => $duration . ' Jam'),
            Currency::make('revenue')

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            (new BookingRevenue)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'booking-ledger';
    }
}
