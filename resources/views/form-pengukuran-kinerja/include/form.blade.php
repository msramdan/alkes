<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="mdi mdi-information-outline"></i> {{ __('Tidak ada elemen form, mulai tambahkan sesuatu disini') }}
        </div>

        <table class="table" x-data="{ data: [] }" @fetch-form.window="console.log($event.detail)">
            <thead>
                <tr>
                    <th>Posisi</th>
                    <th>Judul</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada Elemen Input</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
