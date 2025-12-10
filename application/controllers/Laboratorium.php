<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laboratorium extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Mahasiswa_model');
        $this->load->model('Laboratorium_model');
        $this->load->library('pdf');
    }
    public function index()
    {
        $data['title'] = 'Bebas Lab';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // $data['bl'] = $this->db->get_where('tb_bebaslab', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();
        $nim = $data['user']['nim'];
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByJoin($nim);
        // $data['ajuan'] = $this->Laboratorium_model->ajuan($nim);
        // Semua daftar pengajuan
        $data['pengajuan'] = $this->Laboratorium_model->getAllPengajuanByNim($nim);

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bebaslab/index', $data);
        $this->load->view('templates/footer_a');
    }
    public function tambah()
    {
        $data['title'] = 'Berkas Wisuda';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('tb_bebasperpus', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();
        $nim = $data['user']['nim'];
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByJoin($nim);

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bebaslab/tambah', $data);
        $this->load->view('templates/footer_a');
    }
    public function do_upload()
    {
        $data['user'] = $this->db->get_where('user', [
            'nim' => $this->session->userdata('nim')
        ])->row_array();

        $nim = $this->input->post('nim');

        // ==== PERBAIKAN UPLOAD ====
        $config['upload_path']   = './assets/bebaslab/';
        $config['allowed_types'] = 'jpg|jpeg|png';  // TAMBAH jpeg
        $config['max_size']      = 2048;

        // FIX MIME type WhatsApp Web
        $config['mime_types'] = [
            'jpg'  => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
            'jpeg' => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
            'png'  => ['image/png',  'image/x-png']
        ];

        $this->load->library('upload', $config);

        // Upload file KTM
        if (!empty($_FILES['ktm']['name'])) {
            if ($this->upload->do_upload('ktm')) {
                $ktm = $this->upload->data('file_name');
                $this->db->set('ktm', $ktm);
            } else {
                // Tampilkan error bila gagal
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">Upload gagal: ' .
                        $this->upload->display_errors() . '</div>'
                );
                redirect('laboratorium/tambah');
            }
        }

        // ==== INSERT DATA ====
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $dataInsert = [
            "nim_mahasiswa" => $nim,
            "semester"      => $this->input->post('semester', true),
            "status"        => '',            // status awal kosong dulu
            "date_created"  => $date
        ];

        $this->db->insert('tb_bebaslab', $dataInsert);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Pengajuan berhasil dibuat.
        </div>'
        );

        redirect('laboratorium');
    }


    public function edit($id_bebaslab)
    {
        $data['title'] = 'Edit Pengajuan Bebas Lab';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pengajuan'] = $this->Laboratorium_model->getById($id_bebaslab);

        if (!$data['pengajuan']) {
            show_404();
        }

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bebaslab/edit', $data);
        $this->load->view('templates/footer_a');
    }
    public function do_update()
    {
        $id = $this->input->post('id_bebaslab', true);

        // Ambil data lama
        $pengajuan = $this->db->get_where('tb_bebaslab', [
            'id_bebaslab' => $id
        ])->row_array();

        if (!$pengajuan) {
            show_404();
        }

        // Konfigurasi upload
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']     = '2048';
        $config['upload_path']  = './assets/bebaslab/';
        $this->load->library('upload', $config);

        // Jika ada upload KTM baru
        if (!empty($_FILES['ktm']['name'])) {

            if ($this->upload->do_upload('ktm')) {

                // Hapus file lama (jika ada)
                if (!empty($pengajuan['ktm'])) {
                    @unlink(FCPATH . 'assets/bebaslab/' . $pengajuan['ktm']);
                }

                $ktm = $this->upload->data('file_name');
                $this->db->set('ktm', $ktm);
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>'
                );
                redirect('laboratorium/edit/' . $id);
            }
        }

        // Jika kamu ingin edit semester (di form harus ada input semester)
        if ($this->input->post('semester')) {
            $this->db->set('semester', $this->input->post('semester', true));
        }

        // Update data
        $this->db->where('id_bebaslab', $id);
        $this->db->update('tb_bebaslab');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Pengajuan berhasil diperbarui</div>'
        );

        redirect('laboratorium');
    }

    public function ajukanx($id_bebaslab)
    {
        // $data['tanggal'] = tanggal();
        // $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_bp);


        $this->Laboratorium_model->ajukanBebasLab($id_bebaslab);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di KIRIM</div>');
        redirect('laboratorium');
    }

    public function ajukan($id_bebaslab)
    {
        // Ambil NIM dari session (lebih aman daripada input post)
        $nim = $this->session->userdata('nim');
        if (!$nim) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">NIM tidak ditemukan!</div>'
            );
            redirect('laboratorium');
            return;
        }

        // Cek pengajuan dalam 60 hari terakhir
        $cek = $this->Laboratorium_model->cekPengajuan60Hari($nim);
        if ($cek > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">Anda sudah mengajukan dalam 60 hari terakhir!</div>'
            );
            // kembali ke halaman detail pengajuan supaya user tahu datanya
            redirect('laboratorium');
            return;
        }

        // Ambil data user
        $data['user'] = $this->db->get_where('user', ['nim' => $nim])->row_array();
        // Lolos validasi → kirim pengajuan
        $this->Laboratorium_model->ajukanBebasLab($id_bebaslab);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Pengajuan berhasil dikirim</div>'
        );
        redirect('laboratorium');
    }



    public function cetak($id_bebaslab)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $prodi = $this->db->get_where('mahasiswa', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->Laboratorium_model->get_Idbp($id_bebaslab);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '1'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '6'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            if ($prodi['prodi_id'] == '1') {
                $this->load->view('bebaslab/cetak1', $data);
            } elseif ($prodi['prodi_id'] == '6') {
                $this->load->view('bebaslab/cetak1', $data);
            } elseif ($prodi['prodi_id'] == '2') {
                $this->load->view('bebaslab/cetak2', $data);
            } elseif ($prodi['prodi_id'] == '3') {
                $this->load->view('bebaslab/cetak3', $data);
            } elseif ($prodi['prodi_id'] == '5') {
                $this->load->view('bebaslab/cetak5', $data);
            }
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }

    public function delete($id_bebaslab)
    {
        // cek apakah data ada
        $data = $this->Laboratorium_model->getById($id_bebaslab);
        if (!$data) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('laboratorium');
        }

        // melakukan penghapusan
        $this->Laboratorium_model->delete($id_bebaslab);

        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('laboratorium');
    }
}
