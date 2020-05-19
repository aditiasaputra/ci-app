<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('check_login')) {
    function check_login($classController)
    {
        $ci = get_instance();
        if (!$ci->session->userdata('email')) {
            $ci->session->set_flashdata('auth_message', '<div class="alert alert-danger" role="alert"><span class="alert-icon ua-icon-info"></span>Anda harus login untuk mengakses halaman ' . $classController . ' !<span class="close alert__close ua-icon-alert-close" data-dismiss="alert"></span></div>');
            redirect();
        } else {
            $role_id = $ci->session->userdata('role_id');
            $menu = $ci->uri->segment(1);

            $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
            $menu_id = $queryMenu['id'];

            $userAccess = $ci->db->get_where(
                'user_access_menu',
                [
                    'role_id' => $role_id,
                    'menu_id' => $menu_id
                ]
            );

            if ($userAccess->num_rows() < 1) {

                redirect('blocked');
            }
        }
    }
}

if (!function_exists('check_access')) {
    function check_access($role_id, $menu_id)
    {
        $ci = get_instance();

        $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);


        if ($result->num_rows() > 0) {
            return 'checked="checked"';
        }
    }
}
