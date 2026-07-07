<?php

class Home extends CI_Controller
{
	public function index()
	{
		$data['navbar_menu'] = $this->db->order_by('order_no', 'ASC')->get_where('tb_setting_navbar', ['is_active' => 1])->result_array();
		$data['footer_layanan'] = $this->db->order_by('order_no', 'ASC')->get_where('tb_setting_footer', ['section' => 'layanan', 'is_active' => 1])->result_array();
		$data['footer_tautan'] = $this->db->order_by('order_no', 'ASC')->get_where('tb_setting_footer', ['section' => 'tautan', 'is_active' => 1])->result_array();

		$this->load->view('home/bdr', $data);
	}
}
