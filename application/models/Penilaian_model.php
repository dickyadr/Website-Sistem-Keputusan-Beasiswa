<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_mahasiswa($id_mahasiswa) {
        $this->db->select('p.*, k.nama_kriteria, k.bobot, k.tipe');
        $this->db->from('penilaian p');
        $this->db->join('kriteria k', 'p.id_kriteria = k.id_kriteria');
        $this->db->where('p.id_mahasiswa', $id_mahasiswa);
        return $this->db->get()->result();
    }

    public function get_by_kriteria($id_kriteria) {
        $this->db->select('p.*, m.nama, m.nim');
        $this->db->from('penilaian p');
        $this->db->join('mahasiswa m', 'p.id_mahasiswa = m.id_mahasiswa');
        $this->db->where('p.id_kriteria', $id_kriteria);
        return $this->db->get()->result();
    }

    public function get_all() {
        $this->db->select('p.*, m.nama as nama_mahasiswa, m.nim, k.nama_kriteria');
        $this->db->from('penilaian p');
        $this->db->join('mahasiswa m', 'p.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('kriteria k', 'p.id_kriteria = k.id_kriteria');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('penilaian', array('id_penilaian' => $id))->row();
    }

    public function create($data) {
        $this->db->insert('penilaian', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id_penilaian', $id);
        return $this->db->update('penilaian', $data);
    }

    public function upsert($id_mahasiswa, $id_kriteria, $nilai) {
        $data = array(
            'id_mahasiswa' => $id_mahasiswa,
            'id_kriteria' => $id_kriteria,
            'nilai' => $nilai
        );
        
        $existing = $this->db->get_where('penilaian', array(
            'id_mahasiswa' => $id_mahasiswa,
            'id_kriteria' => $id_kriteria
        ))->row();

        if ($existing) {
            $this->db->where('id_penilaian', $existing->id_penilaian);
            return $this->db->update('penilaian', $data);
        } else {
            return $this->db->insert('penilaian', $data);
        }
    }

    public function delete($id) {
        $this->db->where('id_penilaian', $id);
        return $this->db->delete('penilaian');
    }

    public function delete_by_mahasiswa($id_mahasiswa) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        return $this->db->delete('penilaian');
    }

    public function get_nilai($id_mahasiswa, $id_kriteria) {
        $result = $this->db->get_where('penilaian', array(
            'id_mahasiswa' => $id_mahasiswa,
            'id_kriteria' => $id_kriteria
        ))->row();
        return $result ? $result->nilai : null;
    }
}

