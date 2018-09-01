<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 2:52 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    public $timestamps = true;

    protected $table = 'system_config';
}