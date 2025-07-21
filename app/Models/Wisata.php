<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable = ['category_id' ,'name', 'slug', 'description', 'address', 'latitude', 'longtitude'];

    public function facilities()
    {
        return $this->hasMany(WisataFacility::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
