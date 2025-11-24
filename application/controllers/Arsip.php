<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Arsip_model');
        $this->load->library('pdf');
        $this->load->library('form_validation');
    }

    /* ======================================
       📁 MENU UTAMA YUDISIUM
    ====================================== */
    public function yudisium()
    {
        $data['title'] = 'Admin Arsip Yudisium';
        $data['user'] = $this->db->get_where('user', [
            'nim' => $this->session->userdata('nim')
        ])->row_array();

        $data['ay'] = $this->Arsip_model->get_All();
        $data['yl'] = $this->Arsip_model->get_YLengkap();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('arsip/yudisium', $data);
            $this->load->view('templates/footer_a');
        } else {
            $keterangan = $this->input->post('keterangan', true);
            $this->db->set('keterangan', $keterangan);
            $this->db->set('status', 'reject');
            $this->db->where('id_bw', $this->input->post('id_bw'));
            $this->db->update('tb_berkaswisuda');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui!</div>');
            redirect('arsip/yudisium');
        }
    }

    public function yudisiumdetail($nim_mahasiswa)
    {
        $data['title'] = 'Berkas Wisuda Mahasiswa';
        $data['user'] = $this->db->get_where('user', [
            'nim' => $this->session->userdata('nim')
        ])->row_array();

        $data['ydetail'] = $this->Arsip_model->get_nimmahasiswa($nim_mahasiswa);

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('arsip/detail', $data);
        $this->load->view('templates/footer_a');
    }

    
