<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileCreateRequest;
use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function create(FileCreateRequest $request)
    {
        $file = $request->file("file");
        $name = $file->getClientOriginalName();
        $directory = "uploads/".date("Y/m");
        $path = $request->file("file")->storePublicly($directory, "public");

        $file = new File([
            'path' => $path,
            'name' => $name
        ]);
        $file->save();

        return response()->json($file);
    }

    public function get(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $file = File::find($id);
            if($file){
                return response()->json($file);
            }

            return response()->json([
                'message' => __("File not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing file ID")
        ], 422);
    }

    public function delete(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $file = File::find($id);
            if($file){
                unlink(public_path("storage/".$file->path));
                $file->delete();
                
                return response()->json([
                    'message' => __("File deleted successfully")
                ]);
            }

            return response()->json([
                'message' => __("File not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing file ID")
        ], 422);
    }
}
