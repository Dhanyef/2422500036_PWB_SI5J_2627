
<!-- Content Wrapper -->
<div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Produk</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" enctype="multipart/form-data">

                                <!-- Nama Produk -->
                    <div class="mb-3">
    <label for="nama_produk" class="form-label">Judul Buku</label>

    <input type="text"
        class="form-control"
        name="nama_produk"
        id="nama_produk"
        value="<?= html_escape(set_value('nama_produk', $produk['nama'])) ?>">

    <small class="text-danger">
        <?= form_error('nama_produk') ?>
    </small>
</div>

                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label for="kategori_produk" class="form-label">Kategori</label>

                                    <select class="form-select" name="kategori_produk" id="kategori_produk">
                                        <option value="">-- pilih kategori --</option>

                                        <?php foreach ($list_kategori as $kategori) : ?>
                                            <option
                                                value="<?= $kategori['id_kategori'] ?>"
                                                <?= set_select(
                                                    'kategori_produk',
                                                    $kategori['id_kategori'],
                                                    $produk['id_kategori'] == $kategori['id_kategori']
                                                ) ?>>
                                                <?= html_escape($kategori['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <small class="text-danger">
                                        <?= form_error('kategori_produk') ?>
                                    </small>
                                </div>

                                <!-- Harga -->
                                <div class="mb-3">
                                    <label for="harga_produk" class="form-label">Harga</label>

                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number"
                                            name="harga_produk"
                                            id="harga_produk"
                                            class="form-control"
                                            value="<?= html_escape(set_value('harga_produk', $produk['harga'])) ?>">
                                    </div>
                                </div>

                                <!-- Stok -->
                                <div class="mb-3">
                                    <label for="stok_produk" class="form-label">Stok</label>

                                    <input type="number"
                                        class="form-control"
                                        name="stok_produk"
                                        id="stok_produk"
                                        value="<?= html_escape(set_value('stok_produk', $produk['stok'])) ?>">

                                    <small class="text-danger">
                                        <?= form_error('stok_produk') ?>
                                    </small>
                                </div>

                                <!-- Penerbit -->
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>

                                    <input type="text"
                                        class="form-control"
                                        name="penerbit"
                                        id="penerbit"
                                        value="<?= html_escape(set_value('penerbit', $produk['penerbit'])) ?>">

                                    <small class="text-danger">
                                        <?= form_error('penerbit') ?>
                                    </small>
                                </div>

                                <!-- Tahun Terbit -->
                                <div class="mb-3">
                                    <label for="tahunterbit" class="form-label">Tahun Terbit</label>

                                    <input type="number"
                                        class="form-control"
                                        name="tahunterbit"
                                        id="tahunterbit"
                                        min="1900"
                                        max="2099"
                                        value="<?= html_escape(set_value('tahunterbit', $produk['tahunterbit'])) ?>">

                                    <small class="text-danger">
                                        <?= form_error('tahunterbit') ?>
                                    </small>
                                </div>

                                <!-- ISBN -->
                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>

                                    <input type="text"
                                        class="form-control"
                                        name="isbn"
                                        id="isbn"
                                        value="<?= html_escape(set_value('isbn', $produk['isbn'])) ?>">

                                    <small class="text-danger">
                                        <?= form_error('isbn') ?>
                                    </small>
                                </div>

                                <!-- Tambah Gambar -->
                                <div class="mb-3">
                                    <label for="gambar_produk" class="form-label">Tambah Gambar Produk</label>

                                    <input class="form-control"
                                        type="file"
                                        id="gambar_produk"
                                        name="gambar_produk[]"
                                        accept="image/*"
                                        multiple>
                                </div>

                                <!-- Daftar Gambar -->
                                <?php
                                $list_gambar = $gambar_model->get_by_id_produk($produk['id_produk']);
                                ?>

                                <div class="row mb-3">
                                    <?php foreach ($list_gambar as $gambar) : ?>

                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                            <div class="card h-100">

                                                <img
                                                    src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>"
                                                    class="card-img-top"
                                                    style="height: 180px; object-fit: contain;"
                                                    id="preview-<?= $gambar['id_gambar'] ?>">

                                                <div class="card-body d-grid gap-2">

                                                    <input
                                                        type="file"
                                                        class="d-none input-ganti-gambar"
                                                        accept="image/*"
                                                        name="ganti_gambar[<?= $gambar['id_gambar'] ?>]"
                                                        id="ganti-<?= $gambar['id_gambar'] ?>"
                                                        data-preview="preview-<?= $gambar['id_gambar'] ?>">

                                                    <button
                                                        type="button"
                                                        class="btn btn-warning btn-ganti-gambar"
                                                        data-target="ganti-<?= $gambar['id_gambar'] ?>">
                                                        Ganti
                                                    </button>

                                                    <small
                                                        class="text-muted text-center d-none"
                                                        id="info-ganti-<?= $gambar['id_gambar'] ?>">
                                                    </small>

                                                    <a
                                                        href="<?= base_url('admin/produk/hapus_gambar/' . $produk['id_produk']) ?>"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus seluruh gambar produk ini?')">
                                                        Hapus
                                                    </a>

                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </div>

                                <!-- Sinopsis -->
                                <div class="mb-3">
                                    <label for="sinopsis_produk" class="form-label">Sinopsis</label>

                                    <textarea
                                        name="sinopsis_produk"
                                        id="sinopsis_produk"
                                        rows="4"
                                        class="form-control"
                                        style="resize: vertical;"><?= html_escape(set_value('sinopsis_produk', $produk['sinopsis'])) ?></textarea>

                                    <small class="text-danger">
                                        <?= form_error('sinopsis_produk') ?>
                                    </small>
                                </div>

                                <!-- Tombol -->
                                <button type="submit" class="btn btn-primary">
                                    Ubah
                                </button>

                                <a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">
                                    Kembali
                                </a>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Preview Gambar -->
<script>
    // Tombol ganti gambar
    document.querySelectorAll('.btn-ganti-gambar').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById(btn.dataset.target).click();
        });
    });

    // Preview gambar baru
    document.querySelectorAll('.input-ganti-gambar').forEach(function(input) {
        input.addEventListener('change', function() {
            var file = input.files[0];
            var info = document.getElementById('info-' + input.id);

            if (!file) {
                info.classList.add('d-none');
                return;
            }

            document.getElementById(input.dataset.preview).src =
                URL.createObjectURL(file);

            info.textContent = 'Gambar baru: ' + file.name +
                ' (klik Ubah untuk menyimpan)';

            info.classList.remove('d-none');
        });
    });
</script>
