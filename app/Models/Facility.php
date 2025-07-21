<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['wisata_id', 'name', 'image_path', 'caption'];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
