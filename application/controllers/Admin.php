<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();  saya ganti menjadi cek_login();
        cek_login();
    }


    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // echo 'Selamat Datang User ' . $data['user']['name'];
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('admin/role');
        }
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // echo 'Selamat Datang User ' . $data['user']['name'];
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer_a');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // echo 'Selamat Datang User ' . $data['user']['name'];
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header_a', $data);
  $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer_a');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Change!</div>');
    }
   
    public function create()
    {
        $data['title'] = 'Create Admin';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $role = 2;
        $data['tbuser'] = $this->db->get_where('user', ['role_id !=' => $role])->result_array();
        $data['tb2user'] = $this->db->get_where('user', ['role_id' => $role])->result_array();

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/create', $data);
        $this->load->view('templates/footer_a');
    }

    public function tambah()
    {
        $data['title'] = 'Create Admin';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $role = 2;
        $data['tbuser'] = $this->db->get_where('user', ['role_id !=' => $role])->result_array();
        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $data = [
                "nim" => $this->input->post('nim', true),
                "name" => $this->input->post('name', true),
                "email" => $this->input->post('email'),
                'image' => 'default.jpg',
                "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                "role_id" => $this->input->post('role'),
                'is_active' => 1,
                'date_created' => time()


            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('admin/create');
        }
    }

    public function ubah($id)
    {
        $data['title'] = 'Ubah Admin';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['tbuser'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/ubah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $data = [
                "nim" => $this->input->post('nim', true),
                "name" => $this->input->post('name', true),
                "email" => $this->input->post('email'),
                "role_id" => $this->input->post('role')

            ];

            $this->db->where('id', $id);
            $this->db->update('user', $data);

            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('admin/create');
        }
    }

    public function password($id)
    {
        $data['title'] = 'Ubah Admin';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['tbuser'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/password', $data);
            $this->load->view('templates/footer_a');
        } else {
            $data = [
                "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT)

            ];

            $this->db->where('id', $id);
            $this->db->update('user', $data);

            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('admin/create');
        }
    }

    public function alumni()
    {
        $this->load->model('Alumni_model');
        $data['title'] = 'Data Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        // 1. Get all unique tahun_wisuda values
        $all_years_db = $this->db->select('tahun_wisuda')->distinct()->from('tb_alumni')->get()->result_array();
        $years = array_map(function($y) { return trim($y['tahun_wisuda']); }, $all_years_db);
        $years = array_filter($years);
        $years = array_unique($years);

        // 2. Custom sort DESC (latest years first)
        usort($years, function($a, $b) {
            $get_year = function($str) {
                if (preg_match_all('/\b(19|20)\d{2}\b/', $str, $matches)) {
                    return max(array_map('intval', $matches[0]));
                }
                return 0;
            };
            $ya = $get_year($a);
            $yb = $get_year($b);
            if ($ya === $yb) {
                return strcmp($b, $a);
            }
            return $yb - $ya;
        });

        $data['years'] = $years;

        // 3. Set default and selected year
        $default_year = !empty($years) ? $years[0] : '';
        $selected_year = $this->input->get('tahun') !== NULL ? $this->input->get('tahun') : $default_year;
        $data['selected_year'] = $selected_year;

        // 4. Retrieve filtered alumni list
        if ($selected_year === 'Semua') {
            $data['alumni'] = $this->Alumni_model->getAllAlumni();
        } else {
            $data['alumni'] = $this->Alumni_model->getAllAlumniByYear($selected_year);
        }

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/alumni_index', $data);
        $this->load->view('templates/footer_a');
    }

    public function alumni_tambah()
    {
        $this->load->model('Alumni_model');
        $data['title'] = 'Tambah Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['students'] = $this->Alumni_model->getStudentsNotAlumni();

        $this->form_validation->set_rules('nim_alumni', 'Mahasiswa', 'required|is_unique[tb_alumni.nim_alumni]');
        $this->form_validation->set_rules('tahun_wisuda', 'Tahun Wisuda', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/alumni_tambah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $date_now = date('Y-m-d H:i:s');
            
            // Handle Photo Upload
            $new_image = 'default.jpg';
            $upload_image = $_FILES['poto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']     = '6148';
                $config['upload_path'] = './assets/img/alumni/';
                $config['file_name'] = $this->input->post('nim_alumni');
                $config['overwrite'] = true;

                $config['mime_types'] = [
                    'jpg'  => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
                    'jpeg' => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
                    'png'  => ['image/png',  'image/x-png']
                ];

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('poto')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('flash_error', $this->upload->display_errors());
                    redirect('admin/alumni_tambah');
                }
            }

            $insertData = [
                "nim_alumni" => $this->input->post('nim_alumni', true),
                "thn_akademik" => $this->input->post('thn_akademik', true),
                "ganjilgenap" => $this->input->post('ganjilgenap', true),
                "tahun_wisuda" => $this->input->post('tahun_wisuda', true),
                "jalur_masuk" => $this->input->post('jalur_masuk', true),
                "judul_skripsi" => $this->input->post('judul_skripsi', true),
                "pesan_kesan" => $this->input->post('pesan_kesan', true),
                "alamat_sekarang" => $this->input->post('alamat_sekarang', true),
                "tgl_lulus_sidang" => $this->input->post('tgl_lulus_sidang', true) ? $this->input->post('tgl_lulus_sidang', true) : '2020-01-01',
                "tgl_lulus_yudisium" => $this->input->post('tgl_lulus_yudisium', true) ? $this->input->post('tgl_lulus_yudisium', true) : '2020-01-01',
                "ipk" => $this->input->post('ipk', true),
                "predikat" => $this->input->post('predikat', true),
                "status_alumni" => $this->input->post('status_alumni', true),
                "tanggal_daftar" => $date_now,
                "tanggal_updatealumni" => $date_now,
                "poto" => $new_image
            ];

            $this->Alumni_model->tambahAlumniAdmin($insertData);
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('admin/alumni');
        }
    }

    public function alumni_ubah($id_alumni)
    {
        $this->load->model('Alumni_model');
        $data['title'] = 'Ubah Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['alumni'] = $this->Alumni_model->getAlumniById($id_alumni);

        if (!$data['alumni']) {
            show_404();
        }

        $this->form_validation->set_rules('tahun_wisuda', 'Tahun Wisuda', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/alumni_ubah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $date_now = date('Y-m-d H:i:s');
            
            // Handle Photo Upload
            $new_image = $data['alumni']['poto'];
            $upload_image = $_FILES['poto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']     = '6148';
                $config['upload_path'] = './assets/img/alumni/';
                $config['file_name'] = $data['alumni']['nim_alumni'];
                $config['overwrite'] = true;

                $config['mime_types'] = [
                    'jpg'  => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
                    'jpeg' => ['image/jpeg', 'image/jpg', 'image/pjpeg'],
                    'png'  => ['image/png',  'image/x-png']
                ];

                $this->load->library('upload', $config);
                
                if ($new_image && $new_image != 'default.jpg') {
                    @unlink(FCPATH . 'assets/img/alumni/' . $new_image);
                }

                if ($this->upload->do_upload('poto')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('flash_error', $this->upload->display_errors());
                    redirect('admin/alumni_ubah/' . $id_alumni);
                }
            }

            $updateData = [
                "thn_akademik" => $this->input->post('thn_akademik', true),
                "ganjilgenap" => $this->input->post('ganjilgenap', true),
                "tahun_wisuda" => $this->input->post('tahun_wisuda', true),
                "jalur_masuk" => $this->input->post('jalur_masuk', true),
                "judul_skripsi" => $this->input->post('judul_skripsi', true),
                "pesan_kesan" => $this->input->post('pesan_kesan', true),
                "alamat_sekarang" => $this->input->post('alamat_sekarang', true),
                "tgl_lulus_sidang" => $this->input->post('tgl_lulus_sidang', true) ? $this->input->post('tgl_lulus_sidang', true) : '2020-01-01',
                "tgl_lulus_yudisium" => $this->input->post('tgl_lulus_yudisium', true) ? $this->input->post('tgl_lulus_yudisium', true) : '2020-01-01',
                "ipk" => $this->input->post('ipk', true),
                "predikat" => $this->input->post('predikat', true),
                "status_alumni" => $this->input->post('status_alumni', true),
                "tanggal_updatealumni" => $date_now,
                "poto" => $new_image
            ];

            $this->Alumni_model->ubahAlumniAdmin($id_alumni, $updateData);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('admin/alumni');
        }
    }

    public function alumni_detail($id_alumni)
    {
        $this->load->model('Alumni_model');
        $data['title'] = 'Detail Alumni';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['alumni'] = $this->Alumni_model->getAlumniById($id_alumni);

        if (!$data['alumni']) {
            show_404();
        }

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/alumni_detail', $data);
        $this->load->view('templates/footer_a');
    }

    public function alumni_hapus($id_alumni)
    {
        $this->load->model('Alumni_model');
        $alumni = $this->Alumni_model->getAlumniById($id_alumni);
        if ($alumni) {
            if ($alumni['poto'] && $alumni['poto'] != 'default.jpg') {
                @unlink(FCPATH . 'assets/img/alumni/' . $alumni['poto']);
            }
            $this->Alumni_model->hapusAlumni($id_alumni);
            $this->session->set_flashdata('flash', 'Dihapus');
        }
        redirect('admin/alumni');
    }

    public function setting_nav_footer()
    {
        $data['title'] = 'Setting Nav & Footer';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['navbar'] = $this->db->order_by('order_no', 'ASC')->get('tb_setting_navbar')->result_array();
        $data['footer'] = $this->db->order_by('order_no', 'ASC')->get('tb_setting_footer')->result_array();

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/setting_nav_footer', $data);
        $this->load->view('templates/footer_a');
    }

    public function setting_navbar_add()
    {
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('order_no', 'Order', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah menu navbar! Data tidak valid.</div>');
        } else {
            $data = [
                'label' => $this->input->post('label'),
                'url' => $this->input->post('url'),
                'order_no' => $this->input->post('order_no'),
                'is_active' => $this->input->post('is_active') !== null ? $this->input->post('is_active') : 1,
                'is_button' => $this->input->post('is_button') !== null ? $this->input->post('is_button') : 0
            ];
            $this->db->insert('tb_setting_navbar', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu navbar baru berhasil ditambahkan!</div>');
        }
        redirect('admin/setting_nav_footer');
    }

    public function setting_navbar_edit($id)
    {
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('order_no', 'Order', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah menu navbar! Data tidak valid.</div>');
        } else {
            $data = [
                'label' => $this->input->post('label'),
                'url' => $this->input->post('url'),
                'order_no' => $this->input->post('order_no'),
                'is_active' => $this->input->post('is_active') !== null ? $this->input->post('is_active') : 0,
                'is_button' => $this->input->post('is_button') !== null ? $this->input->post('is_button') : 0
            ];
            $this->db->where('id', $id);
            $this->db->update('tb_setting_navbar', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu navbar berhasil diperbaharui!</div>');
        }
        redirect('admin/setting_nav_footer');
    }

    public function setting_navbar_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_setting_navbar');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu navbar berhasil dihapus!</div>');
        redirect('admin/setting_nav_footer');
    }

    public function setting_footer_add()
    {
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('order_no', 'Order', 'required|numeric');
        $this->form_validation->set_rules('section', 'Section', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah menu footer! Data tidak valid.</div>');
        } else {
            $data = [
                'section' => $this->input->post('section'),
                'label' => $this->input->post('label'),
                'url' => $this->input->post('url'),
                'order_no' => $this->input->post('order_no'),
                'is_active' => $this->input->post('is_active') !== null ? $this->input->post('is_active') : 1
            ];
            $this->db->insert('tb_setting_footer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu footer baru berhasil ditambahkan!</div>');
        }
        redirect('admin/setting_nav_footer');
    }

    public function setting_footer_edit($id)
    {
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('order_no', 'Order', 'required|numeric');
        $this->form_validation->set_rules('section', 'Section', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah menu footer! Data tidak valid.</div>');
        } else {
            $data = [
                'section' => $this->input->post('section'),
                'label' => $this->input->post('label'),
                'url' => $this->input->post('url'),
                'order_no' => $this->input->post('order_no'),
                'is_active' => $this->input->post('is_active') !== null ? $this->input->post('is_active') : 0
            ];
            $this->db->where('id', $id);
            $this->db->update('tb_setting_footer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu footer berhasil diperbaharui!</div>');
        }
        redirect('admin/setting_nav_footer');
    }

    public function setting_footer_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_setting_footer');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu footer berhasil dihapus!</div>');
        redirect('admin/setting_nav_footer');
    }
}
