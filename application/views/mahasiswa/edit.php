<h2 class="mb-4">Edit Mahasiswa</h2>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-pencil"></i> Form Edit Mahasiswa</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo base_url('mahasiswa/edit/'.$mahasiswa->id_mahasiswa); ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $mahasiswa->nim; ?>" required>
                    <?php echo form_error('nim', '<div class="text-danger">', '</div>'); ?>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $mahasiswa->nama; ?>" required>
                    <?php echo form_error('nama', '<div class="text-danger">', '</div>'); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $mahasiswa->jurusan; ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" class="form-control" id="semester" name="semester" value="<?php echo $mahasiswa->semester; ?>" min="1" max="14">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ipk" class="form-label">IPK</label>
                    <input type="number" step="0.01" class="form-control" id="ipk" name="ipk" value="<?php echo $mahasiswa->ipk; ?>" min="0" max="4">
                    <?php echo form_error('ipk', '<div class="text-danger">', '</div>'); ?>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $mahasiswa->no_hp; ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $mahasiswa->alamat; ?></textarea>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="<?php echo base_url('mahasiswa'); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

