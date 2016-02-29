<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharePrice extends Model
{
    protected $fillable = ['price', 'lastTradeDate'];
    protected $dates = ['created_at', 'updated_at', 'lastTradeDate'];

    public function share()
    {
        $this->belongsTo('App\Share');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = number_format(floatval($value), 3);
    }

    public function getPriceAttribute($value)
    {
        return number_format((float)$value, 2, '.', '');
    }
}
