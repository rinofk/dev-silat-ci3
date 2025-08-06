<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinisbpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Klinik_model');
        $this->load->model('Klinis_model');
        $this->load->library('pdf');
    }
    public function dokter()
    {
        $data['title'] = 'Admin BPP Penagihan Klinik Jejaring';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $data['title'] = 'Praktek Klinik';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinis_model->get_AllDokter();
        $data['kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['klinik'] = $this->Klinik_model->get_Klinik();
        $data['stase'] = $this->Klinik_model->get_Stase();
        // $data['periode'] = $this->Klinik_model->get_Periode();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('nama_klinik', 'Nama Klinik', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/bppdokter', $data);
            $this->load->view('templates/footer_a');
        } else {

            $this->db->insert('pk_klinik', ['nama_klinik' => $this->input->post('nama_klinik'), 'jenis' => $this->input->post('jenis'), 'kontak' => $this->input->post('kontak'), 'alamat' => $this->input->post('alamat'),'prodi_klinik' => $this->input->post('prodi_klinik'), 'status' => $this->input->post('status'), 'date_create'=>$date, 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Periode Added</div>');
            redirect('klinik/jejaring');

        }
    }

    public function detail($id_praktekklinik)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['klinik'] = $this->Klinik_model->get_IdAll($id_praktekklinik);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/praktekbpp_detail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }
    public function update($id_praktekklinik){
        $data['title'] = 'Update Penagihan Klinik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pk'] = $this->Klinik_model->get_All();
        $data['klinik'] = $this->Klinik_model->get_IdAll($id_praktekklinik);
        $data['kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['klinik'] = $this->Klinik_model->get_Klinik();
        $data['stase'] = $this->Klinik_model->get_Stase();
        $data['periode'] = $this->Klinik_model->get_Periode();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        //$data['kelompok'] = $this->db->get('pk_id_kelompok')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'required');
        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Lulus', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinik/praktekbpp_update', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Sklyudis_model->updateSklYudisium($id_alumni);
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('skl/updateyudisium/' . $id_alumni); 
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
    
}
