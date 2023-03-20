<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['provinsi', 'ibukota', 'p_bsni'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['provinsi' => 'string', 'ibukota' => 'string', 'p_bsni' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
}
