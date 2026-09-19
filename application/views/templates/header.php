<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - ' : ''; ?>Sistem Keputusan Beasiswa SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3">
                    <h4 class="text-white mb-4">
                        <i class="bi bi-award"></i> SMART Beasiswa
                    </h4>
                    <nav class="nav flex-column">
                        <a class="nav-link <?php echo (uri_string() == 'dashboard' || uri_string() == '') ? 'active' : ''; ?>" href="<?php echo base_url('dashboard'); ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a class="nav-link <?php echo (strpos(uri_string(), 'kriteria') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('kriteria'); ?>">
                            <i class="bi bi-list-check"></i> Kriteria
                        </a>
                        <a class="nav-link <?php echo (strpos(uri_string(), 'mahasiswa') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('mahasiswa'); ?>">
                            <i class="bi bi-people"></i> Mahasiswa
                        </a>
                        <a class="nav-link <?php echo (strpos(uri_string(), 'penilaian') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('penilaian'); ?>">
                            <i class="bi bi-clipboard-check"></i> Penilaian
                        </a>
                        <a class="nav-link <?php echo (strpos(uri_string(), 'hasil') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('hasil'); ?>">
                            <i class="bi bi-graph-up"></i> Hasil
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <div class="p-4">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                <?php foreach ($this->session->flashdata('errors') as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

