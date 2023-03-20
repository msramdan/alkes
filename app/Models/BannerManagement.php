<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerManagement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'banner_managements';
    protected $fillable = ['banner_iamge', 'posisi'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['banner_iamge' => 'string', 'posisi' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
}
