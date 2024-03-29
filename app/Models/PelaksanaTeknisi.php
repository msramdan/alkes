<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaksanaTeknisi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['nama', 'jenis_kelamin', 'no_telpon', 'email', 'tempat_lahir', 'tangal_lahir', 'photo', 'password'];
}
