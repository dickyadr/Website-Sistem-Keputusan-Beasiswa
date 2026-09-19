<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Kriteria</h2>
    <a href="<?php echo base_url('kriteria/create'); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kriteria
    </a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <h5>Total Bobot: <span class="badge bg-<?php echo $total_bobot == 100 ? 'success' : 'warning'; ?>"><?php echo number_format($total_bobot, 2); ?>%</span></h5>
        <?php if ($total_bobot != 100): ?>
            <small class="text-muted">Total bobot harus 100% untuk perhitungan yang optimal</small>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-list-check"></i> Daftar Kriteria</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($kriteria)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot (%)</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($kriteria as $k): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $k->nama_kriteria; ?></strong></td>
                                <td><?php echo number_format($k->bobot, 2); ?>%</td>
                                <td>
                                    <span class="badge bg-<?php echo $k->tipe == 'benefit' ? 'success' : 'danger'; ?>">
                                        <?php echo $k->tipe == 'benefit' ? 'Benefit' : 'Cost'; ?>
                                    </span>
                                </td>
                                <td><?php echo $k->keterangan; ?></td>
                                <td>
                                    <a href="<?php echo base_url('kriteria/edit/'.$k->id_kriteria); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?php echo base_url('kriteria/delete/'.$k->id_kriteria); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Belum ada data kriteria. Silakan tambah kriteria terlebih dahulu.
            </div>
        <?php endif; ?>
    </div>
</div>

