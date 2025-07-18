<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;




Route::get('/', function () {
    return view('welcome');
});




Route::get('/agents', [AgentController::class, 'fetchAllAgents']);
