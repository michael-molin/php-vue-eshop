<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    protected $fillable = [
        'user_id',
        'card_number',
        'card_exp',
        'card_cvv'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
