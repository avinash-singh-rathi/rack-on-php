<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    //
    use HasSlug;

    /**
    * Get the options for generating the slug.
    */
   public function getSlugOptions() : SlugOptions
   {
       return SlugOptions::create()
           ->generateSlugsFrom('title')
           ->saveSlugsTo('slug');
   }
}
