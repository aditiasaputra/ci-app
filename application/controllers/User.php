<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login(get_class($this));
    }

    public function index()
    {
        $data['title'] = 'Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->_views('templates/header', 'templates/sidebar', 'user/index', 'templates/footer', $data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Profil';
        $this->db->select('nama, user.email, image, tempat, tgl_lahir, jabatan, jenis_kelamin, agama, hp_telepon, ktp_sim');
        $this->db->from('user');
        $this->db->join('user_profile', 'user.email = user_profile.email');
        $data['user'] = $this->db->get()->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('ttl', 'Tempat Tanggal Lahir', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('agama', 'Agama', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('hp_telepon', 'Nomor hp/telepon', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('ktp_sim', 'Nomor KTP/SIM', 'trim|required', ['required' => '%s harus diisi!']);

        if ($this->form_validation->run() == FALSE) {
            $this->_views('templates/header', 'templates/sidebar', 'user/edit', 'templates/footer', $data);
        } else {
            $ttl = explode(',', $this->input->post('ttl'));
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $user_profile = [
                'tempat' => htmlspecialchars($ttl[0]),
                'tgl_lahir' => htmlspecialchars($ttl[1]),
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'hp_telepon' => htmlspecialchars($this->input->post('hp_telepon', true)),
                'ktp_sim' => htmlspecialchars($this->input->post('ktp_sim', true)),
            ];

            // cek gambar
            $upload_gambar = $_FILES['gambar']['name'];
            // var_dump($upload_gambar);
            // die;

            if (isset($upload_gambar)) {
                $config['upload_path'] = './assets/img/avatars/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite'] = true;
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'default.png') {
                        unlink(FCPATH . 'assets/img/avatars/' . $gambar_lama);
                    }
                    $gambar_baru = $this->upload->data('file_name');
                    $config['image_library'] = 'gd2';
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('message', '<div class="flash-data" id="foto-edit">' . $this->upload->display_errors() . '</div>');
                    redirect('user/edit');
                }
            }
            // var_dump($user_profile);
            // var_dump($nama);
            // var_dump($email);
            // die;

            $this->db->where('email', $email);
            $this->db->update('user', ['nama' => $nama]);
            $this->db->update('user_profile', $user_profile);

            $this->session->set_flashdata('message', '<div class="flash-data" id="user-success"></div>');
            redirect('user');
        }
    }

    public function ubahPassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_lama', 'Password lama', 'trim|required', ['required' => '%s harus diisi!']);
        $this->form_validation->set_rules('password_baru1', 'Password baru', 'trim|required|min_length[3]|matches[password_baru2]', [
            'required' => '%s harus diisi!',
            'matches' => '%s tidak sama!',
            'min_length' => '%s minimal 3 karakter!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Ulangi password baru', 'trim|required|min_length[3]|matches[password_baru1]', [
            'required' => '%s harus diisi!',
            'matches' => '%s tidak sama!'
        ]);


        if ($this->form_validation->run() == FALSE) {
            $this->_views('templates/header', 'templates/sidebar', 'user/ubahpassword', 'templates/footer', $data);
        } else {
            $this->_ubah();
        }
    }

    private function _ubah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru1');

        if (!password_verify($password_lama, $data['user']['password'])) {
            $this->session->set_flashdata('message', '<div class="flash-data" id="password-error">Password lama Anda salah! Silahkan coba lagi!</div>');
            redirect('user/ubahpassword');
        } else {
            if ($password_lama === $password_baru) {
                $this->session->set_flashdata('message', '<div class="flash-data" id="password-lama-baru">Password baru tidak boleh sama dengan password lama!</div>');
                redirect('user/ubahpassword');
            } else {
                // password sudah ok
                $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="flash-data" id="password-success">Password berhasil diubah!</div>');
                redirect('user/ubahpassword');
            }
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
