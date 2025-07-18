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

Route::get('/AgentFirstOrRetrieval', [AgentController::class, 'AgentFirstOrRetrieval']);

Route::get('/AgentStoreNew', [AgentController::class, 'storeNew']);

Route::get('/AgentCreateNew', [AgentController::class, 'createNew']);


Route::get('/AgentupdateOrCreateAgent', [AgentController::class, 'updateOrCreateAgent']);

Route::get('/AgentupdateViaSave', [AgentController::class, 'updateViaSave']);


Route::get('/AgentsoftDelete', [AgentController::class, 'softDelete']);

Route::get('/AgentdeleteInactive', [AgentController::class, 'deleteInactive']);
