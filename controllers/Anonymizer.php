<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anonymizer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->library('word_processor'); // Load library Word_processor
    }

    public function index() {
        $this->load->view('anonymizer_view');
    }

    public function process() {
        // Konfigurasi upload file
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'docx';
        $config['file_name'] = uniqid();
        $this->upload->initialize($config);
    
        if ($this->upload->do_upload('document')) {
            $file_data = $this->upload->data();
            $file_path = $file_data['full_path'];
    
            // Proses dokumen Word untuk mengambil data nama lengkap dan alamat
            $document_content = $this->word_processor->get_content($file_path);
    
            // Cari nama lengkap dalam konten
            preg_match('/Nama\s+lengkap\s*:\s*(.+?);/i', $document_content, $matches_name);
            $original_name = isset($matches_name[1]) ? trim($matches_name[1]) : "Nama tidak ditemukan di dokumen";
    
            // Cari alamat dalam konten (misalnya menggunakan regex untuk menangkap kata 'Tempat Tinggal')
            preg_match('/Tempat\s+Tinggal\s*:\s*(.+?);/i', $document_content, $matches_address);
            $original_address = isset($matches_address[1]) ? trim($matches_address[1]) : "Alamat tidak ditemukan di dokumen";
    
            // Siapkan data untuk ditampilkan pada view utama
            $data['original_name'] = $original_name;
            $data['file_path'] = $file_path;
            $data['original_address'] = $original_address;
    
            // Tampilkan form dengan nama dan alamat yang ditemukan
            $this->load->view('anonymizer_view', $data);
    
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('anonymizer_view', $error);
        }
    }
    
    public function anonymize() {
        // Ambil input dari user
        $file_path = $this->input->post('file_path'); // Path file yang sudah diunggah
        $original_name = $this->input->post('original_name');
        $anonymous_name = $this->input->post('anonymous_name');
        $original_address = $this->input->post('original_address');
        $anonymous_address = $this->input->post('anonymous_address');
    
        // Proses dokumen Word untuk mengganti nama asli dan alamat dengan nama serta alamat anonim
        $processed_content = $this->word_processor->anonymize($file_path, $original_name, $anonymous_name, $original_address, $anonymous_address);
    
        // Simpan dokumen yang sudah diubah
        $file_data = pathinfo($file_path);
        $new_file_path = './uploads/anonim_' . $file_data['basename'];
        $this->word_processor->save($new_file_path, $processed_content);
    
        // Berikan link download untuk file yang sudah diproses
        $data['download_link'] = base_url('uploads/anonim_' . $file_data['basename']);
    
        // Tampilkan view untuk download
        $this->load->view('download_view', $data);
    }
        
}
