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
}
