<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id`=`user_menu`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getMenuByRole($role_id)
    {
        return $this->db->select('user_menu.id, menu')
            ->from('user_menu')
            ->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')
            ->where('user_access_menu.role_id', $role_id)
            ->order_by('user_access_menu.menu_id', 'ASC')
            ->get()
            ->result_array();
    }

}
