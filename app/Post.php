<?php

namespace Jaff;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Post extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $primaryKey = 'post_id';
    
    public function category()
    {
        return $this->hasOne('Jaff\Category','category_id','id');
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
