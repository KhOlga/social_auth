<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

		$user = User::create([
			'name' => $data->getName(),
			'nickname' => $data->getNickname(),
			'email' => $data->getEmail(),
			'provider_id' => $data->getId(),
			'profile_photo_path' => $data->getAvatar(),
		]);

		auth()->login($user, true);

		return redirect()->route('dashboard');
	}
}
