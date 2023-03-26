<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faske extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['nama_faskes', 'jenis_faskes_id', 'provinsi_id', 'kabkot_id', 'kecamatan_id', 'kelurahan_id', 'alamat', 'zip_kode'];


    public function jenis_faske()
    {
        return $this->belongsTo(\App\Models\JenisFaske::class, 'jenis_faskes_id');
    }
    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'provinsi_id');
    }
    public function kabkot()
    {
        return $this->belongsTo(\App\Models\Kabkot::class);
    }
    public function kecamatan()
    {
        return $this->belongsTo(\App\Models\Kecamatan::class);
    }
    public function kelurahan()
    {
        return $this->belongsTo(\App\Models\Kelurahan::class);
    }
}
