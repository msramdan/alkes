<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="mdi mdi-information-outline"></i> {{ __('Tidak ada elemen form, mulai tambahkan sesuatu disini') }}
        </div>

        <div class="form-group mb-2">
            <label for="form_title">Judul Form</label>
            <input type="text" name="form_title" class="form-control" required>
        </div>
        <table class="table" x-data="{ data: [] }" @add-form.window="data.push($event.detail)" @update-form.window="data[$event.detail.index] = $event.detail.data">
            <thead>
                <tr>
                    <th>Posisi</th>
                    <th>Judul</th>
                    <th>Jenis</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <template x-if="data.length > 0">
                    <template x-for="(item, index) in data" :key="index">
                        <tr>
                            <td x-text="index + 1"></td>
                            <td x-text="item.title"></td>
                            <td x-text="item.inputType"></td>
                            <td>
                                <button type="button" class="btn btn-sm" @click.prevent="item.inputType == 'single-input' ? $dispatch('edit-form-single-input', {...item, index: index}) : $dispatch('edit-form-table-input', {...item, index: index})"
                                data-bs-toggle="modal" :data-bs-target="item.inputType == 'single-input' ? '#formSingleInputModal' : '#formTableInputModal'"><i class="bi bi-pencil"></i></button>
                                <button type="button" class="btn btn-sm" @click.prevent="data.splice(index, 1)"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </template>
                </template>
                <template x-if="data.length == 0">
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada Elemen Input</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
