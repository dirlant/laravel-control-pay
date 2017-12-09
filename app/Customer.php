<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
  // Customer = Cliente
  public $fillable = [
    'user_id', 'name', 'email', 'enable'
  ];

  protected $hidden = ['created_at', 'updated_at'];
}
