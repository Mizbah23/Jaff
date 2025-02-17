<?php

namespace Jaff;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    
    protected $fillable = [
        'phone', 'password',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
 