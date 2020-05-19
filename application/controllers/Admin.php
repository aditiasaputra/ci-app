<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login(get_class($this));
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->_views('templates/header', 'templates/sidebar', 'admin/index', 'templates/footer', $data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->_views('templates/header', 'templates/sidebar', 'admin/role', 'templates/footer', $data);
    }

    public function roleaccess($role_id)
    {
        $role = $this->db->get_where('user_role', ['id' => $this->uri->segment(3)])->row_array();
        $data['title'] = "Role Access - {$role['role']}";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $data['menu'] = $this->db->get_where('user_menu', ['id !=' => 1])->result_array();

        $this->_views('templates/header', 'templates/sidebar', 'admin/roleaccess', 'templates/footer', $data);
    }

    public function changeaccess()
    {
        $role_id = $this->input->post('roleId');
        $menu_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="flash-data" id="access-success"></div>');
    }

    private function _views($header, $sidebar, $index, $footer, $data = null)
    {
        if (is_null($data)) {
            $this->load->view($header);
            $this->load->view($sidebar);
            $this->load->view($index);
            $this->load->view($footer);
        } else {
            $this->load->view($header, $data);
            $this->load->view($sidebar);
            $this->load->view($index, $data);
            $this->load->view($footer);
        }
    }
}
