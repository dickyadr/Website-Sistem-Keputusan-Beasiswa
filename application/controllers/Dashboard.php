<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kriteria_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Penilaian_model');
        $this->load->model('Hasil_model');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['total_kriteria'] = $this->Kriteria_model->count_all();
        $data['total_mahasiswa'] = $this->Mahasiswa_model->count_all();
        $data['top_hasil'] = $this->Hasil_model->get_top(5);
        
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}

