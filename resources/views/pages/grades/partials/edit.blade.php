<div class="modal fade" id="editModal{{ $grade->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" name="criteria_id" value="{{ $criteria->id }}" hidden>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="student_id" class="form-label">Siswa <span class="text-danger">*</span></label>
                            <input type="text" id="student_id" name="student_id" class="form-control" value="{{ $grade->student->name }}" disabled>
                        </div>
                        <div class="col mb-3">
                            <label for="grade" class="form-label">Nilai <span class="text-danger">*</span></label>
                            <input type="number" id="grade" name="grade" class="form-control"
                                placeholder="Masukkan Nilai Siswa" value="{{ $grade->grade }}" required />
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
