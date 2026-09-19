<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smart_library {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('Kriteria_model');
        $this->CI->load->model('Penilaian_model');
        $this->CI->load->model('Mahasiswa_model');
        $this->CI->load->model('Hasil_model');
    }

    /**
     * Hitung total nilai SMART untuk semua mahasiswa
     */
    public function hitung_semua() {
        // Ambil semua kriteria
        $kriteria = $this->CI->Kriteria_model->get_all();
        
        // Ambil semua mahasiswa
        $mahasiswa = $this->CI->Mahasiswa_model->get_all();
        
        // Normalisasi bobot
        $total_bobot = $this->CI->Kriteria_model->get_total_bobot();
        $normalized_weights = array();
        
        foreach ($kriteria as $k) {
            $normalized_weights[$k->id_kriteria] = $total_bobot > 0 ? ($k->bobot / $total_bobot) : 0;
        }
        
        // Hitung nilai untuk setiap mahasiswa
        $results = array();
        
        foreach ($mahasiswa as $m) {
            $total_nilai = 0;
            
            // Ambil nilai untuk setiap kriteria
            foreach ($kriteria as $k) {
                $nilai = $this->CI->Penilaian_model->get_nilai($m->id_mahasiswa, $k->id_kriteria);
                
                if ($nilai !== null) {
                    // Normalisasi nilai berdasarkan tipe kriteria
                    $normalized_nilai = $this->normalize_nilai($nilai, $k->id_kriteria, $k->tipe);
                    
                    // Hitung weighted score
                    $weighted_score = $normalized_nilai * $normalized_weights[$k->id_kriteria];
                    $total_nilai += $weighted_score;
                }
            }
            
            $results[] = array(
                'id_mahasiswa' => $m->id_mahasiswa,
                'total_nilai' => $total_nilai
            );
        }
        
        // Urutkan berdasarkan total nilai (descending)
        usort($results, function($a, $b) {
            return $b['total_nilai'] <=> $a['total_nilai'];
        });
        
        // Simpan hasil ke database dengan ranking
        $ranking = 1;
        foreach ($results as $result) {
            $status = $result['total_nilai'] > 0 ? 'Lulus' : 'Tidak Lulus';
            $this->CI->Hasil_model->upsert(
                $result['id_mahasiswa'],
                $result['total_nilai'],
                $ranking++,
                $status
            );
        }
        
        return $results;
    }

    /**
     * Hitung nilai SMART untuk satu mahasiswa
     */
    public function hitung_mahasiswa($id_mahasiswa) {
        $kriteria = $this->CI->Kriteria_model->get_all();
        $total_bobot = $this->CI->Kriteria_model->get_total_bobot();
        
        $normalized_weights = array();
        foreach ($kriteria as $k) {
            $normalized_weights[$k->id_kriteria] = $total_bobot > 0 ? ($k->bobot / $total_bobot) : 0;
        }
        
        $total_nilai = 0;
        $detail = array();
        
        foreach ($kriteria as $k) {
            $nilai = $this->CI->Penilaian_model->get_nilai($id_mahasiswa, $k->id_kriteria);
            
            if ($nilai !== null) {
                $normalized_nilai = $this->normalize_nilai($nilai, $k->id_kriteria, $k->tipe);
                $weighted_score = $normalized_nilai * $normalized_weights[$k->id_kriteria];
                $total_nilai += $weighted_score;
                
                $detail[] = array(
                    'kriteria' => $k->nama_kriteria,
                    'nilai_awal' => $nilai,
                    'nilai_normalisasi' => $normalized_nilai,
                    'bobot' => $normalized_weights[$k->id_kriteria],
                    'skor_terbobot' => $weighted_score
                );
            }
        }
        
        return array(
            'total_nilai' => $total_nilai,
            'detail' => $detail
        );
    }

    /**
     * Normalisasi nilai berdasarkan tipe kriteria
     */
    private function normalize_nilai($nilai, $id_kriteria, $tipe) {
        // Ambil semua nilai untuk kriteria ini
        $all_penilaian = $this->CI->Penilaian_model->get_by_kriteria($id_kriteria);
        
        if (empty($all_penilaian)) {
            return 0;
        }
        
        $values = array();
        foreach ($all_penilaian as $p) {
            $values[] = $p->nilai;
        }
        
        $max = max($values);
        $min = min($values);
        $range = $max - $min;
        
        if ($range == 0) {
            return 1; // Semua nilai sama, normalisasi = 1
        }
        
        if ($tipe == 'benefit') {
            // Benefit: semakin besar semakin baik
            return ($nilai - $min) / $range;
        } else {
            // Cost: semakin kecil semakin baik
            return ($max - $nilai) / $range;
        }
    }

    /**
     * Validasi apakah semua mahasiswa sudah dinilai
     */
    public function validate_penilaian() {
        $mahasiswa = $this->CI->Mahasiswa_model->get_all();
        $kriteria = $this->CI->Kriteria_model->get_all();
        
        $errors = array();
        
        foreach ($mahasiswa as $m) {
            foreach ($kriteria as $k) {
                $nilai = $this->CI->Penilaian_model->get_nilai($m->id_mahasiswa, $k->id_kriteria);
                if ($nilai === null) {
                    $errors[] = "Mahasiswa {$m->nama} belum dinilai untuk kriteria {$k->nama_kriteria}";
                }
            }
        }
        
        return $errors;
    }
}

