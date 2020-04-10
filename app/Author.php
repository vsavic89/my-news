<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public function _save($first_name, $last_name, $city)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city = $city;        
        $this->save();
    }
}
