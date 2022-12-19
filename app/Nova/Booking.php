<?php

namespace App\Nova;

use App\Http\Requests\BookingRequest;
use App\Models\Booking as ModelsBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Silverhand7\InputGroup\InputGroup;

class Booking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Booking>
     */
    public static $model = \App\Models\Booking::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Customer'),
            BelongsTo::make('Field'),
            Date::make('Tanggal', 'date')
                ->displayUsing(function($date){
                    return $date->format('d/m/Y');
                })
                ->rules(['required']),
            Text::make('Jam Mulai', 'starting_hour')
                ->withMeta(['type' => 'time'])
                ->rules(['required'])
                ->default(function ($request) {
                    return Carbon::now()->addHour(1)->startOfHour()->format('H:i');
                }),

            Number::make('Durasi', 'duration')
                ->rules(['required'])
                ->withMeta(['placeholder' => 'Durasi (jam)'])
                ->onlyOnForms()
                ->help('Jam'),

            Text::make('Jam Selesai', 'ending_hour')
                ->dependsOn(['duration', 'starting_hour'],
                function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->duration !== null) {
                        $field->value = Carbon::createFromFormat('H:i', $formData->starting_hour)->addHour($formData->duration)->format('H:i');
                    }
                })
                ->rules(['required'])
                ->withMeta(['readonly' => true]),

            Hidden::make('starting_timestamp')
                ->dependsOn(['date', 'starting_hour'],
                function (Hidden $field, NovaRequest $request, FormData $formData) {
                    $field->value = Carbon::parse(Str::before($formData->date, 'T') . ' ' . $formData->starting_hour)->timestamp;
                }),
            Hidden::make('ending_timestamp')
                ->dependsOn(['date', 'ending_hour'],
                function (Hidden $field, NovaRequest $request, FormData $formData) {
                    $field->value = Carbon::parse(Str::before($formData->date, 'T') . ' ' . $formData->ending_hour)->timestamp;
                }),

            Image::make('Bukti Pembayaran', 'proof_of_payment')->disk('public'),
            Select::make('Status')
                ->options([
                    'pending' => 'pending',
                    'paid' => 'paid',
                    'rejected' => 'rejected',
                    'booked' => 'booked',
                    'canceled' => 'canceled',
                ])
                ->default('admin')
                ->rules('required'),
        ];
    }

    protected static function afterValidation(NovaRequest $request, $validator)
    {
        $startingTimestamp = $request->starting_timestamp;
        $endingTimestamp = $request->ending_timestamp;
        $date = $request->date;
        $field = $request->field;

        $bookings = ModelsBooking::getBookedTime($field, $date, $startingTimestamp, $endingTimestamp, $request->resourceId);

        if ($bookings->count() >= 2) {
            self::showBookingCollisonError($validator);
        }
    }

    private static function showBookingCollisonError($validator)
    {
        $validator->errors()->add('date', 'Tanggal dan jam tersebut sudah terbooking!');
        $validator->errors()->add('starting_hour', 'Tanggal dan jam tersebut sudah terbooking!');
        $validator->errors()->add('ending_hour', 'Tanggal dan jam tersebut sudah terbooking!');
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
