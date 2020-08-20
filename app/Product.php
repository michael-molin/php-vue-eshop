<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'name',
      'user_id',
      'stock',
      'description',
      'photo',
      'price'
  ];

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function order()
 {
     return $this->belongsToMany('App\Order');
 }

}
