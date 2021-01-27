<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
  use HasFactory, Notifiable;

  protected $fillable = [
    'username',
    'email',
    'password'
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    // email_verified_at' => 'datetime',
  ];

  public function project() {
    return $this->hasOne(Project::class);
  }

  public function votes() {
    return $this->belongsToMany(Project::class, 'votes');
  }
}
