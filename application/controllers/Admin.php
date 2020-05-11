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
        $data['title'] = 'Manajemen User';
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
            redirect(site_url('admin/usermanagement'));
        }
    }
    public function deletekelas($id)
    {
        $this->load->model("kelas_model");
        if ($this->kelas_model->deletekelas($id)) {
            redirect(site_url('admin/classmanagement'));
        }
    }
    public function deletematkul($id)
    {
        $this->load->model("kelas_model");
        if ($this->kelas_model->deletematkul($id)) {
            redirect(site_url('admin/matakuliah'));
        }
    }
    public function deletemhs($id, $kelasid)
    {
        $this->load->model("kelas_model");
        if ($this->kelas_model->deletemahasiswa($id)) {
            redirect(site_url('admin/kelas/' . $kelasid));
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
            $this->email->subject('Account Activation Report');
            $this->email->message('Congratulations your account has been activated by Admin!
            Click this link to login : <a href="' . base_url() . '">Link</a>');
        } elseif ($type == 'deactivation') {
            $this->email->subject('Account Deactivation Report');
            $this->email->message('Sorry, your account has been disabled by Admin! 
                Please contact the Laboratory Assistant for more information');
        } else {
            $this->email->subject('Account Deletion Report');
            $this->email->message('Sorry, your account has been deleted by Admin!
                Please contact the Laboratory Assistant for more information');
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
        $data['title'] = 'Akses Role';
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
        Akses diganti!</div>');
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
                    Silakan periksa email Anda untuk mengatur ulang kata sandi Anda!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar atau diaktifkan!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }
    public function matakuliah()
    {
        $data['title'] = 'Manajemen Kelas';
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
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/images/kelas';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $data1 = [
                        'matkul' => $this->input->post('matkul'),
                        'img_url' => 'assets/images/kelas/' . $new_image
                    ];
                    $this->db->insert('user_matkul', $data1);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mata Kuliah Baru ditambahkan!</div>');
                    redirect('admin/matakuliah');
                } else {
                    echo $this->upload->display_errors();
                }
            }
        }
    }
    public function ClassManagement()
    {
        $data['title'] = 'Manajemen Kelas';
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
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Baru ditambahkan!</div>');
            redirect('admin/classmanagement');
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
                'time_per' => time(),
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
                    'status_per' => 0,
                    'latitude' => 0,
                    'longitude' => 0,
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
    public function siswahadir($idper)
    {
        $data['title'] = 'Kehadiran Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kelas_model', 'model1');
        $data['mahasiswa'] = $this->model1->siswaHadir($idper);
        $data['idper'] = $idper;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('daftarkelas/mahasiswahadir', $data);
        $this->load->view('templates/footer');
    }
    public function lokasi($lat, $long)
    {
        $data['title'] = 'Lokasi Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['latitude'] = $lat;
        $data['longitude'] = $long;
        $this->load->view('daftarkelas/peta', $data);
    }

    public function pdf()
    {
        $this->load->library('dompdf_gen');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('data_model');
        $data['mahasiswa'] = $this->data_model->data('user')->result();
        $this->load->view('user/user_pdf',$data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Daftar_user.pdf", array('Attachment'=>0));
    }
    public function kelas_pdf()
    {
        $this->load->library('dompdf_gen');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('data_model');
        $data['kelas'] = $this->data_model->data_kelas('user_kelas')->result();
        $this->load->view('admin/kelas_pdf',$data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Daftar_kelas.pdf", array('Attachment'=>0));
    }
    public function siswahadir_pdf($idper)
    {
        $this->load->library('dompdf_gen');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('kelas_model');
        $data['hadir'] = $this->kelas_model->siswaHadir($idper);
        $this->load->view('admin/siswahadir_pdf',$data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Kehadiran_Mahasiswa.pdf", array('Attachment'=>0));
    }
}
