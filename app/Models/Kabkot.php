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

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['kabupaten_kota' => 'string', 'ibukota' => 'string', 'k_bsni' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];



    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'provinsi_id');
    }
}
