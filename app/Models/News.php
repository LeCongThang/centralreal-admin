<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 3:30 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [

    ];
    public $timestamps = true;
    public function client_register()
    {
        return $this->hasMany('App\Models\EventRegister', 'event_id', 'id');
    }
}