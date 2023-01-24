<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user = auth()->user();
        $user_name = "";
        for ($i = 0; $i < strlen($user->email); $i++) {

            if ($user->email[$i] == '@') {
                $i = strlen($user->email) + 1;
            } else {
                $user_name = $user_name . $user->email[$i];
            }
        }
        session(['user_name' => $user_name]);

        if ($user->hasRole('employer')) {

            $employer = $user->user_has_employer->first();

            if ($employer) {
                if ($employer->validated != '1') {
                    return redirect('employer/' . $employer->id . '/edit');
                }
            } else {

                return redirect('employer/create');
            }
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

        return redirect('/');
    }
}
