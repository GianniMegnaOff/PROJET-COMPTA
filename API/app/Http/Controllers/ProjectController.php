<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Config;
use App\Project;
use App\Deal;

class ProjectController extends Controller {
    
    public function getAllProjects()
    {
        $projects = Project::with(['client','statut','deal'])->get();
        
        
        //$projects = DB::table('Project')->get()
        
        return $projects;
    }
    
 
     public function getProject($id)
    {
        $project = Project::with(['client','statut','deal'])->where('id', $id)->first();
        return $project;
    }

     public function updateStatut(Request $request)
    {   
        $project = Project::find($request->input('id_projet'));
        $project->statut = $request->input('id_statut');
        $project->save();
    }
    
     public function updateProject(Request $request)
    {   
        $project = Project::find($request->input('id_projet'));
        $project->name = $request->input('name');
        $project->comment = $request->input('comment');
        $project->save();
    }
    
     public function deleteProject(Request $request)
    {   
        $project = Project::find($request->input('id_projet'));
        $project->delete();
    }
    
      public function updateDeal(Request $request, $id)
    {   
        foreach($request->input() as $deal){
            //var_dump($deal);
            $dealUpdated = Deal::updateOrCreate(['id' => $deal['id']], $deal);
        }
        
         $deal = Deal::where('id_project', $id)->get();
        return $deal;
    }
  
    public function createProject(Request $request)
    {
        $project = new Project;
        $project->id_client = $request->input('id_client');
        $project->name = $request->input('name');
        $project->comment = $request->input('comment');
        $project->save();
    }
}