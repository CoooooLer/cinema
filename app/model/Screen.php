<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/10
 * Time: 12:01
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $table = 'screens';
    protected $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'sId',
        's_name',
        'price',
        's_start',
        's_end',
        'date'
    ];


}