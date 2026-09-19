<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        return $this->db->get('kriteria')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('kriteria', array('id_kriteria' => $id))->row();
    }

    public function create($data) {
        $this->db->insert('kriteria', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id_kriteria', $id);
        return $this->db->update('kriteria', $data);
    }

    public function delete($id) {
        $this->db->where('id_kriteria', $id);
        return $this->db->delete('kriteria');
    }

    public function get_total_bobot() {
        $result = $this->db->select_sum('bobot')->get('kriteria')->row();
        return $result->bobot ?? 0;
    }

    public function count_all() {
        return $this->db->count_all('kriteria');
    }
}

