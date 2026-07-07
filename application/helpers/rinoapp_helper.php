<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $segment1 = $ci->uri->segment(1);
        $segment2 = $ci->uri->segment(2);
        
        $menu_ids = [];
        
        // 1. Coba cari menu_id berdasarkan kecocokan submenu url
        if ($segment1) {
            $current_url = $segment1;
            if ($segment2) {
                $current_url .= '/' . $segment2;
            }
            
            // Cari yg pas persis (ambil semua baris jika ada duplikat url)
            $subMenus = $ci->db->get_where('user_sub_menu', ['url' => $current_url])->result_array();
            if (!empty($subMenus)) {
                foreach ($subMenus as $sm) {
                    $menu_ids[] = $sm['menu_id'];
                }
            } else {
                // Cari yang prefix sub_menu URL-nya merupakan awal dari URL saat ini
                // Contoh: 'admin/alumni' adalah prefix dari 'admin/alumni_tambah' atau 'admin/alumni_ubah'
                $ci->db->like('url', $segment1 . '/', 'after');
                $all_sub = $ci->db->get('user_sub_menu')->result_array();
                foreach ($all_sub as $sub) {
                    if (strpos($current_url, $sub['url']) === 0) {
                        $menu_ids[] = $sub['menu_id'];
                    }
                }
            }
        }
        
        // 2. Jika tidak cocok ke submenu mana pun, gunakan fallback segmen pertama (segment 1)
        if (empty($menu_ids) && $segment1) {
            $queryMenu = $ci->db->get_where('user_menu', ['menu' => $segment1])->row_array();
            if ($queryMenu) {
                $menu_ids[] = $queryMenu['id'];
            }
        }

        // 3. Validasi hak akses (harus memiliki akses ke minimal salah satu menu_id)
        if (!empty($menu_ids)) {
            $menu_ids = array_unique($menu_ids);
            
            $ci->db->where('role_id', $role_id);
            $ci->db->where_in('menu_id', $menu_ids);
            $userAccess = $ci->db->get('user_access_menu');
            
            if ($userAccess->num_rows() < 1) {
                redirect('auth/blocked');
            }
        } else {
            // Jika menu tidak terdaftar sama sekali, blokir demi keamanan
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{

    $ci  = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
