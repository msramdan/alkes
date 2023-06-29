<?php

namespace App\Helper;

use Carbon\Carbon;

class StringHelper
{

    public static function generateZeroIndexNumberWithPrefixFromDB($model, $prefix, $tableColumn)
    {
        if ($row = $model->whereDate('tgl_laporan', Carbon::today())->orderBy('id', 'DESC')->first()) {
            $explodedCodeNumberByStrip = explode('-', $row->$tableColumn);
            $numberZeroIndex = end($explodedCodeNumberByStrip);

            $incrementNumber = intval($numberZeroIndex) + 1;
        } else {
            $incrementNumber = 1;
        }

        $codeNumber = $prefix . '-' . date('Ymd') . '-' . str_pad($incrementNumber, 5, '0', STR_PAD_LEFT);

        return $codeNumber;
    }
}
