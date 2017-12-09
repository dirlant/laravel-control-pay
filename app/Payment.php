<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
  // Payments = Cobros
  public $fillable = [
    'project_id',  'description',  'amount',  'enable'
  ];

  protected $hidden = ['created_at', 'updated_at'];
}
