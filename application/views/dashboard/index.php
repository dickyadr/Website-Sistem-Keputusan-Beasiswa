<h2 class="mb-4">Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Kriteria</h5>
                        <h2><?php echo $total_kriteria; ?></h2>
                    </div>
                    <i class="bi bi-list-check" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('kriteria'); ?>" class="text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Mahasiswa</h5>
                        <h2><?php echo $total_mahasiswa; ?></h2>
                    </div>
                    <i class="bi bi-people" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('mahasiswa'); ?>" class="text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Top 5 Peringkat</h5>
                        <h2><?php echo count($top_hasil); ?></h2>
                    </div>
                    <i class="bi bi-trophy" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('hasil'); ?>" class="text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-trophy"></i> Top 5 Peringkat Beasiswa</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($top_hasil)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Total Nilai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($top_hasil as $hasil): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-warning text-dark">#<?php echo $hasil->ranking; ?></span>
                                </td>
                                <td><?php echo $hasil->nim; ?></td>
                                <td><?php echo $hasil->nama; ?></td>
                                <td><strong><?php echo number_format($hasil->total_nilai, 4); ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php echo $hasil->status == 'Lulus' ? 'success' : 'danger'; ?>">
                                        <?php echo $hasil->status; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('hasil/detail/'.$hasil->id_mahasiswa); ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Belum ada hasil perhitungan. Silakan lakukan perhitungan terlebih dahulu.
            </div>
        <?php endif; ?>
    </div>
</div>

