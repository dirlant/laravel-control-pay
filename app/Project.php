<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
  // Customer = Cliente
  public $fillable = [
    'user_id', 'client_id', 'name', 'enable'
  ];

  protected $hidden = ['created_at', 'updated_at'];
}
