<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login(get_class($this));
    }

    public function index()
    {
        $data['title'] = 'Manajemen Menu';
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'trim|required', ['required' => '%s harus diisi!']);

        if ($this->form_validation->run() == FALSE) {
            $this->_views('templates/header', 'templates/sidebar', 'menu/index', 'templates/footer', $data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="flash-data" data-menu="' . $this->input->post('menu') . '" id="menu-success"></div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Manajemen Submenu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->db->select('user_sub_menu.id, menu, title, url, icon, is_active');
        $this->db->from('user_sub_menu');
        $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
        $this->db->order_by('user_sub_menu.menu_id', 'asc');

        $data['submenu'] = $this->db->get()->result_array();

        $this->form_validation->set_rules('title', 'Judul', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('menu_id', 'Menu', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('url', 'URL', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('icon', 'Icon', 'trim|required', ['required' => '%s harus diisi!']);

        if ($this->form_validation->run() == FALSE) {
            $this->_views('templates/header', 'templates/sidebar', 'menu/submenu', 'templates/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="flash-data" data-menu="' . $this->input->post('title') . '" id="menu-success"></div>');
            redirect('menu/submenu');
        }
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
