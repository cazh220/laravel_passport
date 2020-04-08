<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;//新增
use Illuminate\Support\Facades\Log;

class Admins extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;//新增

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';
    protected $primaryKey = 'admin_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'username',
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
        Log::info(__CLASS__.':'.__FUNCTION__.":".$field);
        return $this->orWhere('name', $field)->orWhere('username', $field)->first();
    }


}