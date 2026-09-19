<h2 class="mb-4">Detail Hasil Perhitungan - <?php echo $mahasiswa->nama; ?></h2>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-person"></i> Data Mahasiswa</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>NIM:</strong> <?php echo $mahasiswa->nim; ?></p>
                <p><strong>Nama:</strong> <?php echo $mahasiswa->nama; ?></p>
                <p><strong>Jurusan:</strong> <?php echo $mahasiswa->jurusan; ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Semester:</strong> <?php echo $mahasiswa->semester; ?></p>
                <p><strong>IPK:</strong> <?php echo $mahasiswa->ipk ? number_format($mahasiswa->ipk, 2) : '-'; ?></p>
                <p><strong>Alamat:</strong> <?php echo $mahasiswa->alamat; ?></p>
            </div>
        </div>
    </div>
</div>

<?php if ($hasil): ?>
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Hasil Perhitungan</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center p-3 bg-primary text-white rounded">
                    <h6>Total Nilai</h6>
                    <h2><?php echo number_format($hasil->total_nilai, 4); ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-3 bg-warning text-dark rounded">
                    <h6>Ranking</h6>
                    <h2>#<?php echo $hasil->ranking; ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-3 bg-<?php echo $hasil->status == 'Lulus' ? 'success' : 'danger'; ?> text-white rounded">
                    <h6>Status</h6>
                    <h2><?php echo $hasil->status; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-list-check"></i> Detail Perhitungan per Kriteria</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($detail['detail'])): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Nilai Awal</th>
                            <th>Nilai Normalisasi</th>
                            <th>Bobot Normalisasi</th>
                            <th>Skor Terbobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail['detail'] as $d): ?>
                            <tr>
                                <td><strong><?php echo $d['kriteria']; ?></strong></td>
                                <td><?php echo number_format($d['nilai_awal'], 2); ?></td>
                                <td><?php echo number_format($d['nilai_normalisasi'], 4); ?></td>
                                <td><?php echo number_format($d['bobot'], 4); ?></td>
                                <td><strong><?php echo number_format($d['skor_terbobot'], 4); ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-primary">
                            <td colspan="4" class="text-end"><strong>TOTAL NILAI:</strong></td>
                            <td><strong><?php echo number_format($detail['total_nilai'], 4); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Belum ada detail perhitungan.
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="mt-3">
    <a href="<?php echo base_url('hasil'); ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

