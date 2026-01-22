<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        //        $this->load->model('Mahasiswa_model');
        $this->load->model('Surat_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }
    public function index()
    {
        $data['title'] = 'Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['surat'] = $this->Surat_model->getSuratByNim($id);

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
                $this->load->view('surat/index', $data);
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
    public function tambah()
    {
        $data['title'] = 'Form Tambah Data Pengajuan Surat';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['surat'] = $this->Surat_model->getSuratById($id);
        $data['keperluan'] = $this->db->get('keperluan')->result_array();
        //  $data['prodi'] = $this->db->get('prodi')->result_array();
        //   $data['surat'] = $this->db->get('tb_suratpengajuan')->result_array();


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required');
        // $this->form_validation->set_rules('ktm', 'KTM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/tambah');
            $this->load->view('templates/footer_a');
        } else {

            // $this->Surat_model->tambahPengajuanSurat();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            $result = $this->Surat_model->tambahPengajuanSurat();

            if ($result === false) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">
                    Upload gagal. Gunakan file dari folder Download HP.
                </div>'
                );
                redirect('surat/tambah');
                return;
            }

            redirect('surat');
        }
    }
    public function edit($id_suratpengajuan)
    {
        $data['title'] = 'Form Ubah Data Pengajuan Surat';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['surat'] = $this->Surat_model->getSuratByIdPengajuan($id_suratpengajuan);
        $data['keperluan'] = $this->db->get('keperluan')->result_array();
        //  $data['prodi'] = $this->db->get('prodi')->result_array();
        //   $data['surat'] = $this->db->get('tb_suratpengajuan')->result_array();


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required');
        // $this->form_validation->set_rules('ktm', 'KTM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/ubah', $data);
            $this->load->view('templates/footer_a');
        } else {

            $this->Surat_model->ubahPengajuanSurat();
            $this->session->set_flashdata('flash', 'di Ubah');
            redirect('surat');
        }
    }
    public function kirim($id_suratpengajuan)
    {
        $data = [

            "status" => 'diajukan'
        ];

        $this->db->where('id_suratpengajuan', $id_suratpengajuan);
        $this->db->update('tb_suratpengajuan', $data);
        $this->session->set_flashdata('flash', 'di Kirim');
        redirect('surat');
    }
    public function hapus($id_suratpengajuan)
    {
        $this->db->where('id_suratpengajuan', $id_suratpengajuan);
        $this->db->delete('tb_suratpengajuan');
        $this->session->set_flashdata('flash', 'di Hapus');
        redirect('surat');
    }
    // public function cetaktransaksi($id_suratpengajuan)
    // {

    //     $data['tanggal'] = tanggal();
    //     $data['judul'] = 'PDF Data Mahasiswa';
    //     $data['surat'] = $this->Transaksi_model->getSuratAktifKuliahById($id_suratpengajuan);
    //     $keperluan = $this->db->get_where('tb_suratpengajuan', ['id_suratpengajuan' => $id_suratpengajuan])->row_array();

    //     $this->form_validation->set_rules('nim', 'NIM', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //         if ($keperluan['keperluan'] == '1') {
    //             $this->load->view('transaksi/cetaksurat', $data);
    //         } else {
    //             if ($keperluan['keperluan'] == '2') {
    //                 //   $this->load->view('mahasiswa/kop', $data);
    //                 $this->load->view('transaksi/cetaksurat', $data);
    //                 //  $this->load->view('templates/footer');
    //             } else {
    //                 $this->load->view('transaksi/cetaksuratv2', $data);
    //             }
    //         }
    //     } else {
    //         $this->Mahasiswa_model->tambahDataMahasiswa();
    //         $this->session->set_flashdata('flash', 'Ditambahkan');
    //         redirect('transaksi');
    //     }
    // }


    // public function cetak($id_suratpengajuan)
    // {

    //     $data['tanggal'] = tanggal();
    //     $data['judul'] = 'PDF Data Mahasiswa';
    //     $data['surat'] = $this->Surat_model->getSuratAktifKuliahById($id_suratpengajuan);

    //     $this->form_validation->set_rules('nim', 'NIM', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('surat/cetak', $data);
    //     } else {
    //         $this->Mahasiswa_model->tambahDataMahasiswa();
    //         $this->session->set_flashdata('flash', 'Ditambahkan');
    //         redirect('transaksi');
    //     }
    // }

    public function cetaksurat($id_suratpengajuan)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Surat_model->getSuratAktifKuliahById($id_suratpengajuan);
        $keperluan = $this->db->get_where('tb_suratpengajuan', ['id_suratpengajuan' => $id_suratpengajuan])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            if ($keperluan['keperluan'] == '1') {
                $this->load->view('surat/cetaksurat', $data);
            } else {
                if ($keperluan['keperluan'] == '2') {
                    $this->load->view('surat/cetaksurat', $data);
                } else {
                    $this->load->view('surat/cetaksuratv2', $data);
                }
            }
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('transaksi');
        }
    }



    //Naskah Publikasi
    public function naskahpublikasi()
    {
        $data['title'] = 'Naskah Publikasi';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['naspub'] = $this->Surat_model->getNaspub($id);

        // echo 'Selamat Datang User ' . $data['user']['name'];


        $aktif = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        if ($aktif['status_aktif'] == 1) {

            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header_a', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('surat/naskahpublikasi', $data);
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

    public function tambahnaspub()
    {
        $data['title'] = 'Form Tambah Data Pengajuan Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['nim'];
        $data['naspub'] = $this->Surat_model->getNaspub($id);
        //  $data['prodi'] = $this->db->get('prodi')->result_array();
        //   $data['surat'] = $this->db->get('tb_suratpengajuan')->result_array();


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('judul_naspub', 'Judul Naskah Publikasi', 'required');
        $this->form_validation->set_rules('abstrack', 'Abstrack', 'required');
        $this->form_validation->set_rules('pembimbing', 'Pembimbing Utama', 'required');
        $this->form_validation->set_rules('nip', 'NIP/ NIDK', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/tambahnaspub');
            $this->load->view('templates/footer_a');
        } else {
            $this->Surat_model->tambahnaspub();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }

    public function cetaknaspub($id_naspub)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['naspub'] = $this->Surat_model->getBarcode($id_naspub);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '1'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '4'])->row_array();

        $this->load->view('surat/cetaknaspub', $data);
    }

    public function cetakbarcode($id_naspub)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['barcode'] = $this->Surat_model->getBarcode($id_naspub);

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('surat/cetakbarcode', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }

    public function updatenaspub($id_naspub)
    {

        $data['title'] = 'Form Update Data Pengajuan Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['nim'];
        $data['np'] = $this->Surat_model->getNaspub_byid($id_naspub);


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/updatenaspub', $data);
            $this->load->view('templates/footer_a');
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }

    public function do_updatenaspub($id_naspub)
    {
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['np'] = $this->Surat_model->getNaspub_byid($id_naspub);

        $nim = $this->input->post('nim');
        //cek jika ada gambar yang akan di upload
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '4148';
        $config['upload_path'] = './assets/naspub/';
        $config['file_name'] = 'jurnal_' . $this->input->post('nim');
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        $upload_naspub = $_FILES['naspub']['name'];
        if ($upload_naspub) {
            // $old_image = $data['bp']['ktm'];
            // if ($old_image != 'default.jpg') {
            //     unlink(FCPATH . 'assets/bebasperpus/' . $old_image);
            // }
            if ($this->upload->do_upload('naspub')) {
                $naspub = $this->upload->data('file_name');
                $this->db->set('naspub', $naspub);
            } else {
                echo $this->upload->display_errors();
            }
        }

        // $upload_kartuanggota = $_FILES['anggota']['name'];
        // if ($upload_kartuanggota) {
        //     $old_kartuanggota = $data['bp']['kartuanggota'];
        //     if ($old_kartuanggota != 'default.jpg') {
        //         unlink(FCPATH . 'assets/bebasperpus/' . $old_kartuanggota);
        //     }
        //     if ($this->upload->do_upload('anggota')) {
        //         $kartu_anggota = $this->upload->data('file_name');
        //         $this->db->set('kartuperpus', $kartu_anggota);
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $this->db->where('id_naspub', $id_naspub);
        $this->db->set('status', 'diajukan');
        $this->db->set('date_updated', $date);
        $this->db->set('ket', 'perbaikan');
        $this->db->update('tb_naspub');
        // $date = date("Y-m-d");
        // $data = [
        //     "nim_mahasiswa" => $this->input->post('nim', true),
        //     "semester" => $this->input->post('semester', true),
        //     "date_created" => $date

        // ];
        // $this->db->insert('tb_bebasperpus', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berkas Anda Berhasil di UPDATE</div>');
        redirect('surat/naskahpublikasi');
    }


    // Studi Pendahuluan

    public function studipendahuluan()
    {
        $data['title'] = 'Studi Pendahuluan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['nim'];
        $data['naspub'] = $this->Surat_model->getStudip($id);

        $aktif = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        if ($aktif['status_aktif'] == 1) {

            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header_a', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('surat/studipendahuluan', $data);
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

    public function tambahstudip()
    {
        $data['title'] = 'Form Tambah Data Pengajuan Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['nim'];
        $data['naspub'] = $this->Surat_model->getNaspub($id);
        //  $data['prodi'] = $this->db->get('prodi')->result_array();
        //   $data['surat'] = $this->db->get('tb_suratpengajuan')->result_array();


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/tambahstudip');
            $this->load->view('templates/footer_a');
        } else {
            $this->Surat_model->tambahstudip();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/studipendahuluan');
        }
    }

    public function cetakpengantarstudipendahuluan($id_studip)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['studip'] = $this->Surat_model->getAllStudip($id_studip);

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('surat/cetakpengantarstudip', $data);
        } else {

            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('surat/naskahpublikasi');
        }
    }
}
