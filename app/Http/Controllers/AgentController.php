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

    //first or retrieval
    public function AgentFirstOrRetrieval(){
        $createAgent = Agent::firstOrCreate(
            ['name' => 'Gateway Agent'],                 
            ['role' => 'gateway', 'status' => 'active']);


        $newAgent = Agent::firstOrNew(
            ['name'=>'standby agent'],
            ['role' => 'standby', 'status' => 'idle']);

        $newAgent->save();

        return response()->json([
        'firstOrCreate_result' => $createAgent,
        'firstOrNew_result'    => $newAgent,
        ]);
    }

    //insert
    public function storeNew(Request $request){
        $agent = new Agent;
        $agent->name = $request->name;
        $agent->role = $request->role;
        $agent->status = $request->status;
        $agent->save();
        return response()->json($agent);

    }

    //insert new via mass assigment
    public function createNew(Request $request){
        $agent = Agent::create([
       'name' => $request->name,
        'role' => $request->role,
        'status' => $request->status,
        ]);
   
        return response()->json($agent);
    }

    //update 
    //update via save
     public function updateViaSave(Request $request)
    {
        $agent = Agent::findOrFail($id);
        $agent->name = $request('new_name');
        $agent->save();
        return response()->json($agent);
    }

    //
    public function updateOrCreateAgent(Request $request){
        $agent = Agent::updateOrCreate(
            ['name' => $request('name')],
            [
                'role' => $request('role'),
                'status' => $request('status'),
            ]
        );

        return response()->json($agent);
    }

    //delete
    public function deleteInactive(){

        $deleted = Agent::where('status','inactive')->delete();

       return response()->json([
            'deleted_count' => $deleted,
        ]);
    }

    //soft delete
    public function softDelete(){
        $agent = Agent::findOrFail($id);
        $agent->delete();
        return repsonse()->json([
            'id' => $agent->id,
            'deleted' => true,
            'deleted_at' => $agent->deleted_at,

        ]);
    }
    

}

