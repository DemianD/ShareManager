<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['name', 'symbol'];

    public function exchanges()
    {
        return $this->belongsTo('App\Exchange');
    }
}
