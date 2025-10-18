<?php

namespace Modules\Dashboard\Http\Controllers\DashboardAuth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\CoreController;

class LoginController extends CoreController
{
    public function __construct()
    {
        if ($this->guard()->check()) {
            return redirect()->intended($this->redirectPath());
        }

        return false;
    }

    /**
     * Show the application's login form.
     */
    public function showLoginForm(): View|Factory|RedirectResponse|Application
    {
        return view('dashboard::dashboard.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     *
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse|Response|RedirectResponse
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request): void
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     */
    private function attemptLogin(Request $request): bool
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->boolean('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     */
    private function credentials(Request $request): array
    {
        return [
            $this->username() => $request->email,
            'password'        => $request->password,
        ];
    }

    /**
     * Send the response after the user was authenticated.
     */
    private function sendLoginResponse(Request $request): JsonResponse|RedirectResponse
    {
        $request->session()->regenerate();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * Return the redirect Path route.
     */
    private function redirectPath(): string
    {
        return route('dashboard.home');
    }

    /**
     * Get the failed login response instance.
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request): Response
    {
        throw ValidationException::withMessages([
            'auth.failed' => [trans('auth.failed')],
        ]);
    }

    /**
     * Login behavior can be done either username or email.
     *
     * So, based on the given string we've to return the field name.
     */
    private function username(): string
    {
        return filter_var(request('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
    }

    /**
     * Get the guard to be used during authentication.
     */
    private function guard(): StatefulGuard
    {
        return Auth::guard('admin');
    }
}
