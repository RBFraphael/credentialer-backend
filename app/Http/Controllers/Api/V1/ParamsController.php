<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\CredentialType;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParamsController extends Controller
{
    public function userRoles(Request $request)
    {
        $params = UserRole::dictionary();

        $roles = [];
        foreach($params as $key => $label){
            $roles[] = [
                'label' => $label,
                'value' => $key
            ];
        }

        return response()->json($roles);
    }

    public function credentialTypes(Request $request)
    {
        $params = CredentialType::dictionary();

        $types = [];
        foreach($params as $key => $label){
            $types[] = [
                'label' => $label,
                'value' => $key
            ];
        }

        return response()->json($types);
    }
}
