<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Auth;
use Illuminate\Http\Request;
use Storage;

class ProjectController extends Controller {
  public function index() {
    // TODO: sort by favs if many projects. in frontend, keep current order when voting.
    return Project::with('user', 'votes')->whereNotNull('name')->get();
  }

  public function show() {
    return Auth::user()->project;
  }

  public function update(Request $request) {
    $project = Auth::user()->project;
    if ($request->image === $project->image) $request->request->remove('image');
    $data = $request->validate([
      'name' => 'nullable|string|max:255',
      'link' => 'nullable|url|max:255',
      'description' => 'nullable|string|max:5000',
      'image' => 'nullable|image|max:1024',
    ]);
    if ($request->exists('image')) Storage::delete($project->image);
    $project->fill($data);
    if ($request->file('image')) $project->image = $request->file('image')->store('uploads');
    $project->save();
  }

  public function vote(Project $project) {
    $user = Auth::user();
    if ($project->owned) abort(403);
    if ($project->voted) {
      $project->votes()->detach($user->id);
    } else {
      $user->votes()->sync($project->id);
    }
  }
}
