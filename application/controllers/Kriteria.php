<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kriteria_model');
    }

    public function index() {
        $data['title'] = 'Data Kriteria';
        $data['kriteria'] = $this->Kriteria_model->get_all();
        $data['total_bobot'] = $this->Kriteria_model->get_total_bobot();
        
        $this->load->view('templates/header', $data);
        $this->load->view('kriteria/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Kriteria';
        
        $this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'required');
        $this->form_validation->set_rules('bobot', 'Bobot', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('kriteria/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data_insert = array(
                'nama_kriteria' => $this->input->post('nama_kriteria'),
                'bobot' => $this->input->post('bobot'),
                'tipe' => $this->input->post('tipe'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->Kriteria_model->create($data_insert);
            $this->session->set_flashdata('success', 'Kriteria berhasil ditambahkan');
            redirect('kriteria');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Kriteria';
        $data['kriteria'] = $this->Kriteria_model->get_by_id($id);
        
        if (!$data['kriteria']) {
            show_404();
        }
        
        $this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'required');
        $this->form_validation->set_rules('bobot', 'Bobot', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('kriteria/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data_update = array(
                'nama_kriteria' => $this->input->post('nama_kriteria'),
                'bobot' => $this->input->post('bobot'),
                'tipe' => $this->input->post('tipe'),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->Kriteria_model->update($id, $data_update);
            $this->session->set_flashdata('success', 'Kriteria berhasil diupdate');
            redirect('kriteria');
        }
    }

    public function delete($id) {
        $kriteria = $this->Kriteria_model->get_by_id($id);
        
        if (!$kriteria) {
            show_404();
        }
        
        $this->Kriteria_model->delete($id);
        $this->session->set_flashdata('success', 'Kriteria berhasil dihapus');
        redirect('kriteria');
    }
}

