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
                            <h5 class="card-title">Ubah Kategori</h5>

                            <p class="card-text">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="id_ekspedisi036" class="form-label">ID Ekspedisi</label>
                                    <input type="text" class="form-control" name="id_ekspedisi036" id="id_ekspedisi036" value="<?= $ekspedisi036['id_ekspedisi036'] ?>" aria-describedby="ID Ekspedisi" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_ekspedisi036" class="form-label">Nama Ekspedisi</label>
                                    <input type="text" class="form-control" name="nama_ekspedisi036" id="nama_ekspedisi036" value="<?= $ekspedisi036['nama_ekspedisi036'] ?>" aria-describedby="Nama Ekspedisi">
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_layanan036" class="form-label">Jenis Layanan</label>
                                    <input type="text" class="form-control" name="jenis_layanan036" id="jenis_layanan036" value="<?= $ekspedisi036['jenis_layanan036'] ?>" aria-describedby="Jenis Layanan">
                                </div>
                                <div class="mb-3">
                                    <label for="tarif_perkg036" class="form-label">Tarif Per KG</label>
                                    <input type="number" class="form-control" name="tarif_perkg036" id="tarif_perkg036" value="<?= $ekspedisi036['tarif_perkg036'] ?>" aria-describedby="Tarif Per KG">
                                </div>
                                <div class="mb-3">
                                    <label for="status036" class="form-label">Status</label>
                                    <select name="status036" id="status036" class="form-control">
                                        <option value="aktif" <?= ($ekspedisi036['status036'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                                        <option value="non-aktif" <?= ($ekspedisi036['status036'] == 'non-aktif') ? 'selected' : '' ?>>Non-Aktif</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="<?= base_url('admin/ekspedisi036') ?>" class="btn btn-danger">Kembali</a>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-content -->
</div>
<!-- /.content-wrapper -->
