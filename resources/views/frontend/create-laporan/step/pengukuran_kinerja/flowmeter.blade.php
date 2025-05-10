<b>FLOW RATE</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>(LPM)</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
        </tr>
    </thead>
    @php
        $rows = [3, 6, 9, 12, 15];
        $cols = range(1, 6);
    @endphp

    <tbody>
        @foreach ($rows as $index => $row)
            <tr>
                <td>{{ $row }}</td>
                @foreach ($cols as $col)
                    <td>
                        <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                            name="flowmeter_{{ $row }}_{{ $col }}" required>
                    </td>
                @endforeach
                @if ($index === 0)
                    <td rowspan="{{ count($rows) }}">± 10%</td>
                @endif
            </tr>
        @endforeach
    </tbody>

</table>
