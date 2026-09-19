<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        return $this->db->get('mahasiswa')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('mahasiswa', array('id_mahasiswa' => $id))->row();
    }

    public function get_by_nim($nim) {
        return $this->db->get_where('mahasiswa', array('nim' => $nim))->row();
    }

    public function create($data) {
        $this->db->insert('mahasiswa', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id_mahasiswa', $id);
        return $this->db->update('mahasiswa', $data);
    }

    public function delete($id) {
        $this->db->where('id_mahasiswa', $id);
        return $this->db->delete('mahasiswa');
    }

    public function count_all() {
        return $this->db->count_all('mahasiswa');
    }

    public function get_with_hasil() {
        $this->db->select('m.*, h.total_nilai, h.ranking, h.status');
        $this->db->from('mahasiswa m');
        $this->db->join('hasil h', 'm.id_mahasiswa = h.id_mahasiswa', 'left');
        $this->db->order_by('h.ranking', 'ASC');
        $this->db->order_by('h.total_nilai', 'DESC');
        return $this->db->get()->result();
    }
}

