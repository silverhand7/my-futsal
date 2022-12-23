<?php

namespace Silverhand7\DashboardCard;

use Laravel\Nova\Card;

class DashboardCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    public $height = 'auto';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'dashboard-card';
    }
}
