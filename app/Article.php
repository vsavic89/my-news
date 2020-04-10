<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');                
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag', 'article_id');
    }
    
    public function _save($title, $body, $authorId)
    {
        $this->title = $title;
        $this->body = $body;
        $this->author_id = $authorId;
        $this->save();
    }
}
