<style>
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    @media (max-width: 768px) {
        .table input {
            min-width: 100px;
            max-width: none;
        }
    }

    .text-gray {
        background-color: #e0e0e0;
        text-align: center;
    }
</style>

<div class="container bg-white p-4 rounded shadow">
    <div class="col-md-12">
        <center>
            <img src="{{ asset('mikroskop.png') }}" alt="">
        </center>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Skala Pembesaran</th>
                    <th colspan="6">Terukur pada</th>
                </tr>
                <tr>
                    <th><input type="text" name="terukur_1" class="form-control form-control-sm d-inline-block" style="width: calc(100% - 20px);" required> X</th>
                    <th><input type="text" name="terukur_2" class="form-control form-control-sm d-inline-block" style="width: calc(100% - 20px);" required> X</th>
                    <th><input type="text" name="terukur_3" class="form-control form-control-sm d-inline-block" style="width: calc(100% - 20px);" required> X</th>
                    <th><input type="text" name="terukur_4" class="form-control form-control-sm d-inline-block" style="width: calc(100% - 20px);" required> X</th>
                    <th><input type="text" name="terukur_5" class="form-control form-control-sm d-inline-block" style="width: calc(100% - 20px);" required> X</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2">1</td>
                    <td>Kualitas</td>
                    <td><input type="text" name="kualitas_1" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="kualitas_2" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="kualitas_3" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="kualitas_4" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="kualitas_5" class="form-control form-control-sm" required></td>
                </tr>
                <tr>
                    <td>Kuantitas</td>
                    <td colspan="5" class="text-gray">Diisi jika mikroskop memiliki okuler mikrometer</td>
                </tr>
                <tr>
                    <td rowspan="2">2</td>
                    <td>Stage Mikrometer</td>
                    <td><input type="text" name="stage_1" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="stage_2" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="stage_3" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="stage_4" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="stage_5" class="form-control form-control-sm" required></td>
                </tr>
                <tr>
                    <td>Okuler Mikrometer</td>
                    <td><input type="text" name="okuler_1" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="okuler_2" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="okuler_3" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="okuler_4" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="okuler_5" class="form-control form-control-sm" required></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
