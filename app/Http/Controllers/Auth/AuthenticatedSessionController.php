<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\loginNotification;
use App\Helpers\email_sender;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
// use App\Helpers\email_sender;
// use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = $request->user();
        $loginTime = now()->toDateTimeString();
        $deviceType = $request->header('Device-Type', 'Unknown');  // Optional: Device type header
        $userIp = $request->ip();
        // $user->notify(new loginNotification($user, $loginTime, $deviceType, $userIp));
        // $adminUsers = User::where('role', 'admin user')->get(); // Adjust the query based on your role implementation
        $adminUsers = User::role('admin user')->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(new LoginNotification($user, $loginTime, $deviceType, $userIp));
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', 'logout Successfully');;
    }
}
