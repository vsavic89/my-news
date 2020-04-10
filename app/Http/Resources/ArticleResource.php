<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'title' => $this->title,        
            'author' => $this->author->full_name,
            'tags' => $this->tags
        ];
    }
    public function with($request)
    {                
        return [
          'version' => 'v1.0',
          'author' => 'Vladimir Savic'
        ];
    }
}
