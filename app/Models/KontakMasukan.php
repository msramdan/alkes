<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakMasukan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['pelaksana_teknis_id', 'judul', 'deksiprsi'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['judul' => 'string', 'deksiprsi' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];



    public function pelaksana_teknis()
    {
        return $this->belongsTo(\App\Models\PelaksanaTeknisi::class);
    }
}
