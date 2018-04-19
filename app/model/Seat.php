<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/10
 * Time: 11:50
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = 'seats';
    protected $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'sId',
        'row',
        'column',
        'status',
    ];


}