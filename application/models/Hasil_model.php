<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $this->db->select('h.*, m.nama, m.nim, m.jurusan, m.ipk');
        $this->db->from('hasil h');
        $this->db->join('mahasiswa m', 'h.id_mahasiswa = m.id_mahasiswa');
        $this->db->order_by('h.ranking', 'ASC');
        $this->db->order_by('h.total_nilai', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('h.*, m.nama, m.nim');
        $this->db->from('hasil h');
        $this->db->join('mahasiswa m', 'h.id_mahasiswa = m.id_mahasiswa');
        $this->db->where('h.id_hasil', $id);
        return $this->db->get()->row();
    }

    public function get_by_mahasiswa($id_mahasiswa) {
        return $this->db->get_where('hasil', array('id_mahasiswa' => $id_mahasiswa))->row();
    }

    public function create($data) {
        $this->db->insert('hasil', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id_hasil', $id);
        return $this->db->update('hasil', $data);
    }

    public function upsert($id_mahasiswa, $total_nilai, $ranking = null, $status = null) {
        $data = array(
            'id_mahasiswa' => $id_mahasiswa,
            'total_nilai' => $total_nilai,
            'ranking' => $ranking,
            'status' => $status
        );
        
        $existing = $this->db->get_where('hasil', array('id_mahasiswa' => $id_mahasiswa))->row();

        if ($existing) {
            $this->db->where('id_hasil', $existing->id_hasil);
            return $this->db->update('hasil', $data);
        } else {
            return $this->db->insert('hasil', $data);
        }
    }

    public function delete($id) {
        $this->db->where('id_hasil', $id);
        return $this->db->delete('hasil');
    }

    public function delete_all() {
        return $this->db->truncate('hasil');
    }

    public function get_top($limit = 10) {
        $this->db->select('h.*, m.nama, m.nim, m.jurusan');
        $this->db->from('hasil h');
        $this->db->join('mahasiswa m', 'h.id_mahasiswa = m.id_mahasiswa');
        $this->db->order_by('h.total_nilai', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}

