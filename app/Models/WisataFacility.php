<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WisataFacility extends Model
{
    protected $fillable = ['wisata_id', 'facility_id'];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
