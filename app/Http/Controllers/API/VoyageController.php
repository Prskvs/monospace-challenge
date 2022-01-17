<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VoyageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vessel_id' => 'required|int',
            'start' => 'required|date_format:Y-m-d',
            'end' => 'required|date_format:Y-m-d',
            'revenues' => 'required|numeric|between:0,99999999.99',
            'expenses' => 'required|numeric|between:0,99999999.99',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        return response()->json([
            'message' => 'success',
        ]);
    }
}
