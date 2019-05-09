<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Desenpeno extends Model
{
    protected $guarded = ['id'];


  public function user()
    {
        return $this->belongsTo('App\User');
    }
  
    public function revision()
    {
        return $this->hasMany('App\Revision');
    }
  
    public function revisiones()
    {
        return $this->hasMany('App\Revision');
    }
}
