<?php

namespace Jaff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Asection extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'secid';
    protected $dates = ['deleted_at'];
}
