<?php

namespace Modules\Report\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        dd(auth()->user());

        return auth('api')->user();

        // just for testing protected area
        // Firing Generate Report Command with requested report.
        return response()->json([]);
    }
}
