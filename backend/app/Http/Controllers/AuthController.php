<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
  public function register(Request $request) {
    $request->validate([
      'username' => 'required|alpha_dash|max:255|unique:users',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',
    ]);
    $user = User::create([
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);
    $project = Project::create(['user_id' => $user->id]);
    Auth::login($user, true);
    return $user;
  }

  public function login(Request $request) {
    $this->ensureIsNotRateLimited();
    if (
      Auth::attempt(['email' => $request->email, 'password' => $request->password,], true) ||
      Auth::attempt(['username' => $request->email, 'password' => $request->password,], true)
    ) {
      RateLimiter::clear($this->throttleKey());
      $request->session()->regenerate();
      return Auth::user();
    }
    RateLimiter::hit($this->throttleKey());
    throw ValidationException::withMessages([
      'email' => __('auth.failed'),
    ]);
  }

  public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
  }

  // helper
  //////////////////////////////////////////////////////////////////////////////

  private function ensureIsNotRateLimited() {
    if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
      return;
    }

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw ValidationException::withMessages([
      'email' => trans('auth.throttle', [
        'seconds' => $seconds,
        'minutes' => ceil($seconds / 60),
      ]),
    ]);
  }

  private function throttleKey() {
    return Str::lower(request()->input('email')) . '|' . request()->ip();
  }
}
