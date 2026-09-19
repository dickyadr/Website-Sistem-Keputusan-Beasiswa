<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mahasiswa_model');
    }

    public function index() {
        $data['title'] = 'Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Mahasiswa';
        
        $this->form_validation->set_rules('nim', 'NIM', 'required|is_unique[mahasiswa.nim]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data_insert = array(
                'nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'jurusan' => $this->input->post('jurusan'),
                'semester' => $this->input->post('semester'),
                'ipk' => $this->input->post('ipk'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp')
            );
            
            $this->Mahasiswa_model->create($data_insert);
            $this->session->set_flashdata('success', 'Mahasiswa berhasil ditambahkan');
            redirect('mahasiswa');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->get_by_id($id);
        
        if (!$data['mahasiswa']) {
            show_404();
        }
        
        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data_update = array(
                'nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'jurusan' => $this->input->post('jurusan'),
                'semester' => $this->input->post('semester'),
                'ipk' => $this->input->post('ipk'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp')
            );
            
            $this->Mahasiswa_model->update($id, $data_update);
            $this->session->set_flashdata('success', 'Mahasiswa berhasil diupdate');
            redirect('mahasiswa');
        }
    }

    public function delete($id) {
        $mahasiswa = $this->Mahasiswa_model->get_by_id($id);
        
        if (!$mahasiswa) {
            show_404();
        }
        
        $this->Mahasiswa_model->delete($id);
        $this->session->set_flashdata('success', 'Mahasiswa berhasil dihapus');
        redirect('mahasiswa');
    }
}

