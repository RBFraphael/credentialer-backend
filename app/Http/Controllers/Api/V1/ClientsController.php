<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function create(ClientCreateRequest $request)
    {
        $client = new Client([
            'name' => $request->input("name"),
            'logo_file_id' => $request->input("logo_file_id", null),
        ]);
        $client->save();

        return response()->json($client);
    }

    public function all(Request $request)
    {
        $with = $request->get("with", []);
        $clients = Client::with($with)->get();
        return response()->json($clients);
    }

    public function get(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $with = $request->get("with", []);
            $client = Client::with($with)->find($id);
            if($client){
                return response()->json($client);
            }

            return response()->json([
                'message' => __("Client not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing client ID")
        ], 422);
    }

    public function update(ClientUpdateRequest $request, $id = null)
    {
        if(is_numeric($id)){
            $client = Client::find($id);
            if($client){
                $client->name = $request->input("name", $client->name);
                $client->logo_file_id = $request->input("name", $client->logo_file_id);
                $client->save();

                return response()->json($client);
            }

            return response()->json([
                'message' => __("Client not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing client ID")
        ], 422);
    }

    public function delete(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $client = Client::find($id);
            if($client){
                $client->delete();

                return response()->json([
                    'message' => __("Client deleted successfully")
                ]);
            }

            return response()->json([
                'message' => __("Client not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing client ID")
        ], 422);
    }
}
