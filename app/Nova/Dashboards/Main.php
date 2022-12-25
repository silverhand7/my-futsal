<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewCustomers;
use App\Nova\Metrics\BookingRevenue;
use App\Nova\Metrics\TotalBookings;
use Laravel\Nova\Cards\Help;
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
            //new Help,
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
        ];
    }
}
