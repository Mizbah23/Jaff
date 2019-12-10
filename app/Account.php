<?php

namespace Jaff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'accid';
    protected $dates = ['deleted_at'];
}


