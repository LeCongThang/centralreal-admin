<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 10:17 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $table = 'company_culture';

    protected $fillable = [
        'title_vi'
    ];
    public $timestamps = true;

}