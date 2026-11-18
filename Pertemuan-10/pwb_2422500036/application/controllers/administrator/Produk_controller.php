
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_admin_logged_in();

        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');
    }

    // Menampilkan daftar produk
    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all_produk();

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // Menambahkan produk
    public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';

        $this->form_validation->set_rules(
            'nama_produk',
            'Nama produk',
            'required'
        );

        $this->form_validation->set_rules(
            'kategori_produk',
            'Kategori',
            'required'
        );

        if ($this->form_validation->run() !== FALSE) {
            $this->_simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();

            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    // Menyimpan produk baru
    private function _simpan_produk()
    {
        $data = [
            'nama'         => ucwords($this->input->post('nama_produk')),
            'id_kategori'  => $this->input->post('kategori_produk'),
            'harga'        => $this->input->post('harga_produk'),
            'stok'         => $this->input->post('stok_produk'),
            'sinopsis'     => ucfirst($this->input->post('sinopsis_produk')),
            'penerbit'     => $this->input->post('penerbit'),
            'tahunterbit'  => $this->input->post('tahunterbit'),
            'isbn'         => $this->input->post('isbn')
        ];

        $id_produk = $this->produk_model->tambah($data);

        if (!empty($_FILES['gambar_produk']['name'][0])) {
            $count = count($_FILES['gambar_produk']['name']);

            $errors = $this->_produk_gambar_upload($count, $id_produk);

            if (!empty($errors)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">
                        Produk tersimpan, tetapi gambar gagal diunggah:<br>'
                        . implode('<br>', $errors) .
                    '</div>'
                );

                redirect('admin/produk');
                return;
            }
        }

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">
                Berhasil menambahkan produk!
            </div>'
        );

        redirect('admin/produk');
    }

    // Upload beberapa gambar produk
    private function _produk_gambar_upload($count, $id_produk)
    {
        $errors = [];

        $folder = './uploads/produk/';

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $this->load->library('upload');

        for ($i = 0; $i < $count; $i++) {

            if (
                empty($_FILES['gambar_produk']['name'][$i]) ||
                $_FILES['gambar_produk']['error'][$i] == UPLOAD_ERR_NO_FILE
            ) {
                continue;
            }

            $_FILES['file'] = [
                'name'     => $_FILES['gambar_produk']['name'][$i],
                'type'     => $_FILES['gambar_produk']['type'][$i],
                'tmp_name' => $_FILES['gambar_produk']['tmp_name'][$i],
                'error'    => $_FILES['gambar_produk']['error'][$i],
                'size'     => $_FILES['gambar_produk']['size'][$i]
            ];

            $config = [
                'upload_path'   => $folder,
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 5000,
                'file_name'     => 'produk-' . $id_produk . '-' . $i
            ];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {

                $uploadData = $this->upload->data();

                $data = [
                    'nama_gambar' => $uploadData['file_name'],
                    'id_produk'   => $id_produk
                ];

                $this->produk_gambar_model->tambah($data);

            } else {
                $errors[] = $_FILES['gambar_produk']['name'][$i]
                    . ': ' . $this->upload->display_errors('', '');
            }
        }

        return $errors;
    }

    // Mengubah produk
    public function ubah_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);

        if ($produk) {

            $this->form_validation->set_rules(
                'nama_produk',
                'Nama produk',
                'required'
            );

            $this->form_validation->set_rules(
                'kategori_produk',
                'Kategori',
                'required'
            );

            if ($this->form_validation->run() !== FALSE) {

                $this->__ubah_produk($id);

            } else {

                $data['title'] = 'Ubah Produk';
                $data['produk'] = $produk;
                $data['list_kategori'] = $this->produk_kategori_model->get_all();
                $data['gambar_model'] = $this->produk_gambar_model;

                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }

        } else {

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">
                    Produk tidak ditemukan!
                </div>'
            );

            redirect('admin/produk');
        }
    }

    // Proses update produk
    private function __ubah_produk($id)
    {
        $data = [
            'nama'         => ucwords($this->input->post('nama_produk')),
            'id_kategori'  => $this->input->post('kategori_produk'),
            'harga'        => $this->input->post('harga_produk'),
            'stok'         => $this->input->post('stok_produk'),
            'sinopsis'     => ucfirst($this->input->post('sinopsis_produk')),
            'penerbit'     => $this->input->post('penerbit'),
            'tahunterbit'  => $this->input->post('tahunterbit'),
            'isbn'         => $this->input->post('isbn')
        ];

        $ubah = $this->produk_model->ubah($data, $id);

        $this->load->library('upload');

        // Mengganti gambar lama
        $hasil_ganti = $this->_ganti_gambar($id);

        // Menambahkan gambar baru
        if (!empty($_FILES['gambar_produk']['name'][0])) {

            $count = count($_FILES['gambar_produk']['name']);

            $err_baru = $this->_produk_gambar_upload($count, $id);

            $hasil_ganti['errors'] = array_merge(
                $hasil_ganti['errors'],
                $err_baru
            );
        }

        if (!empty($hasil_ganti['errors'])) {

            $pesan_error = implode('<br>', $hasil_ganti['errors']);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">
                    Gagal mengunggah/mengganti gambar:<br>'
                    . $pesan_error .
                '</div>'
            );

        } elseif ($ubah || $hasil_ganti['berhasil'] > 0) {

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">
                    Berhasil mengubah produk!
                </div>'
            );

        } else {

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">
                    Gagal mengubah produk!
                </div>'
            );
        }

        redirect('admin/produk');
    }

    // Mengganti gambar lama
    private function _ganti_gambar($id_produk)
    {
        $hasil = [
            'berhasil' => 0,
            'errors'   => []
        ];

        if (
            empty($_FILES['ganti_gambar']['name']) ||
            !is_array($_FILES['ganti_gambar']['name'])
        ) {
            return $hasil;
        }

        $folder = './uploads/produk/';

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        foreach ($_FILES['ganti_gambar']['name'] as $id_gambar => $nama) {

            if (
                empty($nama) ||
                $_FILES['ganti_gambar']['error'][$id_gambar] == UPLOAD_ERR_NO_FILE
            ) {
                continue;
            }

            $gambar_lama = $this->produk_gambar_model->get_by_id($id_gambar);

            if (
                !$gambar_lama ||
                $gambar_lama['id_produk'] != $id_produk
            ) {
                continue;
            }

            $_FILES['file'] = [
                'name'     => $_FILES['ganti_gambar']['name'][$id_gambar],
                'type'     => $_FILES['ganti_gambar']['type'][$id_gambar],
                'tmp_name' => $_FILES['ganti_gambar']['tmp_name'][$id_gambar],
                'error'    => $_FILES['ganti_gambar']['error'][$id_gambar],
                'size'     => $_FILES['ganti_gambar']['size'][$id_gambar]
            ];

            $config = [
                'upload_path'   => $folder,
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 5000,
                'file_name'     => 'produk-' . $id_produk . '-' . $id_gambar . '-' . time()
            ];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {

                $file_baru = $this->upload->data('file_name');

                $this->produk_gambar_model->ubah(
                    ['nama_gambar' => $file_baru],
                    $id_gambar
                );

                $path_lama = $folder . $gambar_lama['nama_gambar'];

                if (is_file($path_lama)) {
                    unlink($path_lama);
                }

                $hasil['berhasil']++;

            } else {

                $hasil['errors'][] = $nama . ': '
                    . $this->upload->display_errors('', '');
            }
        }

        return $hasil;
    }

    // Menghapus gambar produk
    public function hapus_gambar($id)
    {
        $gambar = $this->produk_gambar_model->get_by_id_produk($id);

        if ($gambar) {

            foreach ($gambar as $item) {

                $path = './uploads/produk/' . $item['nama_gambar'];

                if (is_file($path)) {
                    unlink($path);
                }

                $this->produk_gambar_model->hapus($item['id_gambar']);
            }

            $this->session->set_flashdata(
                'success',
                'Gambar berhasil dihapus.'
            );

        } else {

            $this->session->set_flashdata(
                'error',
                'Gambar tidak ditemukan.'
            );
        }

        redirect('admin/produk/ubah/' . $id);
    }

    // Menghapus produk beserta seluruh gambarnya
    public function hapus_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);

        if ($produk) {

            $list_gambar = $this->produk_gambar_model->get_by_id_produk($id);

            if (!empty($list_gambar)) {

                foreach ($list_gambar as $gambar) {

                    $id_gambar = $gambar['id_gambar'];
                    $nama_gambar = $gambar['nama_gambar'];

                    $path = './uploads/produk/' . $nama_gambar;

                    if (is_file($path)) {
                        unlink($path);
                    }

                    $this->produk_gambar_model->hapus($id_gambar);
                }
            }

            $this->produk_model->hapus($id);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">
                    Berhasil menghapus produk!
                </div>'
            );

        } else {

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">
                    Produk tidak ditemukan!
                </div>'
            );
        }

        redirect('admin/produk');
    }
}
