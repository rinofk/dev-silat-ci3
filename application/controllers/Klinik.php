<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Klinik_model');
        $this->load->library('pdf');
    }
    public function jejaring()
    {
        $data['title'] = 'Klinik Jejaring';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_klinik();
        $data['pkna'] = $this->Klinik_model->get_klinik_nonaktif();
        $data['pka'] = $this->Klinik_model->get_klinik_aktif();
        $data['prodi'] = $this->db->get('prodi')->result_array();


        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('nama_klinik', 'Nama Klinik', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/jejaring', $data);
            $this->load->view('templates/footer_a');
        } else {

            $this->db->insert('pk_klinik', ['nama_klinik' => $this->input->post('nama_klinik'), 'jenis' => $this->input->post('jenis'), 'kontak' => $this->input->post('kontak'), 'alamat' => $this->input->post('alamat'),'prodi_klinik' => $this->input->post('prodi_klinik'), 'status' => $this->input->post('status'), 'date_create'=>$date, 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Periode Added</div>');
            redirect('klinik/jejaring');

           // $keterangan = $this->input->post('keterangan', true);
          //  $this->db->set('keterangan', $keterangan);
          //  $this->db->set('status', 'reject');
           // $this->db->where('id_bw', $this->input->post('id_bw'));
           // $this->db->update('tb_berkaswisuda');
            // $this->db->insert('user_role', ['role' => $this->input->post('role')]);
          //  $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
          //  redirect('adminwisuda/detail');
        }
    }
    public function hapus_klinik($id_klinik){
        
        $data['tanggal'] = tanggal();
        $data['judul'] = 'Hapus Data Klinik';
      //  $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_klinik);
       
        $this->db->where('id_klinik', $id_klinik);
        $this->db->delete('pk_klinik');
        
       $this->session->set_flashdata('flash', 'di HAPUS');
       redirect('klinik/jejaring');
   }
    public function praktek()
    {
        $data['title'] = 'Praktek Klinik';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_All();
        $data['kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['klinik'] = $this->Klinik_model->get_Klinik();
        $data['stase'] = $this->Klinik_model->get_Stase();
        $data['periode'] = $this->Klinik_model->get_Periode();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        //$data['kelompok'] = $this->db->get('pk_id_kelompok')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('id_kelompok', 'ID KELOMPOK', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/praktek', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_praktekklinik', ['id_kelompok' => $this->input->post('id_kelompok'), 'id_klinik' => $this->input->post('id_klinik'),
            'id_stase' => $this->input->post('id_stase'),'id_prodi' => $this->input->post('id_prodi'),
            'date_create'=>$date, 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Praktek Klinik Added</div>');
            redirect('klinik/praktek');

           // $keterangan = $this->input->post('keterangan', true);
            //$this->db->set('keterangan', $keterangan);
           // $this->db->set('status', 'reject');
           // $this->db->where('id_bw', $this->input->post('id_bw'));
            //$this->db->update('tb_berkaswisuda');
            // $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('adminwisuda/detail');
        }
    }

    public function periode()
    {
        $data['title'] = 'Periode Praktek Klinik';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_PeriodeNonAktif();
        $data['pa'] = $this->Klinik_model->get_PeriodeAktif();
        $data['prodi'] = $this->db->get('prodi')->result_array();


        $this->form_validation->set_rules('nama_periode', 'nama_periode', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/periode', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_periode', ['nama_periode' => $this->input->post('nama_periode'),'id_prodi' => $this->input->post('id_prodi'), 
            'tgl_mulai' => $this->input->post('tgl_mulai'), 'tgl_selesai' => $this->input->post('tgl_selesai'), 
            'status' => 'aktif']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Periode Added</div>');
            redirect('klinik/periode');
   
        }
    }

    public function kelompok()
    {
        $data['title'] = 'Kelompok Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_Kelompok();
        $data['id_kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['id_kelompokselesai'] = $this->Klinik_model->get_IdKelompokSelesai();
        $data['id_kelompokaktif'] = $this->Klinik_model->get_IdKelompokAktif();
     //   $data['id_kelompok'] = $this->db->get('pk_id_kelompok')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('nama_kelompok', 'nama_kelompok', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/kelompok', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_id_kelompok', ['nama_kelompok' => $this->input->post('nama_kelompok'), 'id_prodi' => $this->input->post('id_prodi'), 'status' => 'aktif', 'admin' => $this->session->userdata('name'), 'date_create' => $date]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New ID Kelompok Added</div>');
            redirect('klinik/kelompok');
   
        }
    }

    public function kelompokdetail($id_kelompok)
    {
        $data['title'] = 'Kelompok Detail nomor '.$id_kelompok;
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['kd'] = $this->Klinik_model->get_IdKelompokDetail($id_kelompok);
        $data['menu'] = $this->db->get('pk_id_kelompok')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");


        $this->form_validation->set_rules('nim_mahasiswa', 'nim_mahasiswa', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/kelompokdetail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_kelompok', ['id_kelompok' => $this->input->post('id_kelompok'),'nim_mahasiswa' => $this->input->post('nim_mahasiswa'), 'admin' => $this->session->userdata('name'), 'date_create' => $date]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New ID Kelompok Added</div>');
            redirect('klinik/kelompokdetail/'.$id_kelompok);
   
        }
    }
    public function kelompokdetailtambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $date = date("Y-m-d H:i:s");
        $data = [
            'id_kelompok' => $this->input->post('id_kelompok'),
            'nim_mahasiswa' => $this->input->post('nim_mahasiswa'),
            'admin' => $this->session->userdata('name'),
            'date_create' => $date
        ];
        $this->db->insert('pk_kelompok', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('klinik/kelompokdetail/'.$this->input->post('id_kelompok'));
    }

    public function kelompokstatusaktif($id_kelompok)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $status = 'Aktif';
        $data = [
            'status' => $status,
            'admin' => $this->session->userdata('name'),
            'date_update' => $date
        ];
        $this->db->where('id_kelompok', $id_kelompok);
        $this->db->update('pk_id_kelompok', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('klinik/kelompok');
    }
    public function kelompokstatusselesai($id_kelompok)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $status = 'Selesai';
        $data = [
            'status' => $status,
            'admin' => $this->session->userdata('name'),
            'date_update' => $date
        ];
        $this->db->where('id_kelompok', $id_kelompok);
        $this->db->update('pk_id_kelompok', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('klinik/kelompok');
    }
    public function stase()
    {
        $data['title'] = 'Stase';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
       $data['stase'] = $this->Klinik_model->get_Stase();
        // $data['stase'] = $this->db->get('pk_stase')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();


        $this->form_validation->set_rules('nama_stase', 'nama_stase', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/stase', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_stase', ['nama_stase' => $this->input->post('nama_stase'), 'prodi_stase' => $this->input->post('prodi_stase')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New ID Kelompok Added</div>');
            redirect('klinik/stase');
   
        }
    }
}
