<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Penilaian</h2>
    <a href="<?php echo base_url('hasil/hitung'); ?>" class="btn btn-success">
        <i class="bi bi-calculator"></i> Hitung SMART
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-clipboard-check"></i> Daftar Penilaian Mahasiswa</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($mahasiswa)): ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">NIM</th>
                            <th rowspan="2" class="align-middle">Nama</th>
                            <th colspan="<?php echo count($kriteria); ?>" class="text-center">Kriteria</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <?php foreach ($kriteria as $k): ?>
                                <th class="text-center">
                                    <small><?php echo $k->nama_kriteria; ?><br>
                                    <span class="badge bg-secondary"><?php echo $k->bobot; ?>%</span></small>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($mahasiswa as $m): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $m->nim; ?></td>
                                <td><strong><?php echo $m->nama; ?></strong></td>
                                <?php 
                                $penilaian_mhs = isset($penilaian[$m->id_mahasiswa]) ? $penilaian[$m->id_mahasiswa] : array();
                                $nilai_map = array();
                                foreach ($penilaian_mhs as $p) {
                                    $nilai_map[$p->id_kriteria] = $p->nilai;
                                }
                                foreach ($kriteria as $k): 
                                    $nilai = isset($nilai_map[$k->id_kriteria]) ? $nilai_map[$k->id_kriteria] : null;
                                ?>
                                    <td class="text-center">
                                        <?php if ($nilai !== null): ?>
                                            <span class="badge bg-success"><?php echo number_format($nilai, 2); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">-</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <td>
                                    <a href="<?php echo base_url('penilaian/nilai/'.$m->id_mahasiswa); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Input Nilai
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Belum ada data mahasiswa. Silakan tambah mahasiswa terlebih dahulu.
            </div>
        <?php endif; ?>
    </div>
</div>

