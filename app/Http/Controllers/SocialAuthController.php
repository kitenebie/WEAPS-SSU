<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google authentication
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Redirect to GitHub authentication
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Redirect to LinkedIn authentication
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Handle Google authentication callback
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            // Check if user exists by email
            $user = \App\Models\User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Create new user
                $user = \App\Models\User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => \Illuminate\Support\Facades\Hash::make(uniqid()), // Random password since OAuth
                    'email_verified_at' => now(), // Google emails are verified
                ]);

                // Assign default role
                $role = Role::firstOrCreate(['name' => env('USER_DEFAULT_ROLE'), 'guard_name' => 'web']);
                $user->assignRole($role);
            }

            // Log the user in
            \Illuminate\Support\Facades\Auth::login($user);

            // Redirect to intended page or dashboard
            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Handle errors gracefully
            return redirect('/login')->withErrors(['social_auth' => 'Authentication failed. Please try again.']);
        }
    }

    /**
     * Handle GitHub authentication callback
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        // Handle user creation/login logic here
        return redirect('/employeer/login');
    }

    /**
     * Handle LinkedIn authentication callback
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleLinkedInCallback()
    {
        $user = Socialite::driver('linkedin')->user();
        // Handle user creation/login logic here
        return redirect('/employeer/login');
    }
}
