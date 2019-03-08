<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Viajera extends Model
{
    protected $guarded = ['id'];
  
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}