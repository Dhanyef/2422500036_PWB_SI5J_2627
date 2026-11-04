<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $_table = "produk";

    public function get_all_produk()
    {
        $this->db->select('
            produk.id_produk, 
            produk.nama as pd_nama, 
            produk.stok, 
            produk.sinopsis, 
            produk.harga, 
            kategori.nama as kt_nama, 
            produk.penerbit, 
            produk.tahunterbit, 
            produk.isbn
        ');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        return $this->db->get()->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
        #untuk check apakah berhasil atau tidak input data
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        // Disamakan menggunakan JOIN kategori agar data nama kategori
        // atau relasi lainnya bisa terbaca dengan aman saat halaman UBAH dimuat
        $this->db->select('produk.*, kategori.nama as kt_nama');
        $this->db->from($this->_table);
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->where('produk.id_produk', $id);
        return $this->db->get()->row_array();
    }

    public function ubah($data, $id)
    {
        $this->db->where('id_produk', $id);
        $this->db->update($this->_table, $data);
        return ($this->db->affected_rows() < 0) ? false : true;
    }

    public function hapus($id)
    {
        $this->db->delete($this->_table, array('id_produk' => $id));
    }
}
