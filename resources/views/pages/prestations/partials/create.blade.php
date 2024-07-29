<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Prestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prestations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="branch" class="form-label">Cabang Perlombaan <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="branch" name="branch" class="form-control"
                                placeholder="Masukkan Nama Cabang Perlombaan" required />
                        </div>
                        <div class="col mb-3">
                            <label for="level" class="form-label">Tingkat <span class="text-danger">*</span></label>
                            <select name="level" id="level" class="form-select" required>
                                <option disabled selected>Pilih Tingkat</option>
                                <option value="Nasional">Tingkat Nasional</option>
                                <option value="Provinsi">Tingkat Provinsi</option>
                                <option value="Kabupaten">Tingkat Kabupaten</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="image" class="form-label">Bukti</label>
                            <input class="form-control" type="file" id="image" name="image" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
