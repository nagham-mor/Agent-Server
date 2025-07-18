<?php

namespace App\Http\Controllers;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
class AgentController extends Controller
{
    //Retrieving Models
    public function fetchAllAgents(){
        $agents = Agent::all();

        foreach($agents as $agent){
            echo $agent->name , " ";
        }
    }


    //Building Queries
     public function fetchSpecificAgents(){
        $agents = Agent::where('role','analysis')
        ->orderBy('name')
        ->limit(5)
        ->get();

        return response()->json($agents);

    }

    //Refreshing Models
    public function refreshAgent($id){
        $agent = Agent::findOrFail($id);

        $originalName = $agent->name;
        $agent->name = 'Temporary Name';

        $freshAgent = $agent->fresh();

        return response()->json([
            'original_model'=>[
                'id'=> $agent->id,
                'name'=> $agent->name,
            ],
            'fresh_model'=>[
                'id'=> $freshAgent->id,
                'name'=> $freshAgent->name,
            ]
            ]);


    }


    //Collections
    public function rejectAgentOffline(){

        $agents = Agent::all();

        $filtered = $agents->reject(function (Agent $agent){
            return $agent->status === 'offline';
        });

         return response()->json($filtered);
    }

    //chunks
    public function chunkAgent(){

        $names = [];

        Agent::chunk(200, function(collection $agents) use(&$names){
            foreach($agents as $agent){
                $names[] = $agent->name;
            }
        });

        return response()->json($names);
    }

    //retreiving single aggregate
    public function singleRetrival(){
        $id = Agent::find(1);
        $firstAcrive = Agent::where('status','active')->first();
        $firstAnalysis = Agent::firstWhere('role','analysis');

        return response() -> json([
            'by_id' => $id,
            'first_Active' => $firstAcrive,
            'first_Analysis'=>$firstAnalysis,
        ]);
    }
}

