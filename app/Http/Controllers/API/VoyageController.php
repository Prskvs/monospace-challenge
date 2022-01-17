<?php

namespace App\Http\Controllers\API;

use App\Models\Voyage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vessel;
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

        

        try {
            $vessel = Vessel::find($request->vessel_id);
            $voyages = $vessel->voyages()->where(['status', 'pending']);
            $code = $vessel->name . $request->start;

            $vessel->voyages()->create([
                'status' => 'pending',
                'start' => $request->start,
                'end' => $request->end,
                'code' => $code,
                'revenues' => $request->revenues,
                'expenses' => $request->expenses,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'message' => 'success',
        ]);
    }
}
