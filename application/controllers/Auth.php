<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_check_session();

        $data['title'] = 'Sign In';
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', ['required' => '%s harap diisi!', 'valid_email' => '%s tidak valid!']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]', ['required' => '%s harap diisi!', 'min_length' => '%s minimal 3 karakter!']);
        // $csrf = array(
        //     'name' => $this->security->get_csrf_token_name(),
        //     'hash' => $this->security->get_csrf_hash()
        // );
        // var_dump($csrf);
        // die;

        if ($this->form_validation->run() == FALSE) {
            $this->_views('templates/auth/header', 'auth/index', 'templates/auth/footer', $data);
        } else {
            $this->_signin();
        }
    }

    private function _signin()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        // $remember = $this->input->post('remember', true);

        // if ($remember) {
        //     echo 'ok';
        // }

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];

                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    $this->session->set_flashdata('auth_message', '<div class="flash-data" id="login"></div>');
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('auth_message', '<div class="flash-data" id="login"></div>');
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('auth_message', '<div class="alert alert-danger" role="alert"><span class="alert-icon ua-icon-info"></span><strong>Password salah!</strong> Silahkan isi dengan benar!<span class="close alert__close ua-icon-alert-close" data-dismiss="alert"></span></div>');
                redirect();
            }
        } else {
            $this->session->set_flashdata('auth_message', '<div class="alert alert-danger" role="alert"><span class="alert-icon ua-icon-info"></span>Email tidak terdaftar!<span class="close alert__close ua-icon-alert-close" data-dismiss="alert"></span></div>');
            redirect();
        }
    }

    public function signup()
    {
        $this->_check_session();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => '%s harus diisi!',
            'valid_email' => '%s tidak valid!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[ulangi_password]', [
            'required' => '%s harus diisi!',
            'matches' => '%s tidak sama!',
            'min_length' => '%s minimal 3 karakter!'
        ]);
        $this->form_validation->set_rules('ulangi_password', 'Password', 'required|trim|matches[password]', [
            'required' => '%s harus diisi!',
            'matches' => '%s tidak sama!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Sign Up';
            $this->_views('templates/auth/header', 'auth/signup', 'templates/auth/footer', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('auth_message', '<div class="alert alert-success" role="alert"><span class="alert-icon ua-icon-info"></span><strong>Selamat!</strong> Akun Anda sudah dibuat. Silahkan login!<span class="close alert__close ua-icon-alert-close" data-dismiss="alert"></span></div>');
            redirect();
        }
    }

    public function blocked()
    {
        if (!$this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = '403 - Access Denied';
        $this->_views('templates/auth/header', 'auth/blocked', 'templates/auth/footer', $data);
    }

    private function _check_session()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
    }

    private function _views($header, $index, $footer, $data = null)
    {
        if (is_null($data)) {
            $this->load->view($header);
            $this->load->view($index);
            $this->load->view($footer);
        } else {
            $this->load->view($header, $data);
            $this->load->view($index, $data);
            $this->load->view($footer);
        }
    }

    public function signout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('auth_message', '<div class="alert alert-success" role="alert"><span class="alert-icon ua-icon-info"></span>Anda telah keluar!<span class="close alert__close ua-icon-alert-close" data-dismiss="alert"></span></div>');
        redirect();
    }
}
