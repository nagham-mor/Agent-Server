<?php

namespace App\Http\Controllers;
use App\Models\Agent;
use Illuminate\Http\Request;
class AgentController extends Controller
{
    public function fetchAllAgents(){
        $agents = Agent::all();

        foreach($agents as $agent){
            echo $agent->name , " ";
        }
    }
}
