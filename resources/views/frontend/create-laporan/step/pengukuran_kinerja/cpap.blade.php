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
    <tbody>
        <?php
        $flowSettings = [1, 5, 10, 12, 15];
        foreach ($flowSettings as $setting) {
            echo '<tr>
                <td>' .
                $setting .
                '</td>';
            for ($j = 1; $j <= 6; $j++) {
                echo '<td>
                    <input style="width: 100px" type="number" step="0.000000001" class="form-control"
                        name="flowmeter_' .
                    $setting .
                    '_' .
                    $j .
                    '" required>
                </td>';
            }
            if ($setting === 1) {
                echo '<td rowspan="5">± 10%</td>';
            }
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<br>
<b>KONSENTRASI OKSIGEN</b>
<table class="table table-bordered" style="border-color: black">
    <thead>
        <tr>
            <th>Setting Alat</th>
            <th colspan="6">Penunjukan Standar</th>
            <th rowspan="2">Toleransi</th>
        </tr>
        <tr>
            <th>%</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $oxygenSettings = [21, 50, 100];
        foreach ($oxygenSettings as $setting) {
            echo '<tr>
                        <td>' .
                $setting .
                '</td>';
            for ($j = 1; $j <= 6; $j++) {
                echo '<td>
                            <input style="width: 100px" type="number" step="0.000000001" class="form-control" required
                                name="konsentrasi_oksigen_' .
                    $setting .
                    '_' .
                    $j .
                    '" required>
                        </td>';
            }
            if ($setting === 21) {
                echo '<td rowspan="3">± 3 % O2</td>';
            }
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
