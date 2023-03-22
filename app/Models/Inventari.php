<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventari extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventaris';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['kode_inventaris', 'kode', 'tahun_pembelian', 'ruangan_id', 'jenis_alat_id', 'merk_id', 'tipe', 'serial_number', 'vendor_id'];


    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'ruangan_id');
    }
    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class, 'jenis_alat_id');
    }
    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class, 'merk_id');
    }
    public function vendor()
    {
        return $this->belongsTo(\App\Models\Vendor::class);
    }
}
