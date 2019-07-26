<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');
// Router::extensions(['csv', 'json','pdf']); # Added by Brian - Needed to add this to export csv files

Router::scope('/', function (RouteBuilder $routes)
{
    $routes->connect('/', ['controller' => 'SummaryHourly', 'action' => 'overallTests']);
    $routes->fallbacks('DashedRoute');
});

Plugin::routes();
