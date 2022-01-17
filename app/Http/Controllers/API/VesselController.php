<?php

namespace App\Http\Controllers\API;

use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VesselController extends Controller
{
    public function report(Vessel $vessel, Request $request)
    {
        return response()->json([
            'message' => "report for vessel {$vessel->id}",
        ]);
    }
}
