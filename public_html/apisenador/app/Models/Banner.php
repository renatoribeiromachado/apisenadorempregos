<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "api_banners_senador";
    protected $fillable = ['title', 'image'];

}
