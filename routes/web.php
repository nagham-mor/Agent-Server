<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/agents', [AgentController::class, 'fetchAllAgents']);

Route::get('/sepcificAgents', [AgentController::class, 'fetchSpecificAgents']);

Route::get('/freshAgent/{id}', [AgentController::class, 'refreshAgent']);

Route::get('/rejectOffline', [AgentController::class, 'rejectAgentOffline']);

Route::get('/chunkAgent', [AgentController::class, 'chunkAgent']);

Route::get('/singleRetrival', [AgentController::class, 'singleRetrival']);

