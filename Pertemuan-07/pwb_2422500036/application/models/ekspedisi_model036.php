<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ekspedisi_model036 extends CI_Model
{
    private $_table = "ekspedisi";

    public function get_all()
    {
        $this->db->select('ekspedisi.id_ekspedisi036, ekspedisi.nama_ekspedisi036, ekspedisi.jenis_layanan036, ekspedisi.tarif_perkg036, ekspedisi.status036');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result_array();
    }

    // PERBAIKAN DI SINI: Menggunakan affected_rows() agar mendukung input ID Manual / Auto-Increment
    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
        
        // Mengembalikan nilai true jika data berhasil masuk (minimal 1 baris terpengaruh)
        return ($this->db->affected_rows() > 0);
    }

    public function get_by_id($id)
    {
        $this->db->where('id_ekspedisi036', $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    public function ubah($data, $id)
    {
        $this->db->where('id_ekspedisi036', $id);
        $this->db->update($this->_table, $data);
        return ($this->db->affected_rows() >= 0) ? true : false; 
    }

    public function hapus($id)
    {
        return $this->db->delete($this->_table, array('id_ekspedisi036' => $id));
    }
}
