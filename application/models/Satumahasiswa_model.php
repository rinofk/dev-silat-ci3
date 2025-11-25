<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Satumahasiswa_model extends CI_Model
{
    protected $table = 'tb_satumahasiswa';
    protected $baseUrl = 'https://services.satu.untan.ac.id/api/v1/kedokteran/mahasiswa';

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'verify' => false,
            'headers' => [
                'x-app-key' => 'DE2CD1332496931EBA9D53E0F28EC72D',
                'x-secret-key' => '6D5E5FC7222C86F6DFE40346B6EE493927CE3052576172415B475B5700457C1D',
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Ambil semua data mahasiswa dari API satu data UNTAN (paginate)
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

                // cek jika API tidak return data
                if (!isset($result['data']) || empty($result['data'])) {
                    break;
                }

                // gabungkan data per page
                $allData = array_merge($allData, $result['data']);

                // pagination info
                $currentPage = $result['meta']['currentPage'] ?? $page;
                $lastPage    = $result['meta']['lastPage'] ?? $page;

                if ($currentPage >= $lastPage) {
                    break; // sudah sampai halaman terakhir
                }

                $page++;

            } catch (Exception $e) {
                log_message('error', 'API ERROR: ' . $e->getMessage());
                break;
            }
        }

        return $allData;
    }

    /**
     * Ambil semua data dari tabel
     */
    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Insert / Update berdasarkan NIM
     */
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
