<div class="modal fade" id="createModal{{ $criteria->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Penilaian ({{ $criteria->name }})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="criteria_id" value="{{ $criteria->id }}" hidden>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="student_id" class="form-label">Siswa <span class="text-danger">*</span></label>
                            <select name="student_id" id="student_id" class="form-select" required>
                                <option disabled selected>Pilih Siswa</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} - Kelas {{ $student->class }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="grade" class="form-label">Nilai <span class="text-danger">*</span></label>
                            <input type="number" id="grade" name="grade" class="form-control"
                                placeholder="Masukkan Nilai Siswa" required />
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
