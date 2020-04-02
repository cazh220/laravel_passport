<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;//新增

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;//新增

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
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
        return $this->orWhere('username', $field)->orWhere('email', $field)->first();
    }


}
