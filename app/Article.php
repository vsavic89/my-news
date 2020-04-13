<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'author_id'];
    
    public function author()
    {
        return $this->belongsTo('App\Author');                
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag', 'article_id');
    }
    
    public function _save($array)
    {                
        $this->fill($array);
        $this->save();
        
        $this->tags()->detach();        
        $this->tags()->attach($array['tags']);
    }
}
