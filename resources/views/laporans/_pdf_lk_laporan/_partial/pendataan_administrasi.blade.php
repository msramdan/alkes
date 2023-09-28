<p style="font-size: 14px"><b>A. PENDATAAN ADMINISTRASI</b></p>
    <table class="table table-borderless  table-sm"
        style="margin-left: 18px;font-size:11px;width:100%;margin-top:-10px;float:left ">
        <tbody>
            @php($count = 1)
            @foreach ($laporan_pendataan_administrasi as $row)
                <?php if ($row->field_pendataan_administrasi == 'Faskes Pemilik') {
                    $value = get_data_rs($row->value);
                } else {
                    $value = $row->value;
                }
                ?>
                @if ($count <= $dataAwal)
                    <tr>
                        <td style="width: 1px">{{ $loop->iteration }}.</td>
                        <td style="width: 17%;text-align: justify">{{ $row->field_pendataan_administrasi }}</td>
                        <td style="width: 1px;text-align: justify">:</td>
                        <td style="text-align: justify"><b>{{ $value }} <span>{{ $row->satuan }}</span></b>
                        </td>
                    </tr>
                    @php($count++)
                @endif
            @endforeach
        </tbody>
    </table>
    <table class="table table-borderless table-sm"
        style="margin-left: 50%;font-size:11px;width:100%;margin-top:-10px;margin-bottom:0px">
        <tbody>
            @php($count2 = 1)
            @foreach ($laporan_pendataan_administrasi as $row)
                <?php if ($row->field_pendataan_administrasi == 'Faskes Pemilik') {
                    $value = get_data_rs($row->value);
                } else {
                    $value = $row->value;
                }
                ?>
                @if ($count2 > $dataAwal)
                    <tr>
                        <td style="width: 1px">{{ $loop->iteration }}.</td>
                        <td style="width: 17%;text-align: justify">{{ $row->field_pendataan_administrasi }}</td>
                        <td style="width: 1px;text-align: justify">:</td>
                        <td style="text-align: justify"> <b>{{ $value }} <span>{{ $row->satuan }}</span></b>
                        </td>
                    </tr>
                @endif
                @php($count2++)
            @endforeach
        </tbody>
    </table>
