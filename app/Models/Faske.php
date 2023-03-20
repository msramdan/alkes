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
    protected $fillable = ['nama_faskes', 'jenis_faskes_id', 'provinsi_id', 'kabkot_id', 'kecamatan_id', 'kelurahan_id', 'alamat'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['nama_faskes' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    
	
	public function jenis_faske()
	{
		return $this->belongsTo(\App\Models\JenisFaske::class);
	}	
	public function province()
	{
		return $this->belongsTo(\App\Models\Province::class);
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
