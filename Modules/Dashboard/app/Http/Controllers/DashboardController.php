<?php

namespace Modules\Dashboard\Http\Controllers;

use Modules\Dashboard\Models\Admin;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function showDashboardHome()
    {
        $adminsCount  = Admin::count();
        $clientsCount = 10;
        $reportsCount = 5000;

        return view('dashboard::dashboard.index', compact(
            'adminsCount',
            'clientsCount',
            'reportsCount'
        ));
    }
}
