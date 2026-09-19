<h2 class="mb-4">Tambah Kriteria</h2>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Form Tambah Kriteria</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo base_url('kriteria/create'); ?>">
            <div class="mb-3">
                <label for="nama_kriteria" class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" required>
                <?php echo form_error('nama_kriteria', '<div class="text-danger">', '</div>'); ?>
            </div>
            
            <div class="mb-3">
                <label for="bobot" class="form-label">Bobot (%) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" id="bobot" name="bobot" required>
                <small class="text-muted">Masukkan bobot dalam persentase (contoh: 30.00)</small>
                <?php echo form_error('bobot', '<div class="text-danger">', '</div>'); ?>
            </div>
            
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe Kriteria <span class="text-danger">*</span></label>
                <select class="form-select" id="tipe" name="tipe" required>
                    <option value="benefit">Benefit (Semakin besar semakin baik)</option>
                    <option value="cost">Cost (Semakin kecil semakin baik)</option>
                </select>
                <?php echo form_error('tipe', '<div class="text-danger">', '</div>'); ?>
            </div>
            
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="<?php echo base_url('kriteria'); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

