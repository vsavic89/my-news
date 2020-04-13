<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['first_name', 'last_name', 'city'];
    
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public function _save($array)
    {
        $this->fill($array);        
        $this->save();
    }
}
