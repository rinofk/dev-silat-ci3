<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Mahasiswa_model');
        //   $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['mahasiswa']  = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer_a');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['mhs'] = $this->db->get_where('mahasiswa', ['nim' => $this->session->userdata('nim')])->row_array();

        // echo 'Selamat Datang User ' . $data['user']['name'];

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer_a');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $nim = $this->input->post('nim');

            //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $config['file_name'] = $this->input->post('nim');
                $config['overwrite'] = true;

                $this->load->library('upload', $config);
                $old_image = $data['user']['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('email', $email);
            $this->db->where('nim', $nim);
            $this->db->update('user');
            
            $this->db->set('no_hp', $this->input->post('no_hp'));
            $this->db->where('nim', $nim);
            $this->db->update('mahasiswa');
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been update</div>');
            redirect('user');
        }
    }
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // echo 'Selamat Datang User ' . $data['user']['name'];

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer_a');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password! </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // Password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('nim', $this->session->userdata('nim'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Change!  </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }


    public function biodata()
    {
        $data['title'] = 'Biodata';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['agama'] = $this->db->get('agama')->result_array();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('program_studi', 'Program Studi', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'NO HP', 'required');
        $this->form_validation->set_rules('agama', 'agama', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/biodata', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->inputBiodata();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('user');
        }
    }
}
