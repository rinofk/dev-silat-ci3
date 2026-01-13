<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perpustakaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Mahasiswa_model');
        $this->load->model('Pustakawan_model');
        $this->load->library('pdf');
    }
    public function index()
    {
        $data['title'] = 'Bebas Perpustakaan';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('tb_bebasperpus', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();
        $nim = $data['user']['nim'];
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByJoin($nim);
        $data['ajuan'] = $this->Pustakawan_model->ajuan($nim);

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bebasperpus/index', $data);
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
        $this->load->view('bebasperpus/tambah', $data);
        $this->load->view('templates/footer_a');
    }
    public function do_upload()
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('tb_bebasperpus', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();

        $nim = $this->input->post('nim');
        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/bebasperpus/';

        // FIX MIME type WhatsApp / Android
        $config['mime_types'] = [
            'jpg'  => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
            'jpeg' => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
            'png'  => ['image/png',  'image/x-png']
        ];

        $this->load->library('upload', $config);

        $upload_ktm = $_FILES['ktm']['name'];
        if ($upload_ktm) {
            // $old_image = $data['bp']['ktm'];
            // if ($old_image != 'default.jpg') {
            //     unlink(FCPATH . 'assets/bebasperpus/' . $old_image);
            // }
            if ($this->upload->do_upload('ktm')) {
                $ktm = $this->upload->data('file_name');
                $this->db->set('ktm', $ktm);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_kartuanggota = $_FILES['anggota']['name'];
        if ($upload_kartuanggota) {
            // $old_kartuanggota = $data['wisuda']['kartuanggota'];
            // if ($old_kartuanggota != 'default.jpg') {
            //     unlink(FCPATH . 'assets/berkaswisuda/' . $old_kartuanggota);
            // }
            if ($this->upload->do_upload('anggota')) {
                $kartu_anggota = $this->upload->data('file_name');
                $this->db->set('kartuperpus', $kartu_anggota);
            } else {
                echo $this->upload->display_errors();
            }
        }

        // $this->db->where('nim_bw', $nim);
        // $this->db->set('nim_bw', $nim);
        // $this->db->update('tb_berkaswisuda');
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $data = [
            "nim_mahasiswa" => $this->input->post('nim', true),
            "semester" => $this->input->post('semester', true),
            "date_created" => $date

        ];
        $this->db->insert('tb_bebasperpus', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di UPDATE</div>');
        redirect('perpustakaan');
    }

    public function do_update()
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('tb_bebasperpus', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();

        $nim = $this->input->post('nim');
        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'jpeg|jpg|png|pdf';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/bebasperpus/';
        $this->load->library('upload', $config);

        $upload_ktm = $_FILES['ktm']['name'];
        if ($upload_ktm) {
            $old_image = $data['bp']['ktm'];
            if ($old_image != 'default.jpg') {
                unlink(FCPATH . 'assets/bebasperpus/' . $old_image);
            }
            if ($this->upload->do_upload('ktm')) {
                $ktm = $this->upload->data('file_name');
                $this->db->set('ktm', $ktm);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_kartuanggota = $_FILES['anggota']['name'];
        if ($upload_kartuanggota) {
            $old_kartuanggota = $data['bp']['kartuanggota'];
            if ($old_kartuanggota != 'default.jpg') {
                unlink(FCPATH . 'assets/bebasperpus/' . $old_kartuanggota);
            }
            if ($this->upload->do_upload('anggota')) {
                $kartu_anggota = $this->upload->data('file_name');
                $this->db->set('kartuperpus', $kartu_anggota);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->where('nim_mahasiswa', $nim);
        $this->db->set('semester', $this->input->post('semester'));
        $this->db->update('tb_bebasperpus');
        // $date = date("Y-m-d");
        // $data = [
        //     "nim_mahasiswa" => $this->input->post('nim', true),
        //     "semester" => $this->input->post('semester', true),
        //     "date_created" => $date

        // ];
        // $this->db->insert('tb_bebasperpus', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di UPDATE</div>');
        redirect('perpustakaan');
    }
    public function ajukan($id_bp)
    {

        // $data['tanggal'] = tanggal();
        // $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_bp);


        $this->Pustakawan_model->ajukanBebasPerpus($id_bp);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di KIRIM</div>');
        redirect('perpustakaan');
    }
    public function cetak($id_bp)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['bp'] = $this->Pustakawan_model->get_Idbp($id_bp);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '1'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '5'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('bebasperpus/cetak', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }
}
