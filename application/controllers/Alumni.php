<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alumni extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        //        $this->load->model('Mahasiswa_model');
        $this->load->model('Alumni_model');
        $this->load->model('Surat_model');
        $this->load->model('Skl_model');

        $this->load->library('form_validation');
        $this->load->library('pdf');
    }
    public function index()
    {
        $data['title'] = 'Daftar Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['surat'] = $this->Surat_model->getSuratByNim($id);
        $data['alumni'] = $this->Alumni_model->getAlumni($id);

        // echo 'Selamat Datang User ' . $data['user']['name'];
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['keperluan'] = $this->db->get('keperluan')->result_array();


        $aktif = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        $data['status'] = $this->db->get_where('tb_alumni', ['nim_alumni' => $id])->row_array();
        if ($aktif['status_aktif'] == 1) {

            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header_a', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('alumni/index', $data);
                $this->load->view('templates/footer_a');
            } else {
                $this->Surat_model->tambahPengajuanSurat();
                $this->session->set_flashdata('flash', 'di UPDATE');
                redirect('biodata');
            }
        } else {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/off', $data);
            $this->load->view('templates/footer_a');
        }
    }


    public function ubah($nim_alumni)
    {
        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['alumni'] = $this->Alumni_model->getNimAlumni($nim_alumni);


        $this->form_validation->set_rules('nim_alumni', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('alumni/ubah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Alumni_model->getUbahAlumni();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('alumni');
        }
    }


    public function tambah()
    {
        $data['title'] = 'Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];

        $this->form_validation->set_rules('tahun_wisuda', 'Tahun Wisuda', 'required');
        $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        $this->form_validation->set_rules('pesan_kesan', 'Pesan dan Kesan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('alumni/tambah');
            $this->load->view('templates/footer_a');
        } else {
            $this->Alumni_model->tambahAlumni();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('alumni');
        }
    }


    public function kirim($nim_alumni)
    {

        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $data = [
            "status_alumni" => 1
        ];
        $role = [
            "role_id" => 2
        ];
        $wisuda = [
            "nim_bw" => $nim_alumni,
            "kwitansi" => 'no file',
            "biodata" => 'no file',
            "date_created" => time(),
            "date_updated" => time()
        ];
        $this->db->where('nim_alumni', $nim_alumni);
        $this->db->update('tb_alumni', $data);

        $this->db->where('nim', $nim_alumni);
        $this->db->update('user', $role);

        $this->db->insert('tb_berkaswisuda', $wisuda);

        // $this->Alumni_model->kirimAlumni($nim_alumni);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('alumni');
    }

    public function upload()
    {

        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $nim = $this->input->post('nim');
        $alamat = $this->input->post('alamat');

        $upload_image = $_FILES['poto']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']     = '6148';
            $config['upload_path'] = './assets/img/alumni/';
            $config['file_name'] = $this->input->post('nim');
            $config['overwrite'] = true;
            // $config['detect_mime']   = true;

            // FIX MIME type WhatsApp / Android
            $config['mime_types'] = [
                'jpg'  => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
                'jpeg' => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
                'png'  => ['image/png',  'image/x-png']
            ];

            $this->load->library('upload', $config);
            $old_image = $data['tb_alumni']['poto'];
            if ($old_image != 'default.jpg') {
                unlink(FCPATH . 'assets/img/alumni/' . $old_image);
            }

            if ($this->upload->do_upload('poto')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('poto', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->set('alamat_sekarang', $alamat);
        $this->db->where('nim_alumni', $nim);
        $this->db->update('tb_alumni');
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('alumni');
    }


    public function cetak($nim_alumni)
    {
        $data['tanggal'] = tanggal();

        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['alumni'] = $this->Alumni_model->getNimAlumni($nim_alumni);


        $this->load->view('alumni/cetak', $data);
    }




    // ======================================================================================================
    // SURAT KETERANGAN LULUS (SKL)
    public function skl()
    {
        $data['title'] = 'SKL';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['surat'] = $this->Surat_model->getSuratByNim($id);
        $data['skl'] = $this->Alumni_model->getSkl($id);

        $data['prodi'] = $this->db->get('prodi')->result_array();
        $aktif = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        $data['status_skl'] = $this->db->get_where('tb_skl', ['nim' => $id, 'jenis_skl' => '2'])->row_array();
        $data['status'] = $this->db->get_where('tb_alumni', ['nim_alumni' => $id])->row_array();

        if ($aktif['status_aktif'] == 1) {

            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header_a', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('alumni/skl-index', $data);
                $this->load->view('templates/footer_a');
            } else {
                $this->Surat_model->tambahPengajuanSurat();
                $this->session->set_flashdata('flash', 'di UPDATE');
                redirect('biodata');
            }
        } else {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/off', $data);
            $this->load->view('templates/footer_a');
        }
    }

    public function skltambah()
    {
        $data['title'] = 'Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['skl'] = $this->Alumni_model->getSklYudis($id);
        $data['alumni'] = $this->Alumni_model->getAlumni($id);

        $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'required');
        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Lulus', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'required');
        // $this->form_validation->set_rules('predikat', 'Predikat', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('alumni/skl-tambah');
            $this->load->view('templates/footer_a');
        } else {
            $this->Alumni_model->tambahSkl();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('alumni/skl');
        }
    }


    public function sklcetak($id_skl)
    {
        $data['tanggal'] = tanggal();

        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['skl'] = $this->Alumni_model->getIdSkl($id_skl);


        $this->load->view('alumni/skl-cetak', $data);
    }

    public function sklcetak2($id_skl)
    {
        $data['tanggal'] = tanggal();
        $data['surat'] = $this->Skl_model->getSklId($id_skl);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '1'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '1'])->row_array();
        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['skl'] = $this->Alumni_model->getIdSkl($id_skl);


        $this->load->view('alumni/skl-cetak2', $data);
    }
    // ======================================================================================================
    // SURAT KETERANGAN LULUS YUDISIUM (SKL YUDISIUM)
    public function sklyudis()
    {
        $data['title'] = 'SKL Yudisium';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['surat'] = $this->Surat_model->getSuratByNim($id);
        $data['skl'] = $this->Alumni_model->getSklyudis($id);

        $data['prodi'] = $this->db->get('prodi')->result_array();
        $aktif = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        $data['status_skl'] = $this->db->get_where('tb_skl', ['nim' => $id, 'jenis_skl' => '1'])->row_array();
        $data['status'] = $this->db->get_where('tb_alumni', ['nim_alumni' => $id])->row_array();

        if ($aktif['status_aktif'] == 1) {

            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header_a', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('alumni/sklyudis-index', $data);
                $this->load->view('templates/footer_a');
            } else {
                $this->Surat_model->tambahPengajuanSurat();
                $this->session->set_flashdata('flash', 'di UPDATE');
                redirect('biodata');
            }
        } else {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/off', $data);
            $this->load->view('templates/footer_a');
        }
    }

    public function sklyudistambah()
    {
        $data['title'] = 'Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['skl'] = $this->Alumni_model->getSkl($id);
        $data['alumni'] = $this->Alumni_model->getAlumni($id);


        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Lulus', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'required');
        // $this->form_validation->set_rules('predikat', 'Predikat', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('alumni/sklyudis-tambah');
            $this->load->view('templates/footer_a');
        } else {
            $this->Alumni_model->tambahSklYudis();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('alumni/sklyudis');
        }
    }


    public function sklyudiscetak($id_skl)
    {
        $data['tanggal'] = tanggal();

        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['skl'] = $this->Alumni_model->getIdSkl($id_skl);


        $this->load->view('alumni/sklyudis-cetak', $data);
    }
    public function sklyudiscetak2($id_skl)
    {
        $data['tanggal'] = tanggal();
        $data['surat'] = $this->Skl_model->getSklId($id_skl);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '2'])->row_array();
        $data['title'] = 'Edit Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['skl'] = $this->Alumni_model->getIdSkl($id_skl);


        $this->load->view('alumni/sklyudis-cetak2', $data);
    }
}
