<?php

namespace App\Nova;

use App\Nova\Actions\ChangeStatusEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;

class Event extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Event>
     */
    public static $model = \App\Models\Event::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    public static function label()
    {
        return "Event / Tournament";
    }

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

            Text::make('Name Event/Tournament', 'name')
                ->rules('required', 'max:255'),

            Textarea::make('Description', 'description'),

            Image::make('Photo', 'image')->disk('public')->path('event'),

            Date::make('Start Date', 'start_date')->displayUsing(function($date){
                return $date->format('d/m/Y');
            }),

            Date::make('End Date', 'end_date')->displayUsing(function($date){
                return $date->format('d/m/Y');
            }),

            Select::make('Status')
                ->options([
                    'active' => 'active',
                    'inactive' => 'inactive',
                ])
                ->rules('required')
                ->onlyOnForms(),

            Badge::make('Status')->map([
                    'active' => 'success',
                    'inactive' => 'danger',
                ]),
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
        return [
            ChangeStatusEvent::make()->showInline(),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->when(empty($request->get('orderBy')), function(Builder $q) {
            $q->getQuery()->orders = [];

            return $q->orderBy('status', 'asc')->orderBy('start_date');
        });
    }
}
