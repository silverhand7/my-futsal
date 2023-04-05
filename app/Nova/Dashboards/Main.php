<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewCustomers;
use App\Nova\Metrics\BookingRevenue;
use App\Nova\Metrics\SaleRevenue;
use App\Nova\Metrics\TotalBookings;
use App\Nova\Metrics\TotalProducts;
use App\Nova\Metrics\TotalSales;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Silverhand7\DashboardCard\DashboardCard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new DashboardCard,

            (new NewCustomers)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
            (new TotalBookings)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
            (new BookingRevenue)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
            (new TotalProducts)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
            (new TotalSales)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
            (new SaleRevenue)->canSee(function($request) {
                return $request->user()->level === 'owner';
            }),
        ];
    }
}