public function yudisiumperiodedetail($id_periode)
{
    $data['title'] = 'Daftar Yudisium Mahasiswa';
    $data['user'] = $this->db->get_where('user', [
        'nim' => $this->session->userdata('nim')
    ])->row_array();

    $data['ypdetail'] = $this->Arsip_model->get_YudisiumPeriodeDetail($id_periode);

    // Ambil data periode + nama prodi dengan join
    $this->db->select('a_periode.*, prodi.nama_prodi');
    $this->db->from('a_periode');
    $this->db->join('prodi', 'prodi.id_prodi = a_periode.id_prodi', 'left');
    $this->db->where('a_periode.id_periode', $id_periode);
    $data['detail'] = $this->db->get()->row_array();

    // === Fungsi untuk format tahun_sem ===
    if (!empty($data['detail']['tahun_sem'])) {
        $tahun_sem = $data['detail']['tahun_sem'];

        if (strlen($tahun_sem) == 5) {
            $tahun = substr($tahun_sem, 0, 4);
            $semester = substr($tahun_sem, -1);

            $tahun_akademik = $tahun . '/' . ($tahun + 1);
            $semester_text = ($semester == '1') ? 'Ganjil' : 'Genap';

            // Tambahkan ke array data supaya bisa dipakai di view
            $data['detail']['tahun_akademik'] = $tahun_akademik;
            $data['detail']['semester_text'] = $semester_text;
        } else {
            $data['detail']['tahun_akademik'] = '-';
            $data['detail']['semester_text'] = '-';
        }
    } else {
        $data['detail']['tahun_akademik'] = '-';
        $data['detail']['semester_text'] = '-';
    }

    // === Load View ===
    $this->load->view('templates/header_a', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('arsip/periodedetail', $data);
    $this->load->view('templates/footer_a');
}


    /* ======================================
       ✅ PROSES PERIODE YUDISIUM
    ====================================== */
        public function periodeyudisium($slug = null)
        {
            $data['title'] = 'Periode Yudisium';
            $data['user'] = $this->db->get_where('user', [
                'nim' => $this->session->userdata('nim')
            ])->row_array();

            // Ambil daftar periode + prodi
            $data['periode'] = $this->Arsip_model->get_Periode();
            $data['prodis'] = $this->db->get('prodi')->result_array();

            $today = date('Y-m-d');
            $prodi = $this->db->get_where('prodi', ['slug' => $slug])->row_array();

            if ($prodi) {
                $id_prodi = $prodi['id_prodi'];

                $data['periode_aktif'] = $this->db
                    ->where('id_prodi', $id_prodi)
                    ->where('tgl_mulai <=', $today)
                    ->where('tgl_selesai >=', $today)
                    ->get('a_periode')
                    ->result_array();

                $data['periode_selesai'] = $this->db
                    ->where('id_prodi', $id_prodi)
                    ->where('tgl_selesai <', $today)
                    ->get('a_periode')
                    ->result_array();

                $data['selected_prodi'] = $id_prodi;
                $data['selected_prodi_name'] = $prodi['nama_prodi'];
            } else {
                $data['periode_aktif'] = $this->db
                    ->where('tgl_mulai <=', $today)
                    ->where('tgl_selesai >=', $today)
                    ->get('a_periode')
                    ->result_array();

                $data['periode_selesai'] = $this->db
                    ->where('tgl_selesai <', $today)
                    ->get('a_periode')
                    ->result_array();

                $data['selected_prodi'] = null;
                $data['selected_prodi_name'] = '';
            }

            // Jika slug dipilih, filter periode-nya
            if ($slug) {
                $prodi = $this->db->get_where('prodi', ['slug' => $slug])->row_array();
                if ($prodi) {
                    $data['selected_prodi'] = $prodi['id_prodi'];
                    $data['selected_prodi_name'] = $prodi['nama_prodi'];
                    $data['periode'] = $this->db
                        ->get_where('a_periode', ['id_prodi' => $prodi['id_prodi']])
                        ->result_array();
                }
            } else {
                $data['periode'] = $this->db->get('a_periode')->result_array();
            }

            // Tentukan status otomatis
            foreach ($data['periode'] as &$p) {
                $p['status_otomatis'] = ($today >= $p['tgl_mulai'] && $today <= $p['tgl_selesai'])
                    ? 'Aktif'
                    : 'Tidak Aktif';
            }

            // === Validasi ===
            $this->form_validation->set_rules('nama_periode', 'Nama Periode', 'required');
            $this->form_validation->set_rules('tahun_sem', 'Tahun', 'required');
            $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');
            $this->form_validation->set_rules('id_prodi', 'Program Studi', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header_a', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('arsip/periodeyudisium', $data);
                $this->load->view('templates/footer_a');
            } else {
                // === Upload File (opsional) ===
                $config['upload_path']   = './uploads/yudisium/';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size']      = 5120; // 5MB
                $this->load->library('upload', $config);

                $ba = null;
                $sk = null;

                // Upload Berita Acara (boleh kosong)
                if (!empty($_FILES['ba']['name'])) {
                    if ($this->upload->do_upload('ba')) {
                        $ba = $this->upload->data('file_name');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal upload Berita Acara: ' . $this->upload->display_errors() . '</div>');
                        redirect('arsip/periodeyudisium');
                    }
                }

                // Upload SK Yudisium (boleh kosong)
                if (!empty($_FILES['sk']['name'])) {
                    if ($this->upload->do_upload('sk')) {
                        $sk = $this->upload->data('file_name');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal upload SK Yudisium: ' . $this->upload->display_errors() . '</div>');
                        redirect('arsip/periodeyudisium');
                    }
                }

                // === Simpan Data ke DB ===
                $dataInsert = [
                    'id_prodi'     => $this->input->post('id_prodi'),
                    'nama_periode' => $this->input->post('nama_periode'),
                    'tahun_sem'        => $this->input->post('tahun_sem'),
                    'tgl_mulai'    => $this->input->post('tgl_mulai'),
                    'tgl_selesai'  => $this->input->post('tgl_selesai'),
                    'tgl_yudisium' => $this->input->post('tgl_yudisium'),
                    'ba'           => $ba, // bisa null
                    'sk'           => $sk, // bisa null
                    'admin'        => $this->session->userdata('name')
                ];

                $this->db->insert('a_periode', $dataInsert);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Periode baru berhasil ditambahkan!</div>');
                redirect('arsip/periodeyudisium');
            }
        }
//==================================================
        public function updateyudisium()
        {
            $slug = $this->input->post('slug');
            $id_periode = $this->input->post('id_periode');

            // Lokasi upload
            $upload_path = FCPATH . 'assets/arsip/periode_yudisium/';

            // Pastikan folder ada (auto-create kalau belum)
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0775, true);
            }

            // Data dasar
            $data = [
                'nama_periode' => $this->input->post('nama_periode'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_selesai' => $this->input->post('tgl_selesai'),
                'tahun_sem' => $this->input->post('tahun_sem'),
                'id_prodi' => $this->input->post('id_prodi'),
                'tgl_yudisium' => $this->input->post('tgl_yudisium'),
                'admin' => $this->session->userdata('name'),
                'date_update' => date('Y-m-d H:i:s')
            ];

            // ========== Upload File Berita Acara ==========
            $tgl_yudisium = $this->input->post('tgl_yudisium');
            $id_prodi     = $this->input->post('id_prodi');

            // Ambil nama prodi dari database
            $prodi = $this->db->get_where('prodi', ['id_prodi' => $id_prodi])->row_array();
            $nama_prodi = !empty($prodi['nama_prodi']) ? $prodi['nama_prodi'] : 'ProdiTidakDikenal';

            // Bersihkan nama prodi biar aman untuk nama file
            $nama_prodi_safe = preg_replace('/[^A-Za-z0-9_-]/', '_', $nama_prodi);
            if (!empty($_FILES['ba']['name'])) {
                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size']      = 2048; // 2 MB
                $config['file_name']     = 'BA_' . $tgl_yudisium . '_' . $nama_prodi_safe;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('ba')) {
                    // Hapus file lama jika ada
                    if (!empty($this->input->post('old_ba'))) {
                        $old_file = $upload_path . $this->input->post('old_ba');
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }
                    $data['ba'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('flash', 'Upload Berita Acara gagal: ' . $this->upload->display_errors());
                }
            }

            // ========== Upload File SK Yudisium ==========
            if (!empty($_FILES['sk']['name'])) {
                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size']      = 2048; // 2 MB
                $config['file_name']     = 'SK_' . $tgl_yudisium . '_' . $nama_prodi_safe;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('sk')) {
                    // Hapus file lama jika ada
                    if (!empty($this->input->post('old_sk'))) {
                        $old_file = $upload_path . $this->input->post('old_sk');
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }
                    $data['sk'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('flash', 'Upload SK gagal: ' . $this->upload->display_errors());
                }
            }

            // Update database
            $this->db->where('id_periode', $id_periode);
            $this->db->update('a_periode', $data);

            $this->session->set_flashdata('flash', 'Periode berhasil diperbarui!');

            // Redirect balik
            if (!empty($slug)) {
                redirect('arsip/periodeyudisium/' . $slug);
            } else {
                redirect('arsip/periodeyudisium');
            }
        }




    /* ======================================
       ⚙️ ACTIONS
    ====================================== */
    public function accept($nim_mahasiswa, $id_periode)
    {
        $this->Arsip_model->accept_Idbp($nim_mahasiswa);
        $this->session->set_flashdata('flash', 'Data diterima!');
        redirect('arsip/yudisiumperiodedetail/'.$id_periode);
        // redirect('arsip/yudisium');
    }

    public function reject($nim_mahasiswa, $id_periode)
    {
        $this->Arsip_model->reject_Idbp($nim_mahasiswa);
        $this->session->set_flashdata('flash', 'Data ditolak!');
        redirect('arsip/yudisiumperiodedetail/'.$id_periode);
        // redirect('arsip/yudisium');
    }

    /* ======================================
       🧾 CETAK PDF
    ====================================== */
    public function cetak($id_bp)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['bp'] = $this->Pustakawan_model->get_Idbp($id_bp);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '1'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '5'])->row_array();

        $this->load->view('bebasperpus/cetak', $data);
    }
