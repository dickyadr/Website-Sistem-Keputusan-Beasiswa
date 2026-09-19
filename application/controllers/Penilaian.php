<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Penilaian_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Kriteria_model');
    }

    public function index() {
        $data['title'] = 'Data Penilaian';
        $data['mahasiswa'] = $this->Mahasiswa_model->get_all();
        $data['kriteria'] = $this->Kriteria_model->get_all();
        
        // Ambil semua penilaian
        $penilaian_data = array();
        foreach ($data['mahasiswa'] as $m) {
            $penilaian_data[$m->id_mahasiswa] = $this->Penilaian_model->get_by_mahasiswa($m->id_mahasiswa);
        }
        $data['penilaian'] = $penilaian_data;
        
        $this->load->view('templates/header', $data);
        $this->load->view('penilaian/index', $data);
        $this->load->view('templates/footer');
    }

    public function nilai($id_mahasiswa) {
        $data['title'] = 'Input Penilaian';
        $data['mahasiswa'] = $this->Mahasiswa_model->get_by_id($id_mahasiswa);
        $data['kriteria'] = $this->Kriteria_model->get_all();
        
        if (!$data['mahasiswa']) {
            show_404();
        }
        
        // Ambil nilai yang sudah ada
        $existing_nilai = array();
        foreach ($data['kriteria'] as $k) {
            $nilai = $this->Penilaian_model->get_nilai($id_mahasiswa, $k->id_kriteria);
            $existing_nilai[$k->id_kriteria] = $nilai;
        }
        $data['existing_nilai'] = $existing_nilai;
        
        $this->form_validation->set_rules('nilai[]', 'Nilai', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('penilaian/nilai', $data);
            $this->load->view('templates/footer');
        } else {
            $nilai_array = $this->input->post('nilai');
            $kriteria_ids = $this->input->post('id_kriteria');
            
            foreach ($nilai_array as $index => $nilai) {
                $id_kriteria = $kriteria_ids[$index];
                $this->Penilaian_model->upsert($id_mahasiswa, $id_kriteria, $nilai);
            }
            
            $this->session->set_flashdata('success', 'Penilaian berhasil disimpan');
            redirect('penilaian');
        }
    }

    public function edit($id_mahasiswa) {
        $this->nilai($id_mahasiswa);
    }
}

