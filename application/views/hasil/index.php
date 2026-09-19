<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Hasil Perhitungan SMART</h2>
    <div class="d-flex gap-2">
        <a href="<?php echo base_url('hasil/hitung'); ?>" class="btn btn-success">
            <i class="bi bi-calculator"></i> Hitung Ulang
        </a>
        <a href="<?php echo base_url('hasil/cetak'); ?>" target="_blank" class="btn btn-info">
            <i class="bi bi-printer"></i> Cetak
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Ranking Hasil Beasiswa</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($hasil)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>IPK</th>
                            <th>Total Nilai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hasil as $h): ?>
                            <tr>
                                <td>
                                    <?php if ($h->ranking <= 3): ?>
                                        <span class="badge bg-warning text-dark" style="font-size: 1rem;">
                                            <i class="bi bi-trophy"></i> #<?php echo $h->ranking; ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">#<?php echo $h->ranking; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $h->nim; ?></td>
                                <td><strong><?php echo $h->nama; ?></strong></td>
                                <td><?php echo $h->jurusan; ?></td>
                                <td><?php echo $h->ipk ? number_format($h->ipk, 2) : '-'; ?></td>
                                <td><strong><?php echo number_format($h->total_nilai, 4); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php echo $h->status == 'Lulus' ? 'success' : 'danger'; ?>">
                                        <?php echo $h->status; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('hasil/detail/'.$h->id_mahasiswa); ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Belum ada hasil perhitungan. 
                Pastikan semua mahasiswa sudah dinilai, kemudian klik tombol "Hitung SMART".
            </div>
        <?php endif; ?>
    </div>
</div>

