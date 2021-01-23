<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller {
  public function index() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show() {
    return Auth::user()->project;
  }

  public function update(Request $request) {
    $data = $request->validate([
      'name' => 'nullable|string|max:255',
      'link' => 'nullable|url|max:255',
      'description' => 'nullable|string|max:4095',
      'image' => 'nullable|string',
    ]);
    Auth::user()->project->update($data);
  }

  public function destroy(Project $project) {
    //
  }
}
