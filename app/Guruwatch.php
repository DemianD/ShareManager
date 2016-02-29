<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guruwatch extends Model
{
    protected $dates = ['created_at', 'updated_at', 'pubDate'];

    protected $fillable = ['title', 'description', 'link', 'pubDate'];

    public function share()
    {
        $this->belongsTo('App\Share');
    }


}
