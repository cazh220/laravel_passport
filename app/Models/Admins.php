<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;//新增

class Admins extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;//新增

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 修改passport认证字段
    public function findForPassport($field = '')
    {
        return $this->orWhere('name', $field)->orWhere('email', $field)->first();
    }


}