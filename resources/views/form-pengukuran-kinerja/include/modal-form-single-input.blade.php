<div class="modal fade" id="formSingleInputModal" tabindex="-1" aria-labelledby="formSingleInputModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form class="modal-content" x-data="{ isRequired: false, position: null, title: null, note: null, placeholder: null, type: null, invalidFeedbackMessage: null }" x-on:submit.prevent="$dispatch('fetch-form', { position: position, title: title, note: note, placeholder: placeholder, type: type, isRequired: isRequired, invalidFeedbackMessage: invalidFeedbackMessage, inputType: 'single-input', inputName: replaceSpaceWithUnderscore(title) })">
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
                            <label for="note">Note</label>
                            <textarea name="note" id="note" class="form-control" rows="3" x-model="note"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="placeholder">Placeholder</label>
                            <input type="text" name="placeholder" id="placeholder" class="form-control" x-model="placeholder">
                        </div>
                        <div class="form-group mb-3">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" x-model="type" required>
                                <option>- Pilih - </option>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="textarea">Textarea</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="form-check-input form-check-primary" id="isRequired" x-model="isRequired">
                                <label class="form-check-label" for="isRequired">Wajib Diisi</label>
                            </div>
                        </div>
                        <template x-if="isRequired">
                            <div class="p-1">
                                <div class="form-group mb-3">
                                    <label for="invalid-feedback">Invalid Feedback Message</label>
                                    <input type="text" name="invalid-feedback" id="invalid-feedback" x-model="invalidFeedbackMessage"
                                        class="form-control" required>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="col-md-7">
                        <h5>Preview</h5>
                        <div class="d-flex flex-column justify-content-center" style="height: 400px; border-radius: 10px; background: #E9EEFF; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); padding: 20px;">
                            <b><span id="preview_position" x-text="position">#</span>.<span id="preview_title" x-text="title">MASUKAN JUDUL</span></b>
                            <div class="alert alert-secondary" role="alert">
                                <p id="preview_note" x-text="note" style="white-space: pre;">MASUKAN NOTE</p>
                                <div class="col">
                                    <input :type="type" id="laju_buang_cepat" name="replaceSpaceWithUnderscore(title)" class="form-control" :placeholder="placeholder" :required="isRequired">
                                    <div class="invalid-feedback" x-text="invalidFeedbackMessage">

                                    </div>
                                </div>
                            </div>
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
