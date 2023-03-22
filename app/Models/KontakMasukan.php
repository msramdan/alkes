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



    public function pelaksana_teknis()
    {
        return $this->belongsTo(\App\Models\PelaksanaTeknisi::class);
    }
}
