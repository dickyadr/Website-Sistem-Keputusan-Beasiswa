<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Mahasiswa</h2>
    <a href="<?php echo base_url('mahasiswa/create'); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-people"></i> Daftar Mahasiswa</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($mahasiswa)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Semester</th>
                            <th>IPK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($mahasiswa as $m): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $m->nim; ?></td>
                                <td><strong><?php echo $m->nama; ?></strong></td>
                                <td><?php echo $m->jurusan; ?></td>
                                <td><?php echo $m->semester; ?></td>
                                <td><?php echo $m->ipk ? number_format($m->ipk, 2) : '-'; ?></td>
                                <td>
                                    <a href="<?php echo base_url('penilaian/nilai/'.$m->id_mahasiswa); ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-clipboard-check"></i> Nilai
                                    </a>
                                    <a href="<?php echo base_url('mahasiswa/edit/'.$m->id_mahasiswa); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?php echo base_url('mahasiswa/delete/'.$m->id_mahasiswa); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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
                <i class="bi bi-info-circle"></i> Belum ada data mahasiswa. Silakan tambah mahasiswa terlebih dahulu.
            </div>
        <?php endif; ?>
    </div>
</div>

