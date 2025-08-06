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

                    if ($user['role_id'] == 1) {
                        redirect('admin');
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

            // // start service
            // $curl = curl_init();
            // curl_setopt($curl, CURLOPT_URL, 'http://servicedpna.untan.ac.id/kedokteran/getmhsbynim/' . $_POST['nim']);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // $result = curl_exec($curl);
            // curl_close($curl);

            // $result = json_decode($result, true);
            // $nimservice = $result[0]['nim'];
            // $nama = $result[0]['nama'];
            // $email = $result[0]['email_mhs'];
            // $tmplahir = $result[0]['tmplahir'];
            // $progdi = $result[0]['progdi'];
            // $alamat = $result[0]['alamat_mhs'];
            // $hp = $result[0]['hp'];
            // $agama = $result[0]['agama'];
            // $jk = $result[0]['kelamin'];
            // $ayah = $result[0]['namaayah'];
            // $ibu = $result[0]['namaibu'];
            // $program = $result[0]['program'];
            // $tahun_angkatan = $result[0]['thnakt'];
            // $tgllahirservice = $result[0]['tgllahir'];
            // $tglservice = date('d-m-Y', strtotime($tgllahirservice));
            // // end service

            //Guzzle
            $client = new Client();
            //service siakad.untan.ac.id
            // $response = $client->request('GET', 'http://servicedpna.untan.ac.id/kedokteran/getmhsbynim/' . $_POST['nim']);
            
            // service ke satu.untan.ac.id
            $response = $client->request('GET', 'http://172.16.40.165:3000/api/v1/kedokteran/mahasiswa/' . $_POST['nim'], 
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
