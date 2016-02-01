<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['name', 'symbol', 'exchange_id'];

    public function exchanges()
    {
        return $this->belongsTo('App\Exchange');
    }

    public function prices()
    {
        return $this->hasMany('App\SharePrice');
    }

    public function setSymbolAttribute($value)
    {
        $this->attributes['symbol'] = strtoupper($value);
    }

    public function getlastPrice()
    {
        return $this->prices()->orderBy('created_at', 'DESC')->take(1)->first()->price;
    }
}
