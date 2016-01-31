<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $fillable = ['name'];

    public function shares()
    {
        return $this->hasMany('App\Share');
    }

}
