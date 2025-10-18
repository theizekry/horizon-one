<?php

namespace Modules\Integration\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Modules\Integration\Models\Integration;
use Illuminate\Contracts\Foundation\Application;

class IntegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $integrations = Integration::query()->paginate();

        return view('integration::dashboard.integration.index', compact('integrations'));
    }
}
