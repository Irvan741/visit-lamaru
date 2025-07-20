<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable = ['category_id' ,'name', 'slug', 'description', 'address', 'latitude', 'longtitude'];
}
