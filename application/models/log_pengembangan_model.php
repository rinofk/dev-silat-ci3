<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_pengembangan_model extends CI_Model {

    public function get_all_logs() {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('log_pengembangan')->result_array();
    }

    public function insert_log($data) {
        return $this->db->insert('log_pengembangan', $data);
    }
}
