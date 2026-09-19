<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Hasil_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Kriteria_model');
        $this->load->model('Penilaian_model');
        $this->load->library('smart_library');
    }

    public function index() {
        $data['title'] = 'Hasil Perhitungan SMART';
        $data['hasil'] = $this->Hasil_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('hasil/index', $data);
        $this->load->view('templates/footer');
    }

    public function hitung() {
        // Validasi apakah semua mahasiswa sudah dinilai
        $errors = $this->smart_library->validate_penilaian();
        
        if (!empty($errors)) {
            $this->session->set_flashdata('errors', $errors);
            redirect('penilaian');
        }
        
        // Hitung menggunakan metode SMART
        $this->smart_library->hitung_semua();
        
        $this->session->set_flashdata('success', 'Perhitungan SMART berhasil dilakukan');
        redirect('hasil');
    }

    public function detail($id_mahasiswa) {
        $data['title'] = 'Detail Hasil Perhitungan';
        $data['mahasiswa'] = $this->Mahasiswa_model->get_by_id($id_mahasiswa);
        $data['hasil'] = $this->Hasil_model->get_by_mahasiswa($id_mahasiswa);
        
        if (!$data['mahasiswa']) {
            show_404();
        }
        
        // Hitung detail perhitungan
        $data['detail'] = $this->smart_library->hitung_mahasiswa($id_mahasiswa);
        
        $this->load->view('templates/header', $data);
        $this->load->view('hasil/detail', $data);
        $this->load->view('templates/footer');
    }

    public function cetak() {
        $data['title'] = 'Laporan Hasil Beasiswa';
        $data['hasil'] = $this->Hasil_model->get_all();
        
        $this->load->view('hasil/cetak', $data);
    }
}

