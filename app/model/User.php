<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 规定表名、主键
     * 维护时间戳
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'uid';
    public $timestamps = true;

    /**
     * 以下字段可插入
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'phone',
        'money'
    ];

    /**
     * 以下字段隐藏显示
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
