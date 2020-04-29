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

    public function delete($id)
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
            $this->email->message('Selamat akun anda sudah diaktivasi oleh Admin!
            Click this link to login : <a href="' . base_url() . '">Link</a>');
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

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Please check your email to reset your password!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email is not registered or activated!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }
    public function matakuliah()
    {
        $data['title'] = 'Class Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['matkul'] = $this->db->get('user_matkul')->result_array();

        $this->form_validation->set_rules('matkul', 'Mata Kuliah', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/matakuliah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_matkul', ['matkul' => $this->input->post('matkul')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Lesson Added!</div>');
            redirect('admin/matakuliah');
        }
    }
    public function ClassManagement()
    {
        $data['title'] = 'Class Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kelas_model', 'kelas');

        $data['kelas'] = $this->kelas->getKelas();
        $data['matkul'] = $this->db->get('user_matkul')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('matkul_id', 'Mata Kuliah', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/kelas', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'matkul_id' => $this->input->post('matkul_id'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_kelas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Class Added!</div>');
            redirect('admin/kelas');
        }
    }

    // Halaman Kelas Admin
    public function kelas($pointer2)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['member'] = $this->db->get('user')->result_array();
        $data['akses'] = $this->db->get('user_access_kelas')->result_array();
        $data['pertemuan'] = $this->db->get_where('user_kelas_pertemuan', ['kelas_id' => $pointer2])->result_array();
        $this->load->model('Kelas_model', 'model1');
        $data['mahasiswa'] = $this->model1->getMahasiswa($pointer2);
        $kelas = $this->db->get_where('user_kelas', ['id' => $pointer2])->row_array();
        $matkul = $this->db->get_where('user_matkul', ['id' => $kelas['matkul_id']])->row_array();
        $data['title'] = $matkul['matkul'] . ' ' . $kelas['title'];
        $data['kelas'] = $kelas;
        $data['matkul'] = $matkul;
        $data['kelasid'] = $pointer2;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('daftarkelas/kelas', $data);
        $this->load->view('templates/footer');
    }
    public function addpertemuan()
    {
        $this->load->model('Kelas_model', 'model1');
        $mahasiswa = $this->model1->getMahasiswa($this->input->post('kelas_id'));
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
        $this->form_validation->set_rules('kelas_id', 'kelas_id', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kelas_id' => $this->input->post('kelas_id'),
                'tanggal' => $this->input->post('tanggal'),
                'keterangan' => $this->input->post('keterangan'),
                'time_per' => time()
            ];
            $this->db->insert('user_kelas_pertemuan', $data);
            $pertemuan = $this->db->get('user_kelas_pertemuan')->result_array();
            foreach ($pertemuan as $p) :
                $perid = $p['id'];
            endforeach;
            foreach ($mahasiswa as $m) :
                $data3 = [
                    'npm' => $m['npm'],
                    'pertemuan_id' => $perid,
                    'status_per' => 0
                ];
                $this->db->insert('user_absen', $data3);
            endforeach;
        }
        redirect('admin/kelas/' . $this->input->post('kelas_id'));
    }
    public function addmhs($pointer1, $pointer2)
    {
        $data = [
            'kelas_id' => $pointer2,
            'npm' => $pointer1
        ];
        $this->db->insert('user_access_kelas', $data);
        redirect('admin/kelas/' . $pointer2);
    }
    public function absen()
    {
        $data['title'] = 'Absen Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['absen'] = $this->db->get('user_absensi')->result_array();

        $this->form_validation->set_rules('matkul', 'Mata Kuliah', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/absen', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_matkul', ['matkul' => $this->input->post('matkul')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Lesson Added!</div>');
            redirect('admin/matakuliah');
        }
    }
}
