<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 3:33 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $table = 'recruitment';

    protected $fillable = [

    ];
    public $timestamps = true;
    public function rela_role(){
        return $this->belongsTo('App\Models\RecruitmentRole','recruitment_role_id','id');
    }
}