<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Starter Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Ekspedisi</h5>
                            
                            <div class="mb-3">
                                <a href="<?php echo base_url('admin/ekspedisi036/tambah'); ?>" class="btn btn-primary">
                                    <span class="btn-label">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Ekspedisi
                                </a>
                            </div>

                            <?php if ($this->session->flashdata('message')) : ?>
                                <?= $this->session->flashdata('message') ?>
                            <?php endif ?>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ekspedisi</th>
                                        <th>Jenis Layanan</th>
                                        <th>Tarif Per KG</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($list_ekspedisi as $ekspedisi036) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $ekspedisi036['nama_ekspedisi036'] ?></td>
                                            <td><?= $ekspedisi036['jenis_layanan036'] ?></td>
                                            <td><?= $ekspedisi036['tarif_perkg036'] ?></td>
                                            <td><?= $ekspedisi036['status036'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/ekspedisi036/ubah/' . $ekspedisi036['id_ekspedisi036']) ?>">
                                                    <span class="badge bg-success">Ubah</span>
                                                </a>
                                                <a href="<?= base_url('admin/ekspedisi036/hapus/' . $ekspedisi036['id_ekspedisi036']) ?>" onclick="return confirm('Yakin ingin menghapus data ekspedisi ini?')">
                                                    <span class="badge bg-danger">Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $no++; endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
