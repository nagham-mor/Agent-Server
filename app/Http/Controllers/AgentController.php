<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function fetchAll(){
        $agent::Agent::all();

        foreach($agents as $agent){
            echo $agent->name;
        }
    }
}
