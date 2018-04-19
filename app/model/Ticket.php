<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/11
 * Time: 16:23
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamp = true;

    protected  $fillable =[

        'sId',
      'username',
      'movie_name',
      'cinema_name',
      's_start',
      's_end',
        's_name',
      'row',
      'column',
        'phone',
        'date',
        'price',
    ];
}