<?php

namespace Jaff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slot extends Model
{
    protected $primaryKey = 'slot_id';
    public function ground()
    {
        return $this->hasOne('Jaff\Ground','id','ground_id');
    }
    public function type()
    {
        return $this->hasOne('Jaff\Type','id','type_id');
    }
    public function day()
    {
        return $this->hasOne('Jaff\Weekday','id','day_id');
    }
    use SoftDeletes;
}
