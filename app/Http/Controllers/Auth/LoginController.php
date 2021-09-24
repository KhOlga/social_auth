<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function redirectToGitHub()
	{
		return Socialite::driver('github')->redirect();
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function handleGitHubCallback()
	{
		$data = Socialite::driver('github')->user();

		if ($user = User::getUserByEmail($data->getEmail())) {
			Auth::login($user, true);

			return redirect()->route('dashboard');
		}

		$newUser = User::create([
			'name' => $data->getName(),
			'nickname' => $data->getNickname(),
			'email' => $data->getEmail(),
			'provider_id' => $data->getId(),
			'profile_photo_path' => $data->getAvatar(),
		]);

		Auth::login($newUser, true);

		return redirect()->route('dashboard');
	}

	/**
	 * Redirect the user to the Google authentication page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function redirectToGoogle()
	{
		return Socialite::driver('google')->redirect();
	}

	/**
	 * Obtain the user information from Google.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function handleGoogleCallback()
	{
		$data = Socialite::driver('google')->user();

		if ($user = User::getUserByEmail($data->getEmail())) {
			Auth::login($user, true);

			return redirect()->route('dashboard');
		}

		$newUser = User::create([
			'name' => $data->getName(),
			'nickname' => $data->getNickname(),
			'email' => $data->getEmail(),
			'provider_id' => $data->getId(),
			'profile_photo_path' => $data->getAvatar(),
		]);

		Auth::login($newUser, true);

		return redirect()->route('dashboard');
	}
}
