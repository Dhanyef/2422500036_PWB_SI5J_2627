
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
                <h5 class="card-title">Ubah Ekspedisi</h5>
              <p class="card-text">
                <form method="post">
                  <div class="mb-3">
                  <label for="jenis_layanan036" class="form-label">Nama Ekspedisi</label>
                  <select class="form-control" name="nama_ekspedisi036" id="nama_ekspedisi036" required>
                    <option value="">-- Pilih Jenis Layanan --</option>
                    <option value="JNT">JNT</option>
                    <option value="JNE">JNE</option>
                    <option value="SPX">SPX</option>
                  </select>
                </div>

                 <div class="mb-3">
                  <label for="jenis_layanan036" class="form-label">Jenis Layanan</label>
                  <select class="form-control" name="jenis_layanan036" id="jenis_layanan036" required>
                    <option value="">-- Pilih Jenis Layanan --</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Cargo">Cargo</option>
                    <option value="Express">Express</option>
                  </select>
                </div>

                  <div class="mb-3">
                    <label for="tarif_perkg036" class="form-label">Tarif Per KG</label>
                    <input type="number" name="tarif_perkg036" id="tarif_perkg036" class="form-control" value="<?= html_escape($ekspedisi['tarif_perkg036']) ?>">
                    <?= form_error('tarif_perkg036', '<small class="text-danger">', '</small>') ?>
                  </div>

                  <div class="mb-3">
                  <label for="status036" class="form-label">Status</label>
                  <select class="form-control" name="status036" id="status036" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
                </div>

                  <button type="submit" class="btn btn-primary">Ubah</button>
                  <a href="<?= base_url('admin/ekspedisi036') ?>" class="btn btn-danger">Kembali</a>
                </form>
              </p>
            </div>
          </div>

        </div>
        <!-- /.col-md-6 -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
