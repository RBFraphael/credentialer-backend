<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CredentialCreateRequest;
use App\Http\Requests\CredentialUpdateRequest;
use App\Models\Credential;
use App\Models\CredentialFile;
use Illuminate\Http\Request;

class CredentialsController extends Controller
{
    public function create(CredentialCreateRequest $request)
    {
        $credential = new Credential([
            'project_id' => $request->input("project_id"),
            'title' => $request->input("title"),
            'type' => $request->input("type"),
            'info' => $request->input("info", null),
            'gateway' => $request->input("gateway"),
            'port' => $request->input("port", null),
            'user' => $request->input("user"),
            'password' => $request->input("password", null),
        ]);
        $credential->save();

        $files = $request->input("files", []);
        foreach($files as $fileId){
            (new CredentialFile([
                'credential_id' => $credential->id,
                'file_id' => $fileId
            ]))->save();
        }
        
        return response()->json($credential);
    }

    public function all(Request $request)
    {
        $with = $request->get("with", []);
        $where = $request->only(["project_id", "type"]);
        $credentials = Credential::where($where)->with($with)->get();
        return response()->json($credentials);
    }

    public function get(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $with = $request->get("with", []);
            $credential = Credential::with($with)->find($id);
            if($credential){
                return response()->json($credential);
            }

            return response()->json([
                'message' => __("Credential not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing credential ID")
        ], 422);
    }

    public function update(CredentialUpdateRequest $request, $id = null)
    {
        if(is_numeric($id)){
            $credential = Credential::find($id);
            if($credential){
                $credential->project_id = $request->input("project_id", $credential->project_id);
                $credential->title = $request->input("title", $credential->title);
                $credential->type = $request->input("type", $credential->type);
                $credential->info = $request->input("info", $credential->info);
                $credential->gateway = $request->input("gateway", $credential->gateway);
                $credential->port = $request->input("port", $credential->port);
                $credential->user = $request->input("user", $credential->user);
                $credential->password = $request->input("password", $credential->password);
                $credential->save();

                CredentialFile::where("credential_id", $credential->id)->delete();
                $files = $request->input("files", []);
                foreach($files as $fileId){
                    (new CredentialFile([
                        'credential_id' => $credential->id,
                        'file_id' => $fileId
                    ]))->save();
                }

                return response()->json($credential);
            }

            return response()->json([
                'message' => __("Credential not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing credential ID")
        ], 422);
    }

    public function delete(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $credential = Credential::find($id);
            if($credential){
                $credential->delete();

                return response()->json([
                    'message' => __("Credential deleted successfully")
                ]);
            }

            return response()->json([
                'message' => __("Credential not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing credential ID")
        ], 422);
    }
}
