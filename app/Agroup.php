<?php

namespace Jaff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Agroup extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'grpid';
    protected $dates = ['deleted_at'];
}
