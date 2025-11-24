<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Satumahasiswa_model extends CI_Model
{
    protected $table = 'tb_satumahasiswa';
    protected $baseUrl = 'http://services.satu.untan.ac.id/api/v1/kedokteran/mahasiswa';
    protected $headers;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'verify' => false, // disable SSL verification (jika error certificate)
            'headers' => [
                'x-app-key' => 'DE2CD1332496931EBA9D53E0F28EC72D',
                'x-secret-key' => '6D5E5FC7222C86F6DFE40346B6EE493927CE3052576172415B475B5700457C1D',
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Ambil semua data mahasiswa dari API (semua halaman)
     */
    public function fetchFromSatuData()
    {
        $allData = [];
        $page = 1;
        $limit = 100;

        while (true) {
            try {
                $response = $this->client->request('GET', $this->baseUrl, [
                    'query' => [
                        'page' => $page,
                        'limit' => $limit
                    ]
                ]);

                $result = json_decode($response->getBody(), true);

                if (empty($result['data'])) {
                    break; // tidak ada data lagi
                }

                $allData = array_merge($allData, $result['data']);
                $page++; // lanjut ke halaman berikutnya

                // Jika data yang dikembalikan < limit, berarti sudah terakhir
                if (count($result['data']) < $limit) {
                    break;
                }

            } catch (Exception $e) {
                log_message('error', 'API Error: ' . $e->getMessage());
                break;
            }
        }

        return $allData;
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function insertOrUpdate($data)
    {
        $this->db->where('nim', $data['nim']);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $this->db->where('nim', $data['nim']);
            $this->db->update($this->table, $data);
        } else {
            $this->db->insert($this->table, $data);
        }
    }
}
