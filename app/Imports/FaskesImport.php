<?php

namespace App\Imports;

use App\Models\Faske;
use App\Models\JenisFaske;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FaskesImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        Validator::make(
            $collection->toArray(),
            [
                '*.nama_faskes' => 'required',
                '*.jenis_faskes' => 'required',
                '*.alamat' => 'required',
            ],
        )->validate();
        foreach ($collection as $row) {
            Faske::create([
                'nama_faskes' => $row['nama_faskes'],
                'alamat' => $row['alamat'],
                'jenis_faskes_id' => JenisFaske::where('nama_jenis_faskes', $row['jenis_faskes'])->first()->id,
                'pin' => 123456,
            ]);
        }
    }
}
