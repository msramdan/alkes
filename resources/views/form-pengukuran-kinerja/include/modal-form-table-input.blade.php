<div class="modal fade" id="formTableInputModal" tabindex="-1" aria-labelledby="formTableInputModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form class="modal-content" x-data="formTableInputFunction()">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formSingleInputModalLabel">Single Input - [NAME]</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group mb-3">
                            <label for="posisi">POSISI</label>
                            <input type="number" name="posisi" id="posisi" class="form-control" x-model="position" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" x-model="title" required>
                            <template x-if="title">
                                <p class="text-muted">Field Unique Name: <b x-text="replaceSpaceWithUnderscore(title)"></b></p>
                            </template>
                        </div>
                        <div class="form-group mb-3">
                            <label for="row_total">Banyak Baris</label>
                            <input type="number" name="row_total" id="row_total" class="form-control" x-model="rowTotal" required min="1" max="100">
                        </div>
                        <div class="form-group mb-3">
                            <label for="parameter">Parameter</label>
                            <table class="table table-borderless">
                                <tbody>
                                    <template x-for="(parameter, index) in parameters" :key="index">
                                        <tr>
                                            <td class="d-flex flex-column gap-1 p-0 ms-1">
                                                <div class="d-flex flex-row gap-1">
                                                    <span x-text="index + 1"></span>
                                                    <div class="input-group input-group-sm mb-1">
                                                        <input type="text" name="parameter" id="parameter" class="form-control" x-model="parameter.name" required>
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
                                                                            <input type="text" name="sub_parameter" id="sub_parameter" class="form-control" x-model="subParameter.name" required>
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
                                                                                                <input type="text" name="sub_sub_parameter" id="sub_sub_parameter" class="form-control" x-model="subSubParameter.name" required>
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
                    <div class="col-md-7">
                        <h5>Preview</h5>
                        <div class="d-flex flex-column justify-content-center" style="height: 400px; border-radius: 10px; background: #E9EEFF; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); padding: 20px;">
                            <b><span id="preview_position" x-text="position">#</span>.<span id="preview_title" x-text="title">MASUKAN JUDUL</span></b>
                            <div class="d-flex flex-row justify-content-around" style="border: 1px solid black">
                                <template x-for="(parameter, index) in parameters" :key="index">
                                    <div style="border: 1px solid black;" :style="{'width': 100 / parameters.length + '%'}">
                                        <span x-text="parameter.name" class="w-100 text-center d-block"></span>
                                        <template x-if="parameter.subParameters.length > 0">
                                            <div class="d-flex flex-row justify-content-around" style="border: 1px solid black !important;">
                                                <template x-for="(subParameter, subIndex) in parameter.subParameters" :key="subIndex">
                                                    <div style="border: 1px solid black;" :style="{'width': 100 / parameter.subParameters.length + '%'}">
                                                        <span x-text="subParameter.name"></span>
                                                        <template x-if="subParameter.subSubParameters.length > 0">
                                                            <div class="d-flex flex-row justify-content-around" style="border: 1px solid black;">
                                                                <template x-for="(subSubParameter, subSubIndex) in subParameter.subSubParameters" :key="subSubIndex">
                                                                    <span x-text="subSubParameter.name" class="w-100 text-center d-block"></span>
                                                                </template>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                            <template x-for="i in rowTotal">
                                <div>
                                    <input type="text" class="form-control" placeholder="Input" required>
                                </div>
                            </template>
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
