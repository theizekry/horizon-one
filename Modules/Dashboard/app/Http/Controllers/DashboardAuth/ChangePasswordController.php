<?php

namespace Modules\Dashboard\Http\Controllers\DashboardAuth;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Modules\Dashboard\Enums\Messenger;
use Illuminate\Contracts\Foundation\Application;
use Modules\Dashboard\Http\Requests\Auth\ChangePasswordRequest;

class ChangePasswordController
{
    /**
     * Return view page to Change Password.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard::dashboard.auth.change_password');
    }

    /**
     * Change admin Password.
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse|RedirectResponse
    {
        $admin = auth('admin')->user();

        $admin->password = $request->new_password;

        $admin->save();

        return redirect()
            ->to(route('dashboard.home'))
            ->with(Messenger::RECORD_UPDATED, __('dashboard::dashboard.password_changed'));
    }
}
