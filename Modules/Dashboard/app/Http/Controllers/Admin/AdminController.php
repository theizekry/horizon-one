<?php

namespace Modules\Dashboard\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Modules\Dashboard\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Modules\Dashboard\Enums\Messenger;
use Illuminate\Contracts\Foundation\Application;
use Modules\Dashboard\Http\Requests\Admin\AddAdminRequest;
use Modules\Dashboard\Http\Requests\Admin\EditAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $admins = Admin::query()->applySearch()->paginate();

        return view('dashboard::dashboard.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard::dashboard.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(AddAdminRequest $request)
    {
        $validated = $request->validated();

        Admin::create($validated);

        return redirect()
            ->to(route('dashboard.admins.index'))
            ->with(Messenger::NEW_RECORD_ADDED, __('dashboard::dashboard.new_admin_added'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @return Application|Factory|View
     */
    public function show(Admin $admin)
    {
        return view('dashboard::dashboard.admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View
     */
    public function edit(Admin $admin)
    {
        return view('dashboard::dashboard.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function update(EditAdminRequest $request, Admin $admin)
    {
        $validated = $request->only(['name', 'username', 'phone_number', 'email', 'password', 'profile_image', 'is_blocked']);

        $admin->update($validated);

        return redirect()
            ->to(route('dashboard.admins.index'))
            ->with(Messenger::RECORD_UPDATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()
            ->to(route('dashboard.admins.index'))
            ->with(Messenger::RECORD_DELETED);
    }
}
