<?php

namespace App\Nova;

use App\Models\Field;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;

class FieldLog extends Resource
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
            // ID::make()->sortable(),
            Date::make('Date', 'date')
                ->displayUsing(function($date){
                    return $date->format('d/m/Y');
                })
                ->rules(['required']),

            Text::make('Start Hour', 'starting_hour')
                ->withMeta(['type' => 'time'])
                ->rules(['required'])
                ->default(function ($request) {
                    return '08:00';
                }),
            Number::make('Duration', 'duration')
                ->rules(['required'])
                ->withMeta(['placeholder' => 'Durasi (jam)'])
                ->onlyOnForms()
                ->help('Jam'),
            Text::make('End Hour', 'ending_hour')
                ->dependsOn(['duration', 'starting_hour', 'date'],
                function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->duration !== null) {
                        $field->value = Carbon::parse($formData->starting_hour)->addHour($formData->duration)->format('H:i');
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
                ->dependsOn(['duration', 'starting_hour', 'date'],
                function (Text $field, NovaRequest $request, FormData $formData) {
                    $date = Carbon::parse($formData->date)->format('Y-m-d');
                    if ($formData->duration !== null) {
                        $field->value = Carbon::parse($date . ' ' . $formData->starting_hour)->addHour($formData->duration)->timestamp;
                    }
                }),
            Hidden::make('field_id')->default(function(){
                return Field::where('name', 'Lapangan Tidak Tersedia')->first()->id;
            }),
            Hidden::make('status')->default('booked'),
            Text::make('Note', 'note'),
        ];
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->selectRaw('bookings.*, fields.name')->join('fields', 'fields.id', '=', 'bookings.field_id')->where('name', '=', 'Lapangan Tidak Tersedia');
    }

}
