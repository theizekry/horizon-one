<?php

namespace Modules\Integration\Http\Controllers\Dashboard;

use Throwable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Integration\Http\Requests\IntegrationOnboarding\MasterDatabaseRequest;
use Modules\Integration\Services\TestDatabaseConnection\TestDatabaseConnectionService;

class TestDatabaseConnectionController extends Controller
{
    public function testConnection(MasterDatabaseRequest $request, TestDatabaseConnectionService $databaseConnectionService): JsonResponse
    {
        try {
            $databaseConnectionService->testConnection($request->validated());

            return response()->json();
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
