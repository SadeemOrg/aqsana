<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Averotech\Link\Http\Controllers\LinkController;

Route::get('/{resource}', LinkController::class . '@resources');