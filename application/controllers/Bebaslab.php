<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bebaslab extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Bebaslab_model');
        $this->load->model('Mahasiswa_model');
    }

    // ===============================
    // INDEX + FILTER
    // ===============================
    public function index()
    {
        $data['title'] = 'Bebas Laboratorium';

        // User login
        $data['user'] = $this->db->get_where('user', [
            'nim' => $this->session->userdata('nim')
        ])->row_array();

        // Ambil semua tahun
        $tahunList = $this->Bebaslab_model->getTahunList();
        $data['daftar_tahun'] = $tahunList;

        // Tentukan default tahun = tahun terbaru
        $defaultTahun = !empty($tahunList) ? $tahunList[0] : date('Y');

        // GET Parameter Filter
        $filter_prodi  = $this->input->get('prodi');
        $filter_tahun  = $this->input->get('tahun') ? $this->input->get('tahun') : $defaultTahun;
        $filter_status = $this->input->get('status');

        // Kirim ke View
        $data['filter_prodi']  = $filter_prodi;
        $data['filter_tahun']  = $filter_tahun;
        $data['filter_status'] = $filter_status;

        // Dropdown Prodi
        $data['daftar_prodi'] = $this->db->get('prodi')->result();

        $stats = $this->Bebaslab_model->getStatistik($filter_prodi, $filter_tahun);
        $data['total_pengajuan'] = $stats['diajukan'];
        $data['total_selesai'] = $stats['accept'];
        $data['total_ditolak']   = $stats['reject'];
        $data['total_proses']  = $stats['proses'];
        $data['total_semua']     = $stats['total'];

        // ======== DATA UTAMA PADA TAB "PENGAJUAN" =========
        $data['pengajuan'] = $this->Bebaslab_model->getFiltered(
            $filter_prodi,
            $filter_tahun,
            'di ajukan'
        );

        // ======== DATA UTAMA TAB "Proses" =========
        $data['proses'] = $this->Bebaslab_model->getFiltered(
            $filter_prodi,
            $filter_tahun,
            'proses'
        );
        // ======== DATA UTAMA TAB "SELESAI" =========
        $data['selesai'] = $this->Bebaslab_model->getFiltered(
            $filter_prodi,
            $filter_tahun,
            'accept'
        );
        // ======== DATA UTAMA TAB "Reject" =========
        $data['reject'] = $this->Bebaslab_model->getFiltered(
            $filter_prodi,
            $filter_tahun,
            'reject'
        );

        // ======== STATISTIK CARD =========
        $data['statistik'] = $this->Bebaslab_model->getStatistik(
            $filter_prodi,
            $filter_tahun
        );

        $data['blacklist'] = [];
        $data['total_blacklist'] = 0;

        // Load view
        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bebaslab/baru/index', $data);
        $this->load->view('templates/footer_a');
    }

    // ===============================
    // AJAX — Statistik Card
    // ===============================
    public function get_statistik()
    {
        $prodi = $this->input->post('prodi');
        $tahun = $this->input->post('tahun');

        $data = $this->Bebaslab_model->getStatistik($prodi, $tahun);

        echo json_encode($data);
    }

    // ===============================
    // AJAX — Data Tabel Berdasarkan Filter
    // ===============================
    public function get_data()
    {
        $prodi  = $this->input->post('prodi');
        $tahun  = $this->input->post('tahun');
        $status = $this->input->post('status');

        $data = $this->Bebaslab_model->getFiltered(
            $prodi,
            $tahun,
            $status
        );

        echo json_encode($data);
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit($id)
    {
        $data['title'] = "Edit Pengajuan Bebas Lab";
        $data['data']  = $this->Bebaslab_model->getById($id);

        $this->load->view('operator/layout/header', $data);
        $this->load->view('operator/bebaslab/edit', $data);
        $this->load->view('operator/layout/footer');
    }

    public function update()
    {
        $id = $this->input->post('id_bebaslab');

        $update = [
            'semester'   => $this->input->post('semester'),
            'status'     => $this->input->post('status'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $this->db->where('id_bebaslab', $id)->update('tb_bebaslab', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Data berhasil diperbarui!</div>'
        );

        redirect('bebaslab?prodi=' . $this->input->post('prodi'));
    }

    // ===============================
    // VALIDASI AJUKAN
    // ===============================
    public function ajukan($id)
    {
        $this->db->where('id_bebaslab', $id)->update(
            'tb_bebaslab',
            ['status' => 'di ajukan']
        );

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Pengajuan berhasil dikirim!</div>'
        );

        redirect($_SERVER['HTTP_REFERER']);
    }

    // ===============================
    // DETAIL VERIFIKASI
    // ===============================
    public function detail($id)
    {
        $data['title'] = 'Detail Bebas Laboratorium';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['bl'] = $this->Bebaslab_model->getById($id);

        if (!$data['bl']) {
            show_404();
        }

        // Generate nomor surat otomatis
        $data['tahun'] = date('Y', strtotime($data['bl']->date_updated ? $data['bl']->date_updated : $data['bl']->date_created));
        $nomor_surat = $this->db->get_where('tb_nomorsurat', ['id_nomor' => 6])->row_array();
        
        $nomor_base = $nomor_surat ? $nomor_surat['nomor'] : '';
        if (!empty($nomor_base)) {
            // 1. Check/Add /DST prefix safely
            if (stripos($nomor_base, 'DST') === false) {
                if (substr($nomor_base, 0, 1) === '/') {
                    $nomor_base = '/DST' . $nomor_base;
                } else {
                    $nomor_base = '/DST/' . $nomor_base;
                }
            } else {
                if (substr($nomor_base, 0, 1) !== '/') {
                    $nomor_base = '/' . $nomor_base;
                }
            }
            
            // 2. Check/Add year suffix safely
            $tahun_suffix = $data['tahun'];
            if (substr($nomor_base, -strlen($tahun_suffix)) !== $tahun_suffix) {
                if (substr($nomor_base, -1) !== '/') {
                    $nomor_base = $nomor_base . '/' . $tahun_suffix;
                } else {
                    $nomor_base = $nomor_base . $tahun_suffix;
                }
            }
        }
        $data['nomor_otomatis'] = $nomor_base;

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bebaslab/baru/detail', $data);
        $this->load->view('templates/footer_a');
    }

    // ===============================
    // VALIDASI PROSES
    // ===============================
    public function proses($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $update = [
            'status'       => 'proses',
            'date_updated' => date("Y-m-d H:i:s")
        ];

        $this->db->where('id_bebaslab', $id)->update('tb_bebaslab', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Status berhasil diubah menjadi Proses!</div>'
        );

        redirect('bebaslab/detail/' . $id);
    }

    // ===============================
    // VALIDASI ACCEPT
    // ===============================
    public function accept($id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $update = [
            'status'         => 'accept',
            'nomor'          => $this->input->post('nomor', true),
            'keterangan'     => 'Validasi Lengkap',
            'date_finished'  => date("Y-m-d H:i:s"),
            'berlaku_sampai' => date("Y-m-d", strtotime("+90 days")),
            'lab1_admin'     => $this->session->userdata('name')
        ];

        $this->db->where('id_bebaslab', $id)->update('tb_bebaslab', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Validasi selesai! Status diterima.</div>'
        );

        redirect('bebaslab/detail/' . $id);
    }

    // ===============================
    // VALIDASI REJECT
    // ===============================
    public function reject($id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $update = [
            'status'       => 'reject',
            'keterangan'   => $this->input->post('keterangan', true),
            'date_updated' => date("Y-m-d H:i:s")
        ];

        $this->db->where('id_bebaslab', $id)->update('tb_bebaslab', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger">Pengajuan berhasil ditolak (Reject).</div>'
        );

        redirect('bebaslab');
    }

    // ===============================
    // CETAK PDF
    // ===============================
    public function cetak($id)
    {
        $this->load->library('pdf');

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';

        // Ambil data bebaslab secara lengkap (menggunakan array untuk disesuaikan dengan view cetak)
        $this->db->select('tb_bebaslab.*, mahasiswa.*, prodi.nama_prodi, prodi.slug, user.email');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim = mahasiswa.nim', 'left');
        $this->db->where('tb_bebaslab.id_bebaslab', $id);
        $data['bp'] = $this->db->get()->row_array();

        if (!$data['bp']) {
            show_404();
        }

        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '6'])->row_array();

        // Generate QR code for TTE
        $verification_url = base_url('verify/bebaslab/' . $id);
        include_once APPPATH . '../assets/phpqrcode/qrlib.php';
        $qr_path = 'assets/qrcode/';
        $qr_file = $qr_path . 'bebaslab_' . $id . '.png';
        if (!file_exists($qr_file)) {
            QRcode::png($verification_url, $qr_file, QR_ECLEVEL_H, 4);
        }
        $data['qr_file'] = $qr_file;

        $prodi_id = $data['bp']['prodi_id'];

        if ($prodi_id == '1' || $prodi_id == '6') {
            $this->load->view('bebaslab/cetak1', $data);
        } elseif ($prodi_id == '2') {
            $this->load->view('bebaslab/cetak2', $data);
        } elseif ($prodi_id == '3') {
            $this->load->view('bebaslab/cetak3', $data);
        } elseif ($prodi_id == '5') {
            $this->load->view('bebaslab/cetak4', $data);
        } else {
            show_404();
        }
    }

    // ===============================
    // DELETE
    // ===============================
    public function delete($id)
    {
        $this->db->delete('tb_bebaslab', ['id_bebaslab' => $id]);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger">Data berhasil dihapus!</div>'
        );

        redirect($_SERVER['HTTP_REFERER']);
    }
}
