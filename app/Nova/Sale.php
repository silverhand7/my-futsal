<?php

namespace App\Nova;

use App\Nova\Lenses\SalesLedger;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Sale extends Resource
{
    public static function label()
    {
        return "Penjualan";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Sale>
     */
    public static $model = \App\Models\Sale::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'no';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'no',
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
            Text::make('Tgl', function(){
                    return $this->sold_at->format('d M Y H:i');
                })
                ->exceptOnForms(),
            Text::make('No')
                ->default(function(){
                    return (new $this::$model)->getDefaultSalesNumber();
                })
                ->rules('required'),
            BelongsTo::make('Product'),
            Number::make('Qty')
                ->rules('required')
                ->default(1),
            Text::make('Total', function(){
                return 'Rp ' . number_format($this->qty * $this->product->price);
            })
            ->exceptOnForms(),
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
        return [
            SalesLedger::make()->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
        ];
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
