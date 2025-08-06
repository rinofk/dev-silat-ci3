<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berkas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Mahasiswa_model');
        $this->load->model('Berkas_model');
        $this->load->library('pdf');
    }
    public function yudisium()
    {
        $data['title'] = 'Berkas Yudisium';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['ay'] = $this->db->get_where('a_yudisium', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();
        $nim = $data['user']['nim'];
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByJoin($nim);
        $data['ajuan'] = $this->Berkas_model->ajuan($nim);
        // $data['pa'] = $this->Berkas_model->periodeAktif();
        $data['periode'] = $this->db->get_where('a_periode', ['status_periode' => 'Aktif'])->row_array();


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('berkasyudisium/index', $data);
        $this->load->view('templates/footer_a');
    }
    public function tambahyudisium()
    {
        $data['title'] = 'Tambah Berkas Yudisium';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['ay'] = $this->db->get_where('a_yudisium', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();
        $nim = $data['user']['nim'];
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByJoin($nim);
        $data['periode'] = $this->db->get_where('a_periode', ['status_periode' => 'Aktif'])->row_array();


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('berkasyudisium/tambah', $data);
        $this->load->view('templates/footer_a');
    }
    public function yudisium_upload()
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['ay'] = $this->db->get_where('a_yudisium', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();

        $nim = $this->input->post('nim');
        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/arsip/yudisium/';
        $this->load->library('upload', $config);

        // $new_name = ['name'];
        // $config['file_name'] = $new_name;

        $upload_transkrip = $_FILES['transkrip']['name'];
        if ($upload_transkrip) {
            // $old_image = $data['bp']['transkrip'];
            // if ($old_image != 'default.jpg') {
            //     unlink(FCPATH . 'assets/bebasperpus/' . $old_image);
            // }
            if ($this->upload->do_upload('transkrip')) {
                $transkrip = $this->upload->data('file_name');
                $this->db->set('transkrip', $transkrip);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_skripsi = $_FILES['skripsi']['name'];
        if ($upload_skripsi) {
            // $old_skripsi = $data['wisuda']['skripsi'];
            // if ($old_skripsi != 'default.jpg') {
            //     unlink(FCPATH . 'assets/berkaswisuda/' . $old_skripsi);
            // }
            if ($this->upload->do_upload('skripsi')) {
                $skripsi = $this->upload->data('file_name');
                $this->db->set('skripsi', $skripsi);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_ukt = $_FILES['ukt']['name'];
        if ($upload_ukt) {
            // $old_skripsi = $data['wisuda']['skripsi'];
            // if ($old_skripsi != 'default.jpg') {
            //     unlink(FCPATH . 'assets/berkaswisuda/' . $old_skripsi);
            // }
            if ($this->upload->do_upload('ukt')) {
                $ukt = $this->upload->data('file_name');
                $this->db->set('ukt', $ukt);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_bebaslab = $_FILES['bebaslab']['name'];
        if ($upload_bebaslab) {
            // $old_skripsi = $data['wisuda']['skripsi'];
            // if ($old_skripsi != 'default.jpg') {
            //     unlink(FCPATH . 'assets/berkaswisuda/' . $old_skripsi);
            // }
            if ($this->upload->do_upload('bebaslab')) {
                $bebaslab = $this->upload->data('file_name');
                $this->db->set('bebaslab', $bebaslab);
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
            "id_periode" => $this->input->post('id_periode', true),
            "date_created" => $date

        ];
        $this->db->insert('a_yudisium', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di UPDATE</div>');
        redirect('berkas/yudisium/tambah');
    }

    public function yudisium_update()
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('a_yudisium', ['nim_mahasiswa' => $this->session->userdata('nim')])->row_array();

        $nim = $this->input->post('nim');
        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/arsip/yudisium/';
        $this->load->library('upload', $config);

        $upload_transkrip = $_FILES['transkrip']['name'];
        if ($upload_transkrip) {
            $old_image = $data['bp']['transkrip'];
            if ($old_image != 'default.jpg') {
                unlink(FCPATH . 'assets/arsip/yudisium/' . $old_image);
            }
            if ($this->upload->do_upload('transkrip')) {
                $transkrip = $this->upload->data('file_name');
                $this->db->set('transkrip', $transkrip);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_skripsi = $_FILES['skripsi']['name'];
        if ($upload_skripsi) {
            $old_skripsi = $data['bp']['skripsi'];
            if ($old_skripsi != 'default.jpg') {
                unlink(FCPATH . 'assets/arsip/yudisium/' . $old_skripsi);
            }
            if ($this->upload->do_upload('skripsi')) {
                $skripsi = $this->upload->data('file_name');
                $this->db->set('skripsi', $skripsi);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_ukt = $_FILES['ukt']['name'];
        if ($upload_ukt) {
            $old_ukt = $data['bp']['ukt'];
            if ($old_ukt != 'default.jpg') {
                unlink(FCPATH . 'assets/arsip/yudisium/' . $old_ukt);
            }
            if ($this->upload->do_upload('ukt')) {
                $ukt = $this->upload->data('file_name');
                $this->db->set('ukt', $ukt);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_bebaslab = $_FILES['bebaslab']['name'];
        if ($upload_bebaslab) {
            $old_bebaslab = $data['bp']['bebaslab'];
            if ($old_bebaslab != 'default.jpg') {
                unlink(FCPATH . 'assets/arsip/yudisium/' . $old_bebaslab);
            }
            if ($this->upload->do_upload('bebaslab')) {
                $bebaslab = $this->upload->data('file_name');
                $this->db->set('bebaslab', $bebaslab);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->where('nim_mahasiswa', $nim);
        $this->db->set('keterangan', "Tersimpan, Belum Terkirim");
        $this->db->set('id_periode', $this->input->post('id_periode', true));
        $this->db->update('a_yudisium');
        // $date = date("Y-m-d");
        // $data = [
        //     "nim_mahasiswa" => $this->input->post('nim', true),
        //     "semester" => $this->input->post('semester', true),
        //     "date_created" => $date

        // ];
        // $this->db->insert('a_yudisium', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di UPDATE</div>');
        redirect('berkas/yudisium');
    }
    public function ajukanyudisium($nim_mahasiswa)
    {

        // $data['tanggal'] = tanggal();
        // $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_bp);


        $this->Berkas_model->ajukanyudisium($nim_mahasiswa);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di KIRIM</div>');
        redirect('berkas/yudisium');
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
