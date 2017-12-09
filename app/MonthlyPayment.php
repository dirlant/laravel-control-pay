<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model {
  // MonthlyPayments = Mensualidades
  public $fillable = [
    'user_id',  'project_id',  'name',  'amount',  'date',  'status',  'enable'
  ];

  protected $hidden = ['created_at', 'updated_at'];
}
