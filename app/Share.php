<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['name', 'symbol', 'guruwatch', 'exchange_id'];

    public function exchanges()
    {
        return $this->belongsTo('App\Exchange');
    }

    public function prices()
    {
        return $this->hasMany('App\SharePrice');
    }

    public function guruwatches()
    {
        return $this->hasMany('App\Guruwatch');
    }

    public function recentGuruwatches()
    {
        return $this->guruwatches()->take(10);
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
