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

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['nama' => 'string', 'jenis_kelamin' => 'boolean', 'no_telpon' => 'string', 'email' => 'string', 'tempat_lahir' => 'string', 'tangal_lahir' => 'date:d/m/Y', 'photo' => 'string', 'password' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    

}
