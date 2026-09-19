<h2 class="mb-4">Input Penilaian - <?php echo $mahasiswa->nama; ?></h2>

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>NIM:</strong> <?php echo $mahasiswa->nim; ?></p>
                <p><strong>Jurusan:</strong> <?php echo $mahasiswa->jurusan; ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Semester:</strong> <?php echo $mahasiswa->semester; ?></p>
                <p><strong>IPK:</strong> <?php echo $mahasiswa->ipk ? number_format($mahasiswa->ipk, 2) : '-'; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-clipboard-check"></i> Form Penilaian</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo base_url('penilaian/nilai/'.$mahasiswa->id_mahasiswa); ?>">
            <input type="hidden" name="id_mahasiswa" value="<?php echo $mahasiswa->id_mahasiswa; ?>">
            
            <?php foreach ($kriteria as $index => $k): 
                $nilai_existing = isset($existing_nilai[$k->id_kriteria]) ? $existing_nilai[$k->id_kriteria] : '';
            ?>
                <div class="mb-4 p-3 border rounded">
                    <input type="hidden" name="id_kriteria[]" value="<?php echo $k->id_kriteria; ?>">
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h6 class="mb-0"><?php echo $k->nama_kriteria; ?></h6>
                            <small class="text-muted">
                                Bobot: <?php echo $k->bobot; ?>% | 
                                Tipe: <span class="badge bg-<?php echo $k->tipe == 'benefit' ? 'success' : 'danger'; ?>">
                                    <?php echo $k->tipe == 'benefit' ? 'Benefit' : 'Cost'; ?>
                                </span>
                            </small>
                        </div>
                    </div>
                    
                    <?php if ($k->keterangan): ?>
                        <p class="text-muted small mb-2"><?php echo $k->keterangan; ?></p>
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nilai_<?php echo $k->id_kriteria; ?>" class="form-label">Nilai <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" 
                                   id="nilai_<?php echo $k->id_kriteria; ?>" 
                                   name="nilai[]" 
                                   value="<?php echo $nilai_existing; ?>" 
                                   required>
                            <small class="text-muted">
                                <?php if ($k->tipe == 'benefit'): ?>
                                    Semakin besar nilai semakin baik
                                <?php else: ?>
                                    Semakin kecil nilai semakin baik
                                <?php endif; ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Penilaian
                </button>
                <a href="<?php echo base_url('penilaian'); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

