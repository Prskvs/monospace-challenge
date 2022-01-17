<?php

namespace App\Http\Controllers\API;

use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VesselOpexController extends Controller
{
    public function store(Vessel $vessel, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date_format:Y-m-d',
            'expenses' => 'required|numeric|between:0,99999999.99',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        try {
            $opex = $vessel->opex()->create([
                'date' => $request->date,
                'expenses' => $request->expenses,
            ]);

            return response()->json([
                'success' => 'Vessel Opex successfully stored!',
                'opex_id' => $opex->id,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }

        // Fallback
        return response()->json();
    }
}
