<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
  use HasFactory;

  protected $guarded = [];
  protected $appends = ['owned', 'voted'];

  public function getOwnedAttribute() {
    if (Auth::guest()) return false;
    return $this->id === Auth::user()->id;
  }

  public function getVotedAttribute() {
    if (Auth::guest()) return false;
    return $this->votes->contains(Auth::user()->id);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function votes() {
    return $this->belongsToMany(User::class, 'votes');
  }
}
