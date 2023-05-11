<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function create(ProjectCreateRequest $request)
    {
        $project = new Project([
            'client_id' => $request->input("client_id"),
            'title' => $request->input("title"),
        ]);
        $project->save();

        return response()->json($project);
    }

    public function all(Request $request)
    {
        $with = $request->get("with", []);
        $where = $request->only(["client_id"]);
        $projects = Project::where($where)->with($with)->get();
        return response()->json($projects);
    }

    public function get(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $with = $request->get("with", []);
            $project= Project::with($with)->find($id);
            if($project){
                return response()->json($project);
            }

            return response()->json([
                'message' => __("Project not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing project ID")
        ], 422);
    }

    public function update(ProjectUpdateRequest $request, $id = null)
    {
        if(is_numeric($id)){
            $project= Project::find($id);
            if($project){
                $project->client_id = $request->input("client_id", $project->client_id);
                $project->title = $request->input("title", $project->title);
                $project->save();

                return response()->json($project);
            }

            return response()->json([
                'message' => __("Project not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing project ID")
        ], 422);
    }

    public function delete(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $project= Project::find($id);
            if($project){
                $project->delete();

                return response()->json([
                    'message' => __("Project deleted successfully")
                ]);
            }

            return response()->json([
                'message' => __("Project not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing project ID")
        ], 422);
    }
}
