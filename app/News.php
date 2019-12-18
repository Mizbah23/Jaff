<?php

namespace Jaff;
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class News extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use Shareable;

    protected $primaryKey = 'news_id';    
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
