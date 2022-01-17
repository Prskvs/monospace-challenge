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
            'start' => 'required|date_format:Y-m-d H:i:s',
            'end' => 'required|date_format:Y-m-d H:i:s',
            'revenues' => 'required|numeric|between:0,99999999.99',
            'expenses' => 'required|numeric|between:0,99999999.99',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $vessel = Vessel::find($request->vessel_id);
            $code = $vessel->name . '-' . $request->start;

            $voyage = $vessel->voyages()->create([
                'status' => 'pending',
                'start' => $request->start,
                'end' => $request->end,
                'code' => $code,
                'revenues' => $request->revenues,
                'expenses' => $request->expenses,
            ]);

            return response()->json([
                'success' => 'Voyage successfully stored!',
                'voyage_id' => $voyage->id,
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

    public function update(Voyage $voyage, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'date_format:Y-m-d H:i:s',
            'end' => 'date_format:Y-m-d H:i:s',
            'status' => 'string',
            'revenues' => 'numeric|between:0,99999999.99',
            'expenses' => 'numeric|between:0,99999999.99',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if ($request->status === 'ongoing') {
            $ongoing_voyages = Voyage::where([
                ['vessel_id', '=', $voyage->vessel_id],
                ['status', $request->status],
                ])->first();

            if (!empty($ongoing_voyages)) {
                return response()->json([
                    'failure' => 'Vessel of this voyage has already an ongoing voyage!',
                ]);
            }
        }

        try {
            // Optional update
            $to_update = [];
            foreach ($request as $key => $value) {
                if ( in_array($key, ['start','end','status','revenues','expenses']) ) {
                    $to_update[$key] = $value;
                }
            }

            $voyage->update($to_update);

            return response()->json([
                'success' => 'Voyage successfully updated!',
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
