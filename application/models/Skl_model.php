<?php

class Skl_model extends CI_model
{

  public function getSkl()
  {

    $this->db->select('*');
    $this->db->from('tb_skl');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_skl.nim');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
    $this->db->order_by('status', 'asc');
    $this->db->where('jenis_skl', 2);

    $query = $this->db->get();
    return $query->result_array(); 
  }

  public function getSklId($id_skl)
  {

    $this->db->select('*');
    $this->db->from('tb_skl');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_skl.nim');
    $this->db->join('prodi_skl', 'prodi_skl.id_prodi=mahasiswa.prodi_id');
    $this->db->join('tb_alumni', 'tb_alumni.nim_alumni=mahasiswa.nim');

    $this->db->where('id_skl', $id_skl);
    $query = $this->db->get();
    return $query->row_array();
  }


  public function prosesSkl($id_skl)
  {
    $proses = 'proses';
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d H:i:s");
    $data = [
      'status' => $proses,
      'admin' => $this->session->userdata('name'),
      'date_finish' => $date

    ];
    $this->db->where('id_skl', $id_skl);
    $this->db->update('tb_skl', $data);
  }

  public function prosesupdateSkl($id_skl)
  {
    $data = [
      'ipk' => $this->input->post('ipk'),
      'tgl_lulus_sidang' => $this->input->post('tgl_lulus'),
      'thn_akademik' => $this->input->post('thn_akademik'),
      'ganjilgenap' => $this->input->post('ganjilgenap'),
      'predikat' => $this->input->post('predikat')

    ];
    $this->db->where('nim_alumni', $this->input->post('nim'));
    $this->db->update('tb_alumni', $data);
     }
  
    public function deleteSkl($id_skl)
    {
    $this->db->where('id_skl', $id_skl);
    $this->db->delete('tb_skl');
     }


  public function selesaiSkl($id_skl)
  {
    $this->load->helper('file'); // Untuk unlink

    // $selesai = 'selesai';
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d H:i:s");
    // $data = [
    //   'status' => $selesai,
    //   'admin' => $this->session->userdata('name'),
    //   'date_finish' => $date
    // ];




    // $this->db->where('id_skl', $id_skl);
    // $this->db->update('tb_skl', $data);



                if (!empty($_FILES['file_surat']['name'])) {
                    $config['upload_path'] = './assets/surat_selesai/';
                    $config['allowed_types'] = 'pdf';
                    $config['overwrite'] = true; // Penting untuk replace
//                    $config['file_name'] = 'SKL_'.YEAR(date_create). $id_skl;
                    $config['file_name']     = 'SKL_' . date('Ymd') . '_' . $id_skl;


                    $this->load->library('upload', $config);

                    // Ambil data lama untuk cek file
                    $surat = $this->db->get_where('tb_skl', ['id_skl' => $id_skl])->row_array();

                    // Jika ada file sebelumnya, hapus dulu
                    if (!empty($surat['file_selesai'])) {
                        $old_path = './assets/surat_selesai/' . $surat['file_selesai'];
                        if (file_exists($old_path)) {
                            unlink($old_path);
                        }
                    }

                    if ($this->upload->do_upload('file_surat')) {
                        $fileData = $this->upload->data();
                        $nama_file = $fileData['file_name'];

                        // Simpan ke DB
                        $this->db->set('status', 'selesai');
                        $this->db->set('file_selesai', $nama_file);
                        $this->db->set('date_finish', $date);
                        $this->db->where('id_skl', $id_skl);
                        $this->db->update('tb_skl');

                        $this->session->set_flashdata('flash', 'diselesaikan dan file diupload.');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('flash', 'Gagal upload file: ' . $error);
                    }
                } else {
                    $this->session->set_flashdata('flash', 'File tidak dipilih!');
                }

                redirect('skl');


  }

  // public function hitungJumlahSurat()
  // {
  //   // get_where('tb_skl', ['nim' => $id, 'jenis_skl' => '2'])
  //   $query = $this->db->get_where('tb_skl', ['jenis_skl' => '2']);
  //   if ($query->num_rows() > 0) {
  //     return $query->num_rows();
  //   } else {
  //     return 0;
  //   }
  // }

  // public function hitungJumlahdiAjukan()
  // {
  //   $query = $this->db->get_where('tb_skl', ['status' => 'diajukan', 'jenis_skl' => '2']);
  //   if ($query->num_rows() > 0) {
  //     return $query->num_rows();
  //   } else {
  //     return 0;
  //   }
  // }

  // public function hitungJumlahdiProses()
  // {
  //   $query = $this->db->get_where('tb_skl', ['status' => 'proses', 'jenis_skl' => '2']);
  //   if ($query->num_rows() > 0) {
  //     return $query->num_rows();
  //   } else {
  //     return 0;
  //   }
  // }

  // public function hitungJumlahdiSelesai()
  // {
  //   $query = $this->db->get_where('tb_skl', ['status' => 'selesai', 'jenis_skl' => '2']);
  //   if ($query->num_rows() > 0) {
  //     return $query->num_rows();
  //   } else {
  //     return 0;
  //   }
  // }

    public function count_by_filter($tahun = null, $status = null)
    {
        $this->db->from('tb_skl s');
        $this->db->where('s.jenis_skl', '2');
        if (!empty($tahun)) {
            $this->db->where('YEAR(s.date_create)', $tahun);
        }

        if (!empty($status)) {
            $this->db->where('s.status', $status);
        }

        return $this->db->count_all_results();
    }

      public function get_filtered_data($tahun = null, $status = null)
      {
          $this->db->select('s.*, m.nama_lengkap, p.nama_prodi');
          $this->db->from('tb_skl s');
          $this->db->join('mahasiswa m', 'm.nim = s.nim', 'left');
          $this->db->join('prodi p', 'p.id_prodi = m.prodi_id', 'left');
          $this->db->where('s.jenis_skl', '2');

          if (!empty($tahun)) {
              $this->db->where('YEAR(s.date_create)', $tahun);
          }

          if (!empty($status)) {
              $this->db->where('s.status', $status);
          }
          // Urutkan berdasarkan tanggal dibuat, terbaru di atas
          $this->db->order_by('s.date_create', 'DESC');
          return $this->db->get()->result_array();
      }

    public function get_tahun_options()
    {
        $this->db->select('YEAR(date_create) as tahun');
        $this->db->from('tb_skl');
        $this->db->group_by('YEAR(date_create)');
        $this->db->order_by('tahun', 'DESC');

        return $this->db->get()->result_array();
    }


}
