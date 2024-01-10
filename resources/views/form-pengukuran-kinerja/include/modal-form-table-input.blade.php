<div class="modal fade" id="formTableInputModal" tabindex="-1" aria-labelledby="formTableInputModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form class="modal-content" x-data="formTableInputFunction()" x-on:submit.prevent="action == 'Tambah' ? add() : update()" @edit-form-table-input.window="editForm($event.detail)" @new-form-table-input.window="resetForm()">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formSingleInputModalLabel"><span x-text="action"></span> Table Input</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5" style="height: 500px; overflow-y: scroll;">
                        <div class="form-group mb-3">
                            <label for="posisi">POSISI</label>
                            <input type="number" name="posisi" id="posisi" class="form-control" x-model.debounce.500ms="position" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" x-model.debounce.500ms="title" required>
                            <template x-if="title">
                                <p class="text-muted">Field Unique Name: <b x-text="replaceSpaceWithUnderscore(title)"></b></p>
                            </template>
                        </div>
                        <div class="form-group mb-3">
                            <label for="row_total">Banyak Baris</label>
                            <input type="number" name="row_total" id="row_total" class="form-control" x-model.number.debounce.500ms="rowTotal" required min="1" max="100">
                        </div>
                        <div class="form-group mb-3">
                            <label for="parameter">Parameter</label>
                            <div style="border: 1px solid #ced4da; border-radius: 5px; padding: 10px;">
                                <table class="table table-borderless table-scrollable">
                                    <tbody>
                                        <template x-for="(parameter, index) in parameters" :key="index">
                                            <tr>
                                                <td class="d-flex flex-column gap-1 p-0 ms-1">
                                                    <div class="d-flex flex-row gap-1">
                                                        <span x-text="index + 1"></span>
                                                        <div class="input-group input-group-sm mb-1">
                                                            <input type="text" name="parameter" id="parameter" class="form-control" x-model.debounce.500ms="parameter.name" required>
                                                            <button class="btn" type="button" @click="removeParameter(index)"><i class="bi bi-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0)" class="text-secondary" @click="addSubParameter(index)" style="font-size: 11px;"><i class="bi bi-plus"></i> Tambah Sub Parameter</a>
                                                    <table class="table table-borderless ps-1" x-show="parameter.subParameters.length > 0">
                                                        <tbody>
                                                            <template x-for="(subParameter, subIndex) in parameter.subParameters" :key="subIndex">
                                                                <tr>
                                                                    <td class="d-flex flex-column gap-1 p-0 ms-2">
                                                                        <div class="d-flex flex-row gap-1">
                                                                            <span x-text="index + 1 + '.' + (subIndex + 1)"></span>
                                                                            <div class="input-group input-group-sm">
                                                                                <input type="text" name="sub_parameter" id="sub_parameter" class="form-control" x-model.debounce.500ms="subParameter.name" required>
                                                                                <button class="btn" type="button" @click="removeSubParameter(index, subIndex)"><i class="bi bi-trash"></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <a href="javascript:void(0)" class="text-secondary" @click="addSubSubParameter(index, subIndex)" style="font-size: 11px;"><i class="bi bi-plus"></i> Tambah Sub Sub Parameter</a>
                                                                        <table class="table table-borderless ps-2" x-show="subParameter.subSubParameters.length > 0">
                                                                            <tbody>
                                                                                <template x-for="(subSubParameter, subSubIndex) in subParameter.subSubParameters" :key="subSubIndex">
                                                                                    <tr>
                                                                                        <td class="p-0">
                                                                                            <div class="d-flex flex-row gap-1 mb-2">
                                                                                                <span x-text="index + 1 + '.' + (subIndex + 1) + '.' + (subSubIndex + 1)"></span>
                                                                                                <div class="input-group input-group-sm">
                                                                                                    <input type="text" name="sub_sub_parameter" id="sub_sub_parameter" class="form-control" x-model.debounce.500ms="subSubParameter.name" required>
                                                                                                    <button type="button" class="btn" @click="removeSubSubParameter(index, subIndex, subSubIndex)"><i class="bi bi-trash"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </template>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" @click="addParameter"
                                                ><i class="bi bi-plus"></i> Tambah Parameter</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div style="border: 1px solid #ced4da; border-radius: 5px; padding: 10px;">
                            <div class="input-checkbox mb-3">
                                <input type="checkbox" name="acuan" id="is_have_acuan_parameter" class="form-check-input" x-model="acuanParameter.status">
                                <label for="is_have_acuan_parameter" class="form-check-label">Acuan Parameter</label>
                            </div>
                            <template x-if="acuanParameter.status == true && rowTotal <= 0">
                                <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i> Banyak Baris harus lebih dari 0
                                </div>
                            </template>
                            <template x-if="acuanParameter.status == true && rowTotal > 0">
                                <div>
                                    <input type="text" name="acuan_parameter_name" id="acuan_parameter_name" class="form-control form-control-sm" x-model.debounce.500ms="acuanParameter.name" required>
                                    <ul>
                                        <template x-for="i in rowTotal">
                                            <li class="mb-2">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="acuan_parameter" id="acuan_parameter" class="form-control" x-model.debounce.500ms="acuanParameter.values[i - 1]" required>
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-7 d-flex flex-column">
                        <h5>Preview</h5>
                        <div class="d-flex flex-column justify-content-center" style="height: 100%; border-radius: 10px; background: #E9EEFF; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); padding: 20px;">
                            <b><span id="preview_position" x-text="position">#</span>.<span id="preview_title" x-text="title">MASUKAN JUDUL</span></b>
                            <div id="preview-wrapper"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
            </div>
        </form>
    </div>
</div>
