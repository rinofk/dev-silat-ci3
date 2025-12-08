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
        $data['title'] = 'Bebas Lab';

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

        // ======== DATA UTAMA PADA TAB "PENGAJUAN" =========
        $data['pengajuan'] = $this->Bebaslab_model->getFiltered(
            $filter_prodi,
            $filter_tahun,
            'di ajukan'
        );

        // ======== DATA UTAMA TAB "SELESAI" =========
        $data['selesai'] = $this->Bebaslab_model->getFiltered(
            $filter_prodi,
            $filter_tahun,
            'accept'
        );

        // ======== STATISTIK CARD =========
        $data['statistik'] = $this->Bebaslab_model->getStatistik(
            $filter_prodi,
            $filter_tahun
        );

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
    // VALIDASI ACCEPT
    // ===============================
    public function accept($id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $update = [
            'status'        => 'accept',
            'nomor_surat'   => $this->input->post('nomor'),
            'tanggal_surat' => date("Y-m-d"),
            'masa_berlaku'  => date("Y-m-d", strtotime("+90 days")),
            'validated_by'  => $this->session->userdata('name'),
        ];

        $this->db->where('id_bebaslab', $id)->update('tb_bebaslab', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Validasi selesai!</div>'
        );

        redirect($_SERVER['HTTP_REFERER']);
    }

    // ===============================
    // CETAK PDF
    // ===============================
    public function cetak($id)
    {
        $data['data'] = $this->Bebaslab_model->getById($id);

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "bebas_lab_" . $id . ".pdf";
        $this->pdf->load_view('operator/bebaslab/cetak', $data);
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
