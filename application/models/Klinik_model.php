<?php

class Klinik_model extends CI_model
{
    public function get_All()
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        $this->db->join('prodi', 'prodi.id_prodi=pk_praktekklinik.id_prodi');
        $this->db->join('pk_klinik', 'pk_klinik.id_klinik=pk_praktekklinik.id_klinik');
        $this->db->join('pk_stase', 'pk_stase.id_stase=pk_praktekklinik.id_stase');
        // $this->db->join('pk_id_kelompok', 'pk_id_kelompok.id_kelompok=pk_praktekklinik.id_kelompok');
        
        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }
    public function get_AllLunas()
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        $this->db->join('prodi', 'prodi.id_prodi=pk_praktekklinik.id_prodi');
        $this->db->join('pk_klinik', 'pk_klinik.id_klinik=pk_praktekklinik.id_klinik');
        $this->db->join('pk_stase', 'pk_stase.id_stase=pk_praktekklinik.id_stase');
        $this->db->where('status_pembayaran', 'lunas');

        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    public function get_AllBelum()
    {
        $status ='lunas';
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        $this->db->join('prodi', 'prodi.id_prodi=pk_praktekklinik.id_prodi');
        $this->db->join('pk_klinik', 'pk_klinik.id_klinik=pk_praktekklinik.id_klinik');
        $this->db->join('pk_stase', 'pk_stase.id_stase=pk_praktekklinik.id_stase');
        // $this->db->where('status_pembayaran', $status);
        $this->db->where_not_in('status_pembayaran', $status);


        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    public function get_IdAll($id_praktekklinik)
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        //$this->db->join('prodi', 'prodi.id_prodi=pk_praktekklinik.id_prodi');
       // $this->db->join('pk_klinik', 'pk_klinik.id_klinik=pk_praktekklinik.id_klinik');
        //$this->db->join('pk_stase', 'pk_stase.id_stase=pk_praktekklinik.id_stase');
       // $this->db->join('pk_id_kelompok', 'pk_id_kelompok.id_kelompok=pk_praktekklinik.id_kelompok');


        $this->db->where('id_praktekklinik', $id_praktekklinik);

        
        $query = $this->db->get();
        return $query->row_array();

        //return $this->db->get('mahasiswa')->result_array();
    }
 
    public function get_Periode()
    {
        $this->db->select('*');
        $this->db->from('pk_periode');
       $this->db->join('prodi', 'prodi.id_prodi=pk_periode.id_prodi');
        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }
    public function get_PeriodeAktif()
    {
        $status='aktif';
        $this->db->select('*');
        $this->db->from('pk_periode');
       $this->db->join('prodi', 'prodi.id_prodi=pk_periode.id_prodi');
       $this->db->where_in('status', $status);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_PeriodeNonAktif()
    {
        $status = array('aktif','');
        $this->db->select('*');
        $this->db->from('pk_periode');
        $this->db->join('prodi', 'prodi.id_prodi=pk_periode.id_prodi');
        $this->db->where_not_in('status', $status);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_Kelompok()
    {
        $this->db->select('*');
        $this->db->from('pk_kelompok');
       // $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    public function get_IdKelompokAll()
    {
        $this->db->select('*');
        $this->db->from('pk_id_kelompok');
       $this->db->join('prodi', 'prodi.id_prodi=pk_id_kelompok.id_prodi');
        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }
    public function get_IdKelompokDetail($id_kelompok)
    {
        $this->db->select('*');
        $this->db->from('pk_kelompok');
       $this->db->join('mahasiswa', 'mahasiswa.nim=pk_kelompok.nim_mahasiswa');
       $this->db->where('id_kelompok', $id_kelompok);

        $query = $this->db->get();
       return $query->result_array();

    }
    public function get_IdKelompokAktif()
    {
        $status = array('aktif','');
        $this->db->select('*');
        $this->db->from('pk_id_kelompok');
       $this->db->join('prodi', 'prodi.id_prodi=pk_id_kelompok.id_prodi');
       $this->db->where_in('status', $status);

        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    public function get_IdKelompokSelesai()
    {
        $status = array('aktif','');
        $this->db->select('*');
        $this->db->from('pk_id_kelompok');
       $this->db->join('prodi', 'prodi.id_prodi=pk_id_kelompok.id_prodi');
       $this->db->where_not_in('status', $status);

        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    // public function get_Id_Kelompok()
    // {
    //     $this->db->select('*');
    //     $this->db->from('pk_id_kelompok');
    //     $query = $this->db->get();
    //     return $query->result_array();

    // }

    public function get_klinik()
    {
        $this->db->select('*');
        $this->db->from('pk_klinik');
       $this->db->join('prodi', 'prodi.id_prodi=pk_klinik.prodi_klinik');
        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    public function get_klinik_aktif()
    {
        $pka = 'aktif';
        $this->db->select('*');
        $this->db->from('pk_klinik');
        $this->db->join('prodi', 'prodi.id_prodi=pk_klinik.prodi_klinik');
        $this->db->where_in('status', $pka);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_klinik_nonaktif()
    {
        $pkna = 'tidak aktif';
        $this->db->select('*');
        $this->db->from('pk_klinik');
        $this->db->join('prodi', 'prodi.id_prodi=pk_klinik.prodi_klinik');
        $this->db->where_in('status', $pkna);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_stase()
    {
        $this->db->select('*');
        $this->db->from('pk_stase');
       $this->db->join('prodi', 'prodi.id_prodi=pk_stase.prodi_stase');
        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }

    // public function inputBiodata()
    // {
    //     $data = [
    //         "nim" => $this->input->post('nim', true),
    //         "nama_lengkap" => ucwords(strtolower($this->input->post('nama_lengkap', true))),
    //         "tempat_lahir" => ucwords(strtolower($this->input->post('tempat_lahir', true))),
    //         "tgl_lahir" => $this->input->post('tgl_lahir'),
    //         "prodi_id" => $this->input->post('program_studi'),
    //         "alamat" => $this->input->post('alamat'),
    //         "no_hp" => $this->input->post('no_hp'),
    //         "agama" => $this->input->post('agama'),
    //         "agamaa" => $this->input->post('agamaa'),
    //         "jenis_kelamin" => $this->input->post('jenis_kelamin'),
    //         "nama_ayah" => $this->input->post('nama_ayah'),
    //         "nama_ibu" => $this->input->post('nama_ibu'),
    //         "tanggal_update" => time(),
    //         "status_aktif" => 1
    //     ];

    //     $this->db->insert('mahasiswa', $data);
    // }


    public function tambahDataMahasiswa()
    {
        $data = [
            "nim" => $this->input->post('nim', true),
            "nama_lengkap" => $this->input->post('nama_lengkap', true),
            "tempat_lahir" => $this->input->post('tempat_lahir', true),
            "tgl_lahir" => $this->input->post('tgl_lahir'),
            "semester" => $this->input->post('semester'),
            "tahun_ajaran" => $this->input->post('tahun_ajaran'),
            "program_studi" => $this->input->post('program_studi'),
            "prodi_id" => $this->input->post('program_studi'),
            "keperluan" => $this->input->post('keperluan'),
            "keperluan_ket" => $this->input->post('keperluan_ket'),
            "alamat" => $this->input->post('alamat'),
            "ortu" => $this->input->post('ortu'),
            "nip" => $this->input->post('nip'),
            "pangkat" => $this->input->post('pangkat'),
            "instansi" => $this->input->post('instansi'),
        ];

        $this->db->insert('mahasiswa', $data);
    }

    public function hapusDataMahasiswa($nim)
    {
        $this->db->where('nim', $nim);
        $this->db->delete('mahasiswa');
    }

    public function getMahasiswaById($nim)
    {

        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        //  $this->db->join('user', 'user.nim=mahasiswa.nim');
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query->row_array();

        //  return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }
    public function getMahasiswaByJoin($nim)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        //  $this->db->join('user', 'user.nim=mahasiswa.nim');
        $this->db->where('nim', $nim);
        $query = $this->db->get();

        return $query->row_array();

        //  return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }
    public function getMahasiswaByNim($nim)
    {

        return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
    }

    // update dari operator
    public function ubahDataMahasiswa()
    {

        $data = [

            "nama_lengkap" => $this->input->post('nama_lengkap', true),
            "tempat_lahir" => $this->input->post('tempat_lahir', true),
            "tgl_lahir" => ucwords(strtolower($this->input->post('tgl_lahir', true))),
            "prodi_id" => $this->input->post('program_studi'),
            "alamat" => $this->input->post('alamat'),
            "no_hp" => $this->input->post('no_hp'),
            "agama" => $this->input->post('agama'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "tanggal_update" => time(),
            "status_aktif" => 1
        ];
        $this->db->where('nim', $this->input->post('nim'));
        $this->db->update('mahasiswa', $data);
    }


    // update dari user
    public function ubahBioData()
    {

        $data = [

            "nama_lengkap" => ucwords(strtolower($this->input->post('nama_lengkap', true))),
            "tempat_lahir" => ucwords(strtolower($this->input->post('tempat_lahir', true))),
            "tgl_lahir" => ucwords(strtolower($this->input->post('tgl_lahir', true))),
            "prodi_id" => $this->input->post('program_studi'),
            "alamat" => ucwords(strtolower($this->input->post('alamat'))),
            "no_hp" => $this->input->post('no_hp'),
            "agama" => $this->input->post('agama'),
            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
            "tanggal_update" => time(),
            "status_aktif" => 1
        ];
        $this->db->where('nim', $this->input->post('nim'));
        $this->db->update('mahasiswa', $data);
    }
    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_lengkap', $keyword);
        $this->db->or_like('nim', $keyword);
        $this->db->or_like('program_studi', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
    
    //silat2
     public function hitungJumlahPenagihan()
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        // $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        // $this->db->order_by('date_created', 'asc');
        $this->db->where('status_pembayaran', '-');
        // $this->db->where_in('prodi_id', [1, 6]);

        $query = $this->db->get();

        // $query = $this->db->get_where(['status' => 'di ajukan', 'prodi_id' => '1']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    
    //silat2 Hitung Pengajuan Dokter Baru
     public function hitungJumlahPenagihanDokter()
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        // $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        // $this->db->order_by('date_created', 'asc');
        $this->db->where('status_pembayaran', '-');
        $this->db->where_in('id_prodi', 6);

        $query = $this->db->get();

        // $query = $this->db->get_where(['status' => 'di ajukan', 'prodi_id' => '1']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    //silat2 Hitung Pengajuan Apoteker Baru
     public function hitungJumlahPenagihanApoteker()
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        // $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        // $this->db->order_by('date_created', 'asc');
        $this->db->where('status_pembayaran', '-');
        $this->db->where_in('id_prodi', 4);

        $query = $this->db->get();

        // $query = $this->db->get_where(['status' => 'di ajukan', 'prodi_id' => '1']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    //silat2 Hitung Pengajuan Ners Baru
     public function hitungJumlahPenagihanNers()
    {
        $this->db->select('*');
        $this->db->from('pk_praktekklinik');
        // $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        // $this->db->order_by('date_created', 'asc');
        $this->db->where('status_pembayaran', '-');
        $this->db->where_in('id_prodi', 5);

        $query = $this->db->get();

        // $query = $this->db->get_where(['status' => 'di ajukan', 'prodi_id' => '1']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
