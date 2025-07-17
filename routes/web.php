<?php

use Illuminate\Support\Facades\Route;

Route::get('/agents-demo', [AgentController::class, 'fetchAll']);
