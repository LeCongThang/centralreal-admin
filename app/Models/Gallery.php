<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 10:57 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    public function gallery_images()
    {
        return $this->hasMany('App\Models\GalleryImage', 'gallery_id', 'id');
    }
}