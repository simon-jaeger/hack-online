<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller {
  public function index() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show(User $user) {
    return Auth::user();
  }

  public function update(Request $request) {
    if ($request->get('password') === null) $request->request->remove('password');
    $user = Auth::user();
    $data = $request->validate([
      'username' => ['required', 'alpha_dash', 'max:255', Rule::unique('users')->ignore($user)],
      'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
      'password' => 'sometimes|string|min:8',
    ]);
    if ($request->has('password')) $data['password'] = Hash::make($data['password']);
    $user->update($data);
  }

  public function destroy(User $user) {
    //
  }
}
