<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['kecamatan_id', 'kelurahan', 'kd_pos'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['kelurahan' => 'string', 'kd_pos' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];



    public function kecamatan()
    {
        return $this->belongsTo(\App\Models\Kecamatan::class);
    }
}
