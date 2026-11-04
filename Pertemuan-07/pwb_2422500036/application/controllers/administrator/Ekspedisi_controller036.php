
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspedisi_controller036 extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('ekspedisi_model036');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['list_ekspedisi'] = $this->ekspedisi_model036->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/ekspedisi036/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_ekspedisi()
    {
        $data['title'] = 'Tambah ekspedisi';

        $this->form_validation->set_rules('nama_ekspedisi036', 'nama_ekspedisi036', 'required|max_length[11]');
        $this->form_validation->set_rules('jenis_layanan036', 'jenis_layanan036', 'required|max_length[30]');
        $this->form_validation->set_rules('tarif_perkg036', 'tarif_perkg036', 'required|max_length[10]');
        $this->form_validation->set_rules('status036', 'status036', 'required|max_length[15]');

        if ($this->form_validation->run() !== FALSE) {
            $this->_simpan_ekspedisi();
        } else {
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/ekspedisi036/tambah_ekspedisi');
            $this->load->view('administrator/templates/footer');
        }
    }

    private function _simpan_ekspedisi()
    {
        $data = [
            'nama_ekspedisi036' => ucwords($this->input->post('nama_ekspedisi036')),
            'jenis_layanan036' => ucfirst($this->input->post('jenis_layanan036')),
            'tarif_perkg036' => $this->input->post('tarif_perkg036'),
            'status036' => ucfirst($this->input->post('status036'))
        ];

        $simpan = $this->ekspedisi_model036->tambah($data);

        if ($simpan) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
                Berhasil menambahkan ekspedisi!!
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                Gagal menambahkan ekspedisi!!
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }

        redirect('admin/ekspedisi036');
    }

    public function ubah_ekspedisi($id)
    {
        // check dulu apakah id dengan ekspedisi ada?
        $ekspedisi = $this->ekspedisi_model036->get_by_id($id);

        if ($ekspedisi) {
            $this->form_validation->set_rules('nama_ekspedisi036', 'nama_ekspedisi036', 'required|max_length[11]');
            $this->form_validation->set_rules('jenis_layanan036', 'jenis_layanan036', 'required|max_length[30]');
            $this->form_validation->set_rules('tarif_perkg036', 'tarif_perkg036', 'required|max_length[10]');
            $this->form_validation->set_rules('status036', 'status036', 'required|max_length[15]');

            if ($this->form_validation->run() !== FALSE) {
                $this->_ubah_ekspedisi($id);
            } else {
                $data['title'] = 'Ubah ekspedisi';
                $data['ekspedisi'] = $ekspedisi;

                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/ekspedisi036/ubah_ekspedisi', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    ekspedisi tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');

            redirect('admin/ekspedisi036');
        }
    }

    private function _ubah_ekspedisi($id)
    {
        $data = [
            'nama_ekspedisi036' => ucwords($this->input->post('nama_ekspedisi036')),
            'jenis_layanan036' => ucfirst($this->input->post('jenis_layanan036')),
            'tarif_perkg036' => $this->input->post('tarif_perkg036'),
            'status036' => ucfirst($this->input->post('status036'))
        ];

        $ubah = $this->ekspedisi_model036->ubah($data, $id);

        if ($ubah) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil mengubah ekspedisi!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Gagal mengubah ekspedisi!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }

        redirect('admin/ekspedisi036');
    }

    public function hapus_ekspedisi($id)
    {
        // check apakah ada ekspedisi
        $ekspedisi = $this->ekspedisi_model036->get_by_id($id);

        if ($ekspedisi) {
            $hapus = $this->ekspedisi_model036->hapus($id);

            if ($hapus) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        Berhasil menghapus ekspedisi!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        Gagal menghapus ekspedisi!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            }

            redirect('admin/ekspedisi036');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    ekspedisi tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');

            redirect('admin/ekspedisi036');
        }
    }
}
