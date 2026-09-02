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
        $this->form_validation->set_rules('tahun_wisuda', 'Tahun Wisuda', 'required|numeric|exact_length[4]');
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
        $this->form_validation->set_rules('tahun_wisuda', 'Tahun Wisuda', 'required|numeric|exact_length[4]');
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

    public function upload_ajax()
    {
        $nim = $this->session->userdata('nim');
        if (empty($nim)) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Sesi login telah berakhir. Silakan login kembali.'
                ]));
            return;
        }

        if (empty($_FILES['poto']['name'])) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Tidak ada file foto yang dipilih.'
                ]));
            return;
        }

        $upload_path = './assets/img/alumni/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'gif|jpg|jpeg|png|JPG|JPEG|PNG',
            'max_size'      => 6148, // 6 MB
            'file_name'     => $nim . '_' . time()
        ];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('poto')) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => $this->upload->display_errors('', '')
                ]));
        } else {
            $upload_data = $this->upload->data();
            $new_image = $upload_data['file_name'];

            // Hapus file lama jika ada dan bukan default.jpg
            $current_alumni = $this->db->get_where('tb_alumni', ['nim_alumni' => $nim])->row_array();
            if (!empty($current_alumni['poto']) && $current_alumni['poto'] != 'default.jpg' && file_exists($upload_path . $current_alumni['poto'])) {
                @unlink($upload_path . $current_alumni['poto']);
            }

            // Update database langsung
            $this->db->where('nim_alumni', $nim);
            $this->db->update('tb_alumni', [
                'poto' => $new_image,
                'tanggal_updatealumni' => date('Y-m-d H:i:s')
            ]);

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'message' => 'Pas foto berhasil diunggah secara realtime!',
                    'file_name' => $new_image,
                    'file_url' => base_url('assets/img/alumni/' . $new_image) . '?v=' . time()
                ]));
        }
    }

    public function upload()
    {
        $nim = $this->session->userdata('nim');
        $alamat = $this->input->post('alamat');

        $upload_image = !empty($_FILES['poto']['name']) ? $_FILES['poto']['name'] : null;
        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG|PNG';
            $config['max_size']     = '6148';
            $config['upload_path'] = './assets/img/alumni/';
            $config['file_name'] = $nim . '_' . time();

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $current_alumni = $this->db->get_where('tb_alumni', ['nim_alumni' => $nim])->row_array();
            $old_image = !empty($current_alumni['poto']) ? $current_alumni['poto'] : 'default.jpg';

            if ($this->upload->do_upload('poto')) {
                if ($old_image != 'default.jpg' && file_exists('./assets/img/alumni/' . $old_image)) {
                    @unlink('./assets/img/alumni/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('poto', $new_image);
            }
        }

        $this->db->set('alamat_sekarang', $alamat);
        $this->db->set('tanggal_updatealumni', date('Y-m-d H:i:s'));
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
