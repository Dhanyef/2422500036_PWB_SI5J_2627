<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspedisi_controller036 extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('ekspedisi_model036');
        $this->load->library('form_validation'); // Memastikan library validasi form aktif
    }

    public function index() {
        $data['list_ekspedisi'] = $this->ekspedisi_model036->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/ekspedisi036/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_ekspedisi()
    {
        $data['title'] = 'Tambah Ekspedisi';
        $this->form_validation->set_rules('nama_ekspedisi', 'Nama Ekspedisi', 'required');
        
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
            'id_ekspedisi036'   => $this->input->post('id_ekspedisi'), // Menangkap ID dari input form jika manual
            'nama_ekspedisi036' => ucwords($this->input->post('nama_ekspedisi')),
            'jenis_layanan036'  => ucfirst($this->input->post('jenis_layanan')),
            'tarif_perkg036'    => $this->input->post('tarif_perkg'),
            'status036'         => ucfirst($this->input->post('status'))
        ];
        
        $simpan = $this->ekspedisi_model036->tambah($data);
        if ($simpan) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <div>Berhasil menambahkan Ekspedisi!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <div>Gagal menambahkan Ekspedisi!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/ekspedisi036');
    }

    public function hapus_ekspedisi($id)
    {
        $ekspedisi036 = $this->ekspedisi_model036->get_by_id($id);
        if ($ekspedisi036) {
            $hapus = $this->ekspedisi_model036->hapus($id);
            if ($hapus) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <div>Berhasil menghapus ekspedisi!!</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <div>Gagal menghapus ekspedisi!!</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <div>ekspedisi tidak ditemukan!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/ekspedisi036');
    }

    public function ubah_ekspedisi($id)
    {
        // Perbaikan typo nama model (sebelumnya ekspedisi_model036036)
        $ekspedisi036 = $this->ekspedisi_model036->get_by_id($id);
        
        if ($ekspedisi036) {
            $this->form_validation->set_rules('nama_ekspedisi', 'Nama Ekspedisi', 'required');
            
            if ($this->form_validation->run() !== FALSE) {
                $this->_ubah_ekspedisi($id);
            } else {
                $data['title'] = 'Ubah ekspedisi';
                $data['ekspedisi'] = $ekspedisi036; // Perbaikan nama variabel dari $ekspedisi ke $ekspedisi036
                
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/ekspedisi036/ubah_ekspedisi', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <div>ekspedisi tidak ditemukan!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/ekspedisi036');
        }
    }    

    private function _ubah_ekspedisi($id)
    {
        $data = [
            'nama_ekspedisi036' => ucwords($this->input->post('nama_ekspedisi')),
            'jenis_layanan036'  => ucfirst($this->input->post('jenis_layanan')),
            'tarif_perkg036'    => $this->input->post('tarif_perkg'),
            'status036'         => ucfirst($this->input->post('status'))
        ];
        
        $ubah = $this->ekspedisi_model036->ubah($data, $id);
        if ($ubah) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <div>Berhasil Mengubah ekspedisi!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <div>Gagal Mengubah ekspedisi!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/ekspedisi036');
    }
}
