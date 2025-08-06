<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinikbpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Klinik_model');
        $this->load->model('Klinis_model');
        $this->load->library('pdf');
    }
    public function index()
    {
        $data['title'] = 'Admin BPP Penagihan Klinik Jejaring';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_All();
        $data['pks'] = $this->Klinik_model->get_AllLunas();
        $data['pkb'] = $this->Klinik_model->get_AllBelum();
    //    $data['kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['klinik'] = $this->Klinik_model->get_Klinik();
        $data['stase'] = $this->Klinik_model->get_Stase();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $data['total_penagihan'] = $this->Klinik_model->hitungJumlahPenagihan();
        $data['total_penagihandokter'] = $this->Klinik_model->hitungJumlahPenagihanDokter();
        $data['total_penagihanapoteker'] = $this->Klinik_model->hitungJumlahPenagihanApoteker();
        $data['total_penagihanners'] = $this->Klinik_model->hitungJumlahPenagihanNers();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

    

        $this->form_validation->set_rules('id_praktekklinik', 'Tanggal Update', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/praktekbpp', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->set('tgl_penagihan', $this->input->post('tgl_penagihan'));
            $this->db->set('tgl_pembayaran', $this->input->post('tgl_pembayaran'));
            $this->db->set('status_pembayaran', $this->input->post('status_pembayaran'));
            $this->db->set('date_update', $date);
            $this->db->where('id_praktekklinik', $this->input->post('id_praktekklinik'));
            $this->db->update('pk_praktekklinik');



          //  $this->db->update('pk_klinik', ['nama_klinik' => $this->input->post('nama_klinik'), 'jenis' => $this->input->post('jenis'), 'kontak' => $this->input->post('kontak'), 'alamat' => $this->input->post('alamat'),'prodi_klinik' => $this->input->post('prodi_klinik'), 'status' => $this->input->post('status'), 'date_create'=>$date, 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Berhasil</div>');
            redirect('klinikbpp');
        }
    }
    public function bppkelompokdetail($id_praktekklinik)
    {
        $data['title'] = 'Kelompok Detail nomor '.$id_praktekklinik;
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['kd'] = $this->Klinis_model->get_IdKelompokDetail($id_praktekklinik);
        $data['pk'] = $this->Klinis_model->get_IdAll($id_praktekklinik);
        $data['prodi'] = $this->db->get('prodi')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");


        $this->form_validation->set_rules('nim_mahasiswa', 'nim_mahasiswa', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/bppkelompokdetail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_kelompok', ['id_praktekklinik' => $this->input->post('id_praktekklinik'),'nim_mahasiswa' => $this->input->post('nim_mahasiswa'), 'admin' => $this->session->userdata('name'), 'date_create' => $date]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New ID Kelompok Added</div>');
            redirect('klinis/kelompokdetail/'.$id_praktekklinik);
   
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
   
   public function dokter()
    {
        $data['title'] = 'Admin BPP Penagihan Klinik Jejaring Profesi Dokter';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_All();
        $data['pks'] = $this->Klinik_model->get_AllLunas();
        $data['pkb'] = $this->Klinik_model->get_AllBelum();
        // $data['kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['pkd'] = $this->Klinis_model->get_AllDokter();
        $data['pkds'] = $this->Klinis_model->get_AllDokterSelesai();

        $data['klinik'] = $this->Klinik_model->get_Klinik();
        $data['stase'] = $this->Klinik_model->get_Stase();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $data['total_penagihan'] = $this->Klinik_model->hitungJumlahPenagihan();
        $data['total_penagihandokter'] = $this->Klinik_model->hitungJumlahPenagihanDokter();
        $data['total_penagihanapoteker'] = $this->Klinik_model->hitungJumlahPenagihanApoteker();
        $data['total_penagihanners'] = $this->Klinik_model->hitungJumlahPenagihanNers();



        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");



        $this->form_validation->set_rules('id_praktekklinik', 'Tanggal Update', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/bppdokter', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->set('tgl_penagihan', $this->input->post('tgl_penagihan'));
            $this->db->set('tgl_pembayaran', $this->input->post('tgl_pembayaran'));
            $this->db->set('status_pembayaran', $this->input->post('status_pembayaran'));
            $this->db->set('date_update', $date);
            $this->db->where('id_praktekklinik', $this->input->post('id_praktekklinik'));
            $this->db->update('pk_praktekklinik');



            //  $this->db->update('pk_klinik', ['nama_klinik' => $this->input->post('nama_klinik'), 'jenis' => $this->input->post('jenis'), 'kontak' => $this->input->post('kontak'), 'alamat' => $this->input->post('alamat'),'prodi_klinik' => $this->input->post('prodi_klinik'), 'status' => $this->input->post('status'), 'date_create'=>$date, 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Berhasil</div>');
            redirect('klinikbpp/dokter');
        }
    }

    public function apoteker()
    {
        $data['title'] = 'Admin BPP Penagihan Klinik Jejaring Profesi Apoteker';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_All();
        $data['pks'] = $this->Klinik_model->get_AllLunas();
        $data['pkb'] = $this->Klinik_model->get_AllBelum();
        // $data['kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['pkd'] = $this->Klinis_model->get_AllApt();
        $data['pkds'] = $this->Klinis_model->get_AllAptSelesai();

        $data['klinik'] = $this->Klinik_model->get_Klinik();
        $data['stase'] = $this->Klinik_model->get_Stase();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $data['total_penagihan'] = $this->Klinik_model->hitungJumlahPenagihan();
        $data['total_penagihandokter'] = $this->Klinik_model->hitungJumlahPenagihanDokter();
        $data['total_penagihanapoteker'] = $this->Klinik_model->hitungJumlahPenagihanApoteker();
        $data['total_penagihanners'] = $this->Klinik_model->hitungJumlahPenagihanNers();



        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");



        $this->form_validation->set_rules('id_praktekklinik', 'Tanggal Update', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/bppapoteker', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->set('tgl_penagihan', $this->input->post('tgl_penagihan'));
            $this->db->set('tgl_pembayaran', $this->input->post('tgl_pembayaran'));
            $this->db->set('status_pembayaran', $this->input->post('status_pembayaran'));
            $this->db->set('date_update', $date);
            $this->db->where('id_praktekklinik', $this->input->post('id_praktekklinik'));
            $this->db->update('pk_praktekklinik');



            //  $this->db->update('pk_klinik', ['nama_klinik' => $this->input->post('nama_klinik'), 'jenis' => $this->input->post('jenis'), 'kontak' => $this->input->post('kontak'), 'alamat' => $this->input->post('alamat'),'prodi_klinik' => $this->input->post('prodi_klinik'), 'status' => $this->input->post('status'), 'date_create'=>$date, 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Berhasil</div>');
            redirect('klinikbpp/apoteker');
        }
    }

    public function ners()
    {
        $data['title'] = 'Admin BPP Penagihan Klinik Jejaring Profesi Ners';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pk'] = $this->Klinik_model->get_All();
        $data['pks'] = $this->Klinik_model->get_AllLunas();
        $data['pkb'] = $this->Klinik_model->get_AllBelum();
        // $data['kelompok'] = $this->Klinik_model->get_IdKelompokAll();
        $data['pkd'] = $this->Klinis_model->get_AllNers();
        $data['pkds'] = $this->Klinis_model->get_AllNersSelesai();

        $data['klinik'] = $this->Klinik_model->get_Klinik();
        $data['stase'] = $this->Klinik_model->get_Stase();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $data['total_penagihan'] = $this->Klinik_model->hitungJumlahPenagihan();
        $data['total_penagihandokter'] = $this->Klinik_model->hitungJumlahPenagihanDokter();
        $data['total_penagihanapoteker'] = $this->Klinik_model->hitungJumlahPenagihanApoteker();
        $data['total_penagihanners'] = $this->Klinik_model->hitungJumlahPenagihanNers();



        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");



        $this->form_validation->set_rules('id_praktekklinik', 'Tanggal Update', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/bppners', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->set('tgl_penagihan', $this->input->post('tgl_penagihan'));
            $this->db->set('tgl_pembayaran', $this->input->post('tgl_pembayaran'));
            $this->db->set('status_pembayaran', $this->input->post('status_pembayaran'));
            $this->db->set('date_update', $date);
            $this->db->where('id_praktekklinik', $this->input->post('id_praktekklinik'));
            $this->db->update('pk_praktekklinik');



            //  $this->db->update('pk_klinik', ['nama_klinik' => $this->input->post('nama_klinik'), 'jenis' => $this->input->post('jenis'), 'kontak' => $this->input->post('kontak'), 'alamat' => $this->input->post('alamat'),'prodi_klinik' => $this->input->post('prodi_klinik'), 'status' => $this->input->post('status'), 'date_create'=>$date, 'admin' => $this->session->userdata('name')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Berhasil</div>');
            redirect('klinikbpp/ners');
        }
    }
    
     public function kwitansi_update($id_praktekklinik)
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('pk_praktekklinik', ['id_praktekklinik' => $id_praktekklinik])->row_array();
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/klinis/kwitansi/';
        $new_name = 'Kwintansi_' . $id_praktekklinik;
        $config['file_name'] = $new_name;
        $config['overwrite'] = true;
        $this->load->library('upload', $config);

        $upload_kwitansi = $_FILES['kwitansi']['name'];
        if ($upload_kwitansi) {
            $old_image = $data['bp']['kwitansi'];
            if ($old_image != 'default.jpg') {
                unlink(FCPATH . 'assets/klinis/kwitansi/' . $old_image);
            }
            if ($this->upload->do_upload('kwitansi')) {
                $kwitansi = $this->upload->data('file_name');
                $this->db->set('kwitansi', $kwitansi);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->where('id_praktekklinik', $id_praktekklinik);
        $this->db->set('date_update', $date);
        $this->db->update('pk_praktekklinik');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kwintasi Berhasil di UPDATE</div>');
        redirect('klinikbpp/bppkelompokdetail/' . $id_praktekklinik);
    }
}
