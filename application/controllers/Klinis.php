<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Klinis_model');
        $this->load->library('pdf');
    }
    
    public function dokter()
    {
        $data['title'] = 'Praktek Klinik';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pkd'] = $this->Klinis_model->get_AllDokter();
        $data['pkds'] = $this->Klinis_model->get_AllDokterSelesai();
    //    $data['kelompok'] = $this->Klinis_model->get_IdKelompokAll();
        $data['klinis'] = $this->Klinis_model->get_KlinisDokter();
        $data['stase'] = $this->Klinis_model->get_StaseDokter();
    //    $data['periode'] = $this->Klinis_model->get_Periode();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        //$data['kelompok'] = $this->db->get('pk_id_kelompok')->result_array();


        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('id_klinik', 'ID KLINIS', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/praktekdokter', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_praktekklinik', ['id_klinik' => $this->input->post('id_klinik'),
            'id_stase' => $this->input->post('id_stase'), 'tgl_mulai' => $this->input->post('tgl_mulai'), 'tgl_selesai' => $this->input->post('tgl_selesai'),'id_prodi' => 6,
            'date_create'=>$date, 'admin' => $this->session->userdata('name'), 'status_stase' => 'aktif']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Praktek Klinik Added</div>');
            redirect('klinis/dokter');

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

    public function apoteker()
    {
        $data['title'] = 'Praktek Klinik';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pkd'] = $this->Klinis_model->get_AllApt();
        $data['pkds'] = $this->Klinis_model->get_AllAptSelesai();
        // $data['kelompok'] = $this->Klinis_model->get_IdKelompokAll();
        $data['klinis'] = $this->Klinis_model->get_KlinisApoteker();
        $data['stase'] = $this->Klinis_model->get_StaseApoteker();
    //    $data['periode'] = $this->Klinis_model->get_Periode();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('id_klinik', 'ID KLINIS', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/praktekapoteker', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_praktekklinik', ['id_klinik' => $this->input->post('id_klinik'),
            'id_stase' => $this->input->post('id_stase'), 'tgl_mulai' => $this->input->post('tgl_mulai'), 'tgl_selesai' => $this->input->post('tgl_selesai'),'id_prodi' => 4,
            'date_create'=>$date, 'admin' => $this->session->userdata('name'), 'status_stase' => 'aktif']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Praktek Klinik Added</div>');
            redirect('klinis/apoteker');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('adminwisuda/detail');
        }
    }

    public function ners()
    {
        $data['title'] = 'Praktek Klinik';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['pkd'] = $this->Klinis_model->get_AllNers();
        $data['pkds'] = $this->Klinis_model->get_AllNersSelesai();
    //    $data['kelompok'] = $this->Klinis_model->get_IdKelompokAll();
        $data['klinis'] = $this->Klinis_model->get_KlinisNers();
        $data['stase'] = $this->Klinis_model->get_StaseNers();
    //    $data['periode'] = $this->Klinis_model->get_Periode();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        //$data['kelompok'] = $this->db->get('pk_id_kelompok')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('id_klinik', 'ID KLINIS', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/praktekners', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_praktekklinik', ['id_klinik' => $this->input->post('id_klinik'),
            'id_stase' => $this->input->post('id_stase'), 'tgl_mulai' => $this->input->post('tgl_mulai'), 'tgl_selesai' => $this->input->post('tgl_selesai'),'id_prodi' => 5,
            'date_create'=>$date, 'admin' => $this->session->userdata('name'), 'status_stase' => 'aktif']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Praktek Klinik Added</div>');
            redirect('klinis/ners');

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


    public function kelompokdetail($id_praktekklinik)
    {
        $data['title'] = 'Kelompok Detail<br>ID - '.$id_praktekklinik;
        $data['id_praktekklinik'] = $id_praktekklinik;

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['kd'] = $this->Klinis_model->get_IdKelompokDetail($id_praktekklinik);
        // $data['menu'] = $this->db->get('pk_id_kelompok')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['pk'] = $this->Klinis_model->get_IdAll($id_praktekklinik);


        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");


        $this->form_validation->set_rules('nim_mahasiswa', 'nim_mahasiswa', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/kelompokdetail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_kelompok', ['id_praktekklinik' => $this->input->post('id_praktekklinik'),'nim_mahasiswa' => $this->input->post('nim_mahasiswa'), 'admin' => $this->session->userdata('name'), 'date_create' => $date]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New ID Kelompok Added</div>');
            redirect('klinis/kelompokdetail/'.$id_praktekklinik);
   
        }
    }

    public function kelompokdetailoff($id_praktekklinik)
    {
        $data['title'] = 'Kelompok Detail nomor '.$id_praktekklinik;
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['kd'] = $this->Klinis_model->get_IdKelompokDetail($id_praktekklinik);
        // $data['menu'] = $this->db->get('pk_id_kelompok')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['pk'] = $this->Klinis_model->get_IdAll($id_praktekklinik);

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");


        $this->form_validation->set_rules('nim_mahasiswa', 'nim_mahasiswa', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/kelompokdetailoff', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_kelompok', ['id_praktekklinik' => $this->input->post('id_praktekklinik'),'nim_mahasiswa' => $this->input->post('nim_mahasiswa'), 'admin' => $this->session->userdata('name'), 'date_create' => $date]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New ID Kelompok Added</div>');
            redirect('klinis/kelompokdetail/'.$id_praktekklinik);
   
        }
    }


    public function updatedokter()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $status = 'Selesai';
        $data = [
            'id_klinik' => $this->input->post('id_klinik'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_selesai' => $this->input->post('tgl_selesai'),
            'id_stase' => $this->input->post('id_stase'),
            'admin' => $this->session->userdata('name'),
            'date_update' => $date
        ];
        $this->db->where('id_praktekklinik', $this->input->post('id_praktekklinik'));
        $this->db->update('pk_praktekklinik', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('klinis/dokter');
    }

    public function updateapt()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $status = 'Selesai';
        $data = [
            'id_klinik' => $this->input->post('id_klinik'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_selesai' => $this->input->post('tgl_selesai'),
            'id_stase' => $this->input->post('id_stase'),
            'admin' => $this->session->userdata('name'),
            'date_update' => $date
        ];
        $this->db->where('id_praktekklinik', $this->input->post('id_praktekklinik'));
        $this->db->update('pk_praktekklinik', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('klinis/apoteker');
    }

    public function updateners()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $status = 'Selesai';
        $data = [
            'id_klinik' => $this->input->post('id_klinik'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_selesai' => $this->input->post('tgl_selesai'),
            'id_stase' => $this->input->post('id_stase'),
            'admin' => $this->session->userdata('name'),
            'date_update' => $date
        ];
        $this->db->where('id_praktekklinik', $this->input->post('id_praktekklinik'));
        $this->db->update('pk_praktekklinik', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('klinis/ners');
    }
    
    public function kelompokdetailtambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $date = date("Y-m-d H:i:s");
        $data = [
            'id_praktekklinik' => $this->input->post('id_praktekklinik'),
            'nim_mahasiswa' => $this->input->post('nim_mahasiswa'),
            'admin' => $this->session->userdata('name'),
            'date_create' => $date
        ];
        $this->db->insert('pk_kelompok', $data);

        $this->session->set_flashdata('flash', 'di TOLAK');
        redirect('klinis/kelompokdetail/'.$this->input->post('id_praktekklinik'));
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
    
     public function hapus_mahasiswa($id_kelompok){
        
        $data['tanggal'] = tanggal();
        $data['judul'] = 'Hapus Data Klinik';
       
        $this->db->where('id_kelompok', $id_kelompok);
        $this->db->delete('pk_kelompok');
        
       $this->session->set_flashdata('flash', 'di HAPUS');
       redirect('klinis/dokter');
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
    
     public function pengantar_update($id_praktekklinik)
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bp'] = $this->db->get_where('pk_praktekklinik', ['id_praktekklinik' => $id_praktekklinik])->row_array();
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/klinis/pengantar/';
        $new_name = 'Pengantar_' . $id_praktekklinik;
        $config['file_name'] = $new_name;
        $config['overwrite'] = true;
        $this->load->library('upload', $config);

        $upload_pengantar = $_FILES['pengantar']['name'];
        if ($upload_pengantar) {
            $old_image = $data['bp']['pengantar'];
            if ($old_image != 'default.jpg') {
                unlink(FCPATH . 'assets/klinis/pengantar/' . $old_image);
            }
            if ($this->upload->do_upload('pengantar')) {
                $pengantar = $this->upload->data('file_name');
                $this->db->set('pengantar', $pengantar);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->where('id_praktekklinik', $id_praktekklinik);
        $this->db->set('date_update', $date);
        $this->db->update('pk_praktekklinik');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengantar Berhasil di UPDATE</div>');
        redirect('klinis/kelompokdetail/' . $id_praktekklinik);
    }
}
