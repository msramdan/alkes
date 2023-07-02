<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laporans';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['no_laporan', 'nomenklatur_id' ,'user_created', 'tgl_laporan', 'status_laporan', 'user_review', 'tgl_review','catatan'];


    public function user_review()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_review');
    }
}
