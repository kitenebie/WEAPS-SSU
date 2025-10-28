<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
        $user = Socialite::driver('google')->user();
        // Handle user creation/login logic here
        return redirect('/employeer/login');
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