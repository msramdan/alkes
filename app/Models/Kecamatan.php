<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['kabkot_id', 'kecamatan'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['kecamatan' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    

	public function kabkot()
	{
		return $this->belongsTo(\App\Models\Kabkot::class);
	}
}
