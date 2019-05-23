<?php

use App\Controllers\VisitBerlinController;
use App\Controllers\EventController;
use App\Controllers\ConferenceController;

//Brussels
$app->get('/berlin', ConferenceController::class . ':conference'); 

$app->get('/berlin_events', EventController::class . ':events'); 




