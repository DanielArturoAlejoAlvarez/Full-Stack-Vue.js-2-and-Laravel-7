<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $opt = Str::length($this->body) > 128 ? '...' : '';
      return [
        'id'        =>  $this->id,
        'post_name' =>  Str::upper($this->title),
        'post_body' =>  Str::substr($this->body,0,128) . $opt,
        'published' =>  $this->created_at->diffForHumans(),
        'created_at'=>  $this->created_at->format('d-m-Y'),
        'updated_at'=>  $this->updated_at->format('d-m-Y')
      ];
        //return parent::toArray($request);
    }
}
