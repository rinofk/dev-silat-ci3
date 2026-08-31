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

    public function upload_ajax()
    {
        $input_name = '';
        if (!empty($_FILES['ktm']['name'])) {
            $input_name = 'ktm';
        } elseif (!empty($_FILES['anggota']['name'])) {
            $input_name = 'anggota';
        }

        if (empty($input_name)) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Tidak ada berkas yang diunggah.'
                ]));
            return;
        }

        $config = [
            'upload_path'   => './assets/bebasperpus/',
            'allowed_types' => 'jpeg|jpg|png|pdf',
            'max_size'      => 2048, // 2 MB
            'file_name'     => $input_name . '_' . time()
        ];

        // Ensure directory exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($input_name)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => $this->upload->display_errors('', '')
                ]));
        } else {
            $upload_data = $this->upload->data();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'file_name' => $upload_data['file_name']
                ]));
        }
    }

    public function do_upload()
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('tb_bebasperpus', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();

        $nim = $this->input->post('nim');

        // Check for AJAX pre-uploaded files
        $ktm = $this->input->post('temp_ktm') ?: null;
        $kartu_anggota = $this->input->post('temp_anggota') ?: 'default.jpg';

        $config = [
            'allowed_types' => 'jpeg|jpg|png|pdf',
            'max_size'      => 2048, // 2 MB
            'upload_path'   => './assets/bebasperpus/'
        ];

        $this->load->library('upload', $config);

        // Fallback upload KTM
        if (empty($ktm) && !empty($_FILES['ktm']['name'])) {
            if ($this->upload->do_upload('ktm')) {
                $ktm = $this->upload->data('file_name');
            } else {
                log_message('error', $this->upload->display_errors());
            }
        }

        // Fallback upload Anggota
        if ($kartu_anggota === 'default.jpg' && !empty($_FILES['anggota']['name'])) {
            if ($this->upload->do_upload('anggota')) {
                $kartu_anggota = $this->upload->data('file_name');
            } else {
                log_message('error', $this->upload->display_errors());
            }
        }

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $insert_data = [
            "nim_mahasiswa" => $this->input->post('nim', true),
            "semester"      => $this->input->post('semester', true),
            "ktm"           => $ktm,
            "kartuperpus"   => $kartu_anggota,
            "date_created"  => $date
        ];
        $this->db->insert('tb_bebasperpus', $insert_data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di SIMPAN</div>');
        redirect('perpustakaan');
    }

    public function do_update()
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('tb_bebasperpus', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();

        $nim = $this->input->post('nim');

        // Check for AJAX pre-uploaded files
        $ktm = $this->input->post('temp_ktm') ?: $data['bp']['ktm'];
        $kartu_anggota = $this->input->post('temp_anggota') ?: $data['bp']['kartuperpus'];

        $config = [
            'allowed_types' => 'jpeg|jpg|png|pdf',
            'max_size'      => 2048, // 2 MB
            'upload_path'   => './assets/bebasperpus/'
        ];
        $this->load->library('upload', $config);

        // Fallback upload KTM
        if (empty($this->input->post('temp_ktm')) && !empty($_FILES['ktm']['name'])) {
            $old_image = $data['bp']['ktm'];
            if ($old_image != 'default.jpg' && !empty($old_image)) {
                @unlink(FCPATH . 'assets/bebasperpus/' . $old_image);
            }
            if ($this->upload->do_upload('ktm')) {
                $ktm = $this->upload->data('file_name');
            } else {
                log_message('error', $this->upload->display_errors());
            }
        }

        // Fallback upload Anggota
        if (empty($this->input->post('temp_anggota')) && !empty($_FILES['anggota']['name'])) {
            $old_kartuanggota = $data['bp']['kartuperpus'];
            if ($old_kartuanggota != 'default.jpg' && !empty($old_kartuanggota)) {
                @unlink(FCPATH . 'assets/bebasperpus/' . $old_kartuanggota);
            }
            if ($this->upload->do_upload('anggota')) {
                $kartu_anggota = $this->upload->data('file_name');
            } else {
                log_message('error', $this->upload->display_errors());
            }
        }

        $this->db->where('nim_mahasiswa', $nim);
        $this->db->set('semester', $this->input->post('semester'));
        $this->db->set('ktm', $ktm);
        $this->db->set('kartuperpus', $kartu_anggota);

        if ($this->input->post('action_type') === 'resubmit') {
            $proses = 'di ajukan';
            date_default_timezone_set('Asia/Jakarta');
            $date = date("Y-m-d H:i:s");

            $this->db->set('status', $proses);
            $this->db->set('keterangan', 'menunggu proses validasi');
            $this->db->set('date_updated', $date);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di KIRIM</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di UPDATE</div>');
        }

        $this->db->update('tb_bebasperpus');
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
