<?php

namespace Modules\Integration\Http\Controllers\Dashboard;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Modules\Integration\Models\SystemCollection;
use Modules\Integration\Services\Integration\IntegrationServices;
use Modules\Integration\Services\Integration\IntegrationOnboardingService;
use Modules\Integration\Http\Requests\IntegrationOnboarding\GeneralRequest;
use Modules\Integration\Http\Requests\IntegrationOnboarding\UnitMappingRequest;
use Modules\Integration\Http\Requests\IntegrationOnboarding\MasterDatabaseRequest;

class IntegrationOnboardingController extends Controller
{
    public function __construct(
        private readonly IntegrationOnboardingService $integrationOnboardingService,
        private readonly IntegrationServices $integrationServices
    ) {}

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function createNewIntegration()
    {
        $collections = SystemCollection::with('fields')->get();

        return view('integration::dashboard.integration.create', compact('collections'));
    }

    /**
     * @return JsonResponse
     */
    public function saveGeneralStep(GeneralRequest $request)
    {
        try {
            $validated = $request->validated();

            $integration = $this->integrationServices->createNewIntegration($validated['name']);

            $this->integrationOnboardingService->generateOAuthClient($integration);

            return response()->json(['message' => 'Integration created successfully.', 'data' => $integration], 201);
        } catch (Throwable $e) {
            return response()
                ->json([
                    'message' => 'Something went wrong while creating the integration.',
                    'error'   => app()->isLocal() ? $e->getMessage() : null,
                ], 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function saveMasterDatabaseConnection(MasterDatabaseRequest $request)
    {
        try {
            $validated = $request->validated();

            $integration = $this->integrationServices->findIntegrationById($validated['integration_id']);

            $integration->masterConnection()->create($validated);

            return response()->json(['message' => 'Master connection saved successfully.', 'data' => $integration], 201);
        } catch (Throwable $e) {
            return response()
                ->json(['message' => 'Something went wrong.', 'error' => app()->isLocal() ? $e->getMessage() : null], 500);
        }
    }

    /**
     * @return void
     */
    public function saveUnitsMapping(UnitMappingRequest $request)
    {
        dd($request->validated());
    }
}
