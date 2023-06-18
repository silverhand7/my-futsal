<?php

namespace App\Nova\Lenses;

use App\Nova\Metrics\SaleRevenue;
use App\Nova\Metrics\TotalSales;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class SalesLedger extends Lens
{
    public $name = 'Sale Ledger';
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
            $query->select(['sales.*', 'products.name as product_name', 'products.price as product_price', DB::raw('products.price * qty as total')])
            ->orderBy('sold_at', 'desc')
            ->join('products', 'products.id', '=', 'sales.product_id')
        ));
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
            Date::make('Date', 'sold_at')
                ->displayUsing(function($date){
                    return $date->format('d/m/Y');
                }),
            Text::make('Product', 'product_name'),
            Currency::make('Price', 'product_price'),
            Number::make('Qty'),
            Currency::make('Total')
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
            (new TotalSales)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
            (new SaleRevenue)->canSee(function($request) {
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
        return 'sales-ledger';
    }
}