//===========================================================
            public function tambahmahasiswa()
            {
                $nim = $this->input->post('nim_mahasiswa');
                $id_periode = $this->input->post('id_periode');
                $admin = $this->session->userdata('name');

                // Cek apakah NIM sudah terdaftar di tabel a_yudisium
                $cek = $this->db->get_where('a_yudisium', ['nim_mahasiswa' => $nim])->row_array();

                if ($cek) {
                    // Jika sudah ada, ambil periode-nya
                    $periode_lama = $this->db->get_where('a_periode', ['id_periode' => $cek['id_periode']])->row_array();

                    $nama_periode = !empty($periode_lama['nama_periode']) ? $periode_lama['nama_periode'] : 'tidak diketahui';
                    $this->session->set_flashdata('error', "Mahasiswa dengan NIM <strong>$nim</strong> sudah terdaftar pada periode <strong>$nama_periode</strong>.");
                } else {
                    // Jika belum ada, simpan data baru
                    $data = [
                        'nim_mahasiswa' => $nim,
                        'status' => 'di terima',
                        'date_created' => date('Y-m-d H:i:s'),
                        'id_periode' => $id_periode,
                        'admin' => $admin
                    ];

                    $this->db->insert('a_yudisium', $data);
                    $this->session->set_flashdata('success', "Mahasiswa dengan NIM <strong>$nim</strong> berhasil ditambahkan ke periode ini.");
                }

                redirect('arsip/yudisiumperiodedetail/' . $id_periode);
            }


}
