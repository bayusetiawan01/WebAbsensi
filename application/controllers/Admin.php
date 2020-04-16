<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model("user_model");
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function usermanagement()
    {
        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['member'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/user_management', $data);
        $this->load->view('templates/footer');
    }
    public function aktivasi($pointer)
    {
        $this->user_model->aktivasi($pointer);
        $this->_sendEmail($pointer, 'activation');
        redirect(site_url('admin/usermanagement'));
    }

    public function deaktivasi($pointer)
    {
        $this->user_model->deaktivasi($pointer);
        $this->_sendEmail($pointer, 'deactivation');
        redirect(site_url('admin/usermanagement'));
    }

    public function delete($id = null)
    {
        if ($this->user_model->delete($id)) {
            $this->_sendEmail($id, 'delete');
            redirect(site_url('admin/usermanagement'));
        }
    }

    private function _sendEmail($pointer, $type)
    {
        $kirim = $this->db->get_where('user', ['npm' => $pointer])->row_array();
        $this->load->library('email');
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'absensipraktikum.mtk@gmail.com';
        $config['smtp_pass'] = 'mataikan123';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('absensipraktikum.mtk@gmail.com', 'Absensi Praktikum Matematika Unpad');
        $this->email->to($kirim['email']);
        if ($type == 'activation') {
            $this->email->subject('Laporan Aktivasi Akun');
            $this->email->message('Selamat akun anda sudah diaktivasi oleh Admin!');
        } elseif ($type == 'deactivation') {
            $this->email->subject('Laporan Penonaktifan Akun');
            $this->email->message('Maaf akun anda dinonaktifkan oleh Admin! Silahkan hubungi Asisten Laboratorium untuk informasi lebih lanjut');
        } else {
            $this->email->subject('Laporan Penghapusan Akun');
            $this->email->message('Maaf akun anda dihapus oleh Admin! Silahkan hubungi Asisten Laboratorium untuk informasi lebih lanjut');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Access Changed!</div>');
    }

    public function setAdmin($pointer)
    {
        $this->user_model->setAdmin($pointer);
        redirect(site_url('admin/usermanagement'));
    }
    public function setUser($pointer)
    {
        $this->user_model->setUser($pointer);
        redirect(site_url('admin/usermanagement'));
    }
}
