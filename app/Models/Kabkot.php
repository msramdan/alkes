<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['provinsi_id', 'kabupaten_kota', 'ibukota', 'k_bsni'];


    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'provinsi_id');
    }
}
