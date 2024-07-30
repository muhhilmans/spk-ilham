<div class="modal fade" id="editModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan Nama Lengkap Siswa" value="{{ $student->user->name }}" required
                                disabled />
                            <input type="text" id="user_id" name="user_id" class="form-control"
                                value="{{ $student->user_id }}" hidden>
                        </div>
                        <div class="col mb-3">
                            <label for="class" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select name="class" id="class" class="form-select" required>
                                <option disabled selected>Pilih Kelas Siswa</option>
                                <option value="10" {{ old('class', $student->class) == '10' ? 'selected' : '' }}>10
                                </option>
                                <option value="11" {{ old('class', $student->class) == '11' ? 'selected' : '' }}>11
                                </option>
                                <option value="12" {{ old('class', $student->class) == '12' ? 'selected' : '' }}>12
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                            <input type="number" id="nis" name="nis" class="form-control"
                                placeholder="Masukkan NIS Siswa" value="{{ $student->nis }}" maxlength="16" required />
                        </div>
                        <div class="col mb-3">
                            <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                            <input type="number" id="nisn" name="nisn" class="form-control"
                                placeholder="Masukkan NISN Siswa" value="{{ $student->nisn }}" maxlength="10" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
