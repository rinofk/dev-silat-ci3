<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Mahasiswa_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Surat_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }


    public function index()
    {
        $data['title'] = 'Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
        if ($this->input->post('keyword')) {
            $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
        }
        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer_a');
    }
    public function aktifkuliah()
    {

        $data['list_tahun'] = $this->Transaksi_model->getTahunSuratAktif();

        // Ambil tahun dari input jika ada
        $data['tahun_selected'] = $this->input->get('tahun') ?? $data['list_tahun'][0]; // default tahun terbaru

        $tahun_filter = $this->input->get('tahun') ?? date('Y');
        $data['statistik'] = $this->Transaksi_model->getStatistikSuratAktif($tahun_filter);


        $data['title'] = 'Surat Aktif Kuliah';
        $status = $this->input->get('status');
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Transaksi_model->getSuratAktifKuliah();
        $data['total_surat'] = $this->Transaksi_model->hitungJumlahSurat();
        $data['total_diajukan'] = $this->Transaksi_model->hitungJumlahdiAjukan();
        $data['total_proses'] = $this->Transaksi_model->hitungJumlahdiProses();
        $data['total_selesai'] = $this->Transaksi_model->hitungJumlahdiSelesai();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/aktifkuliah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    
    public function detail($id_suratpengajuan)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_suratpengajuan);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/detail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }
  
    public function ubah($id_suratpengajuan)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_suratpengajuan);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/ubah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Transaksi_model->ubah($id_suratpengajuan);
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('transaksi/detail/' . $id_suratpengajuan);
        }
    }
    public function cetak($id_suratpengajuan)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_suratpengajuan);
        $keperluan = $this->db->get_where('tb_suratpengajuan', ['id_suratpengajuan' => $id_suratpengajuan])->row_array();
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '3'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            if ($keperluan['keperluan'] == '1') {
                $this->load->view('transaksi/cetaksurat', $data);
            } else {
                if ($keperluan['keperluan'] == '2') {
                    //   $this->load->view('mahasiswa/kop', $data);
                    $this->load->view('transaksi/cetaksurat', $data);
                    //  $this->load->view('templates/footer');
                } else {
                    $this->load->view('transaksi/cetaksuratv2', $data);
                }
            }
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('transaksi');
        }
    }

    public function proses($id_suratpengajuan)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_suratpengajuan);


        $this->Transaksi_model->prosesSuratAktifKuliah($id_suratpengajuan);
        $this->session->set_flashdata('flash', 'di PROSES');
        redirect('transaksi/detail/' . $id_suratpengajuan);
    }

          public function selesai($id)
            {
                $this->load->helper('file'); // Untuk unlink

                if (!empty($_FILES['file_surat']['name'])) {
                    $config['upload_path'] = './assets/surat_selesai/';
                    $config['allowed_types'] = 'pdf';
                    $config['overwrite'] = true; // Penting untuk replace
                    // $config['file_name'] = 'surat_aktif_kuliah_' . $id;
                    $config['file_name'] = 'Aktifkuliah_' . date('Ymd') . '_' . $id;


                    $this->load->library('upload', $config);

                    // Ambil data lama untuk cek file
                    $surat = $this->db->get_where('tb_suratpengajuan', ['id_suratpengajuan' => $id])->row_array();

                    // Jika ada file sebelumnya, hapus dulu
                    if (!empty($surat['file_selesai'])) {
                        $old_path = './assets/surat_selesai/' . $surat['file_selesai'];
                        if (file_exists($old_path)) {
                            unlink($old_path);
                        }
                    }

                    if ($this->upload->do_upload('file_surat')) {
                        $fileData = $this->upload->data();
                        $nama_file = $fileData['file_name'];

                        // Simpan ke DB
                        $this->db->set('status', 'selesai');
                        $this->db->set('file_selesai', $nama_file);
                        $this->db->set('date_finish', time());
                        $this->db->where('id_suratpengajuan', $id);
                        $this->db->update('tb_suratpengajuan');

                        $this->session->set_flashdata('flash', 'diselesaikan dan file diupload.');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('flash', 'Gagal upload file: ' . $error);
                    }
                } else {
                    $this->session->set_flashdata('flash', 'File tidak dipilih!');
                }

                redirect('transaksi/aktifkuliah');
            }



    public function hapus_ak($id_suratpengajuan){
        
         $data['tanggal'] = tanggal();
         $data['judul'] = 'Hapus Data Mahasiswa';
         $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_suratpengajuan);
        
         $this->db->where('id_suratpengajuan', $id_suratpengajuan);
         $this->db->delete('tb_suratpengajuan');
         
        $this->session->set_flashdata('flash', 'di HAPUS');
        redirect('transaksi/aktifkuliah');
    }
    public function tolak($id_suratpengajuan)
    {

        $data['tanggal'] = tanggal();
        $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_suratpengajuan);
        $tolak = 'ditolak';
        $data = [

            'status' => $tolak,
            'status_keterangan' => $this->input->post('status_keterangan'),
            'admin' => $this->session->userdata('name'),
            'date_finish' => time()

        ];
        $this->db->where('id_suratpengajuan', $id_suratpengajuan);
        $this->db->update('tb_suratpengajuan', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('transaksi/detail/' . $id_suratpengajuan);
    }
}
