<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once(APPPATH . '../vendor/autoload.php');

use GuzzleHttp\Client;

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Visitor_model');
    }
    public function index()
    {
        if ($this->session->userdata('nim')) {
            redirect('user');
        }

        $this->form_validation->set_rules('nim', 'NIM', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi succes
            $this->_login();
        }
    }

    private function _login()
    {
        $nim = $this->input->post('nim');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['nim' => $nim])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'nim' => $user['nim'],
                        'name' => $user['name'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    $this->Visitor_model->log_login($user['nim'], true);

                    if ($user['role_id'] == 1) {
                        // redirect('admin');
                        redirect('operator');
                    } elseif (in_array($user['role_id'], [3, 5, 7, 8, 9])) {
                        redirect('operator');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This NIM has not been activated</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIM tidak terdaftar</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('nim')) {
            redirect('user');
        }
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $this->form_validation->set_rules(
            'nim',
            'NIM',
            'trim|required|min_length[9]|is_unique[user.nim]',
            [
                'is_unique' => 'This nim has already registered!'
            ]
        );
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Register';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {

            //Guzzle
            $client = new Client();
            //service siakad.untan.ac.id
            // $response = $client->request('GET', 'http://servicedpna.untan.ac.id/kedokteran/getmhsbynim/' . $_POST['nim']);

            // service ke satu.untan.ac.id
            $response = $client->request(
                'GET',
                'http://172.16.40.165:3000/api/v1/kedokteran/mahasiswa/' . $_POST['nim'],
                [
                    'headers' =>
                    [
                        'X-App-Key' => 'DE2CD1332496931EBA9D53E0F28EC72D',
                        'X-Secret-Key' => '6D5E5FC7222C86F6DFE40346B6EE493927CE3052576172415B475B5700457C1D',
                    ],
                ]
            );
            $result = json_decode($response->getBody()->getContents(), true);
            //var_dump($result);

            // return $result[0];
            $nimservice = $result['nim'];
            $nama = $result['nama'];
            $email = $result['email'];
            $tmplahir = $result['tempat_lahir'];
            $progdi = $result['nama_program_studi'];
            $alamat = $result['alamat'];
            $hp = $result['hp'];
            $agama = $result['agama'];
            $jk = $result['jenis_kelamin'];
            $ayah = $result['nama_ayah'];
            $ibu = $result['nama_ibu'];
            $program = $result['sistem_kuliah'];
            $tahun_angkatan = $result['id_periode'];
            $tgllahirservice = $result['tanggal_lahir'];
            $tglservice = date('d-m-Y', strtotime($tgllahirservice));
            //EndGuzzle

            if ($email != '') {
            };
            $nim = $this->input->post('nim');
            $password = $this->input->post('tgl_lahir');
            $prodi = substr($this->input->post('nim'), 3, 1);

            if ($nim == $nimservice) {

                if ($password == $tglservice) {
                    if ($email == '') {
                        $data = [
                            'nim' => $nimservice,
                            'name' => ucwords(strtolower($nama)),
                            'email' => $nim . '@student.untan.ac.id',
                            'image' => 'default.jpg',
                            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                            'role_id' => 2,
                            'is_active' => 1,
                            'date_created' => time()
                        ];
                    } else {
                        $data = [
                            'nim' => $nimservice,
                            'name' => ucwords(strtolower($nama)),
                            'email' => $email,
                            'image' => 'default.jpg',
                            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                            'role_id' => 2,
                            'is_active' => 1,
                            'date_created' => time()
                        ];
                    };

                    $mhs = [
                        'nim' => $nimservice,
                        'nama_lengkap' => ucwords(strtolower($nama)),
                        'tempat_lahir' => ucwords(strtolower($tmplahir)),
                        'tgl_lahir' => $tgllahirservice,
                        'prodi_id' => $prodi,
                        'progdi' => $progdi,
                        'alamat' => $alamat,
                        'no_hp' => $hp,
                        'agama' => 99,
                        'agamaa' => $agama,
                        'jenis_kelamin' => $jk,
                        'nama_ayah' => ucwords(strtolower($ayah)),
                        'nama_ibu' => ucwords(strtolower($ibu)),
                        'program' => $program,
                        'tahun_angkatan' => $tahun_angkatan,
                        'status_aktif' => 1
                    ];
                    $this->db->insert('user', $data);
                    $this->db->insert('mahasiswa', $mhs);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please login</div>');
                    redirect('auth');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tanggal Lahir Tidak Sesuai</div>');
                    redirect('auth/registration');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIM tidak ditemukan</div>');
                redirect('auth/registration');
            }
        }
    }

    // tambahan update terbaru 2026.01.15 by rino
    private function get_reset_count_today($nim)
    {
        $today = date('Y-m-d');
        return $this->db
            ->where('nim', $nim)
            ->where('DATE(created_at)', $today)
            ->count_all_results('reset_account_log');
    }

    public function reset_account()
    {
        $this->form_validation->set_rules('nim', 'NIM', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]'
        );
        $this->form_validation->set_rules(
            'password2',
            'Password',
            'required|trim|matches[password1]'
        );

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Reset Account';

            // sisa reset hari ini
            // $nim = set_value('nim');
            // AMBIL NIM DARI SESSION
            $nim = $this->session->userdata('reset_nim');
            $data['reset_today'] = $nim ? $this->get_reset_count_today($nim) : 0;

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/reset_account', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $this->_process_reset();
        }
    }


    private function _process_reset()
    {
        $nim = $this->input->post('nim');
        // JIKA NIM BERUBAH, RESET SESSION
        if ($this->session->userdata('reset_nim') !== $nim) {
            $this->session->set_userdata('reset_nim', $nim);
        }

        $tgl_lahir_input = $this->input->post('tgl_lahir');

        // CEK LIMIT RESET
        $total_reset = $this->get_reset_count_today($nim);
        if ($total_reset >= 3) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">Reset password maksimal 3 kali per hari</div>'
            );
            redirect('auth/reset_account');
        }


        $user = $this->db->get_where('user', ['nim' => $nim])->row_array();
        if (!$user) {
            $this->_log_reset($nim, 'failed', 'NIM tidak terdaftar');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">NIM tidak terdaftar</div>'
            );
            redirect('auth/reset_account');
        }

        try {
            $client = new Client([
                'timeout' => 5
            ]);

            $response = $client->request(
                'GET',
                'http://services.satu.untan.ac.id/api/v1/kedokteran/mahasiswa/' . $nim,
                // 'http://172.16.40.165:3000/api/v1/kedokteran/mahasiswa/' . $nim,
                [
                    'headers' => [
                        'X-App-Key' => 'DE2CD1332496931EBA9D53E0F28EC72D',
                        'X-Secret-Key' => '6D5E5FC7222C86F6DFE40346B6EE493927CE3052576172415B475B5700457C1D',
                    ],
                    'http_errors' => false // PENTING
                ]
            );

            // CEK STATUS HTTP
            if ($response->getStatusCode() !== 200) {
                $this->_log_reset($nim, 'failed', 'NIM tidak terdaftar di server');
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">Data tidak terdaftar di server</div>'
                );
                redirect('auth/reset_account');
            }

            $result = json_decode($response->getBody()->getContents(), true);

            // CEK DATA KOSONG
            if (!$result || empty($result['nim'])) {
                $this->_log_reset($nim, 'failed', 'NIM tidak terdaftar di server');
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">Data tidak terdaftar di server</div>'
                );
                redirect('auth/reset_account');
            }

            // VALIDASI TANGGAL LAHIR
            $tgl_service = date('d-m-Y', strtotime($result['tanggal_lahir']));
            if ($tgl_lahir_input !== $tgl_service) {
                $this->_log_reset($nim, 'failed', 'Tanggal lahir tidak sesuai');
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">Tanggal lahir tidak sesuai</div>'
                );
                redirect('auth/reset_account');
            }

            // UPDATE PASSWORD
            $this->db->where('nim', $nim)->update('user', [
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
            ]);

            $this->_log_reset($nim, 'success', 'Reset berhasil');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Password berhasil direset</div>'
            );
            $this->session->unset_userdata('reset_nim');

            redirect('auth');
        } catch (Exception $e) {

            // ERROR SERVER / TIMEOUT
            $this->_log_reset($nim, 'failed', 'Server API bermasalah');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">Server sedang bermasalah</div>'
            );
            redirect('auth/reset_account');
        }
    }

    private function _log_reset($nim, $status, $reason = null)
    {
        $this->db->insert('reset_account_log', [
            'nim' => $nim,
            'status' => $status,
            'reason' => $reason,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }


    // end update terbaru 2026.01.15 by rino


    public function logout()
    {
        $this->session->unset_userdata('nim');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Have been Logged Out</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
