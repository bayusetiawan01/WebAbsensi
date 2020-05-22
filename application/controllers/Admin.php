<?php
defined('BASEPATH') or exit('No direct script access allowed');

//load library
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
            $this->email->subject('Laporan Aktivasi Akun');
            $this->email->message('Selamat akun Anda telah diaktivasi oleh Admin! 
                Klik link ini untuk login : <a href="' . base_url() . '">Link</a>');
        } elseif ($type == 'deactivation') {
            $this->email->subject('Laporan Nonaktivasi Akun');
            $this->email->message('Maaf, akun Anda telah dinonaktifkan oleh Admin!
                Silakan hubungi Asisten Laboratorium untuk informasi lebih lanjut');
        } else {
            $this->email->subject('Laporan Penghapusan Akun');
            $this->email->message('Maaf, akun Anda telah dihapus oleh Admin!
                Silakan hubungi Asisten Laboratorium untuk informasi lebih lanjut');
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
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/images/kelas/' . $new_image;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '50%';
                    $config['width'] = 200;
                    $config['height'] = 200;
                    $config['new_image'] = './assets/images/kelas/' . $new_image;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

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
    public function setujuizin($absenid, $kelasid)
    {
        $this->load->model("kelas_model");
        $this->kelas_model->setujuiIzin($absenid, $kelasid);
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
                    'foto' => NULL,
                ];
                $this->db->insert('user_absen', $data3);
            endforeach;
        }
        redirect('admin/kelas/' . $this->input->post('kelas_id'));
    }
    public function addmhs($pointer2)
    {
        $count = 0;
        $member = $this->db->get('user')->result_array();

        foreach ($member as $m) :
            if ($this->input->post($m['npm']) == 1) {
                $data = [
                    'kelas_id' => $pointer2,
                    'npm' => $m['npm']
                ];
                $this->db->insert('user_access_kelas', $data);
                $count++;
            }
        endforeach;

        if ($count != 0) $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Praktikan baru ditambahkan!</div>');
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

    public function user_pdf()
    {
        $this->load->library('pdf');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('data_model');
        $data['mahasiswa'] = $this->data_model->data('user')->result();
        $this->load->view('user/user_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $this->pdf->setPaper($paper_size, $orientation);
        $this->pdf->filename = "LaporanUser.pdf";
        $this->pdf->load_view('user/user_pdf', $data);
    }
    public function kelas_pdf()
    {
        $this->load->library('pdf');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('data_model');
        $data['kelas'] = $this->data_model->data_kelas('user_kelas')->result();
        $this->load->view('admin/kelas_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $this->pdf->setPaper($paper_size, $orientation);
        $this->pdf->load_view('admin/kelas_pdf', $data);
    }
    public function siswahadir_pdf($idper)
    {
        $this->load->library('pdf');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('kelas_model');
        $data['hadir'] = $this->kelas_model->siswaHadir($idper);
        $this->load->view('admin/siswahadir_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $this->pdf->setPaper($paper_size, $orientation);
        $this->pdf->filename = "Kehadiran_Mahasiswa.pdf";
        $this->pdf->load_view('admin/siswahadir_pdf', $data);
    }
    public function detailmhs($npm)
    {
        $data['title'] = 'Detail Kehadiran Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kelas_model', 'model1');
        $data['mahasiswa'] = $this->model1->siswaHadir($npm);
        $data['npm'] = $npm;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('daftarkelas/detailmhs', $data);
        $this->load->view('templates/footer');
    }
    public function time()
    {
        date_default_timezone_set('Asia/Jakarta'); //Menyesuaikan waktu dengan tempat kita tinggal
        echo date('H:i:s'); //Menampilkan Jam Sekarang
    }
    public function hadir($id)
    {
        $query = "SELECT `status_per` FROM `user_absen` WHERE `pertemuan_id` = $id";
        $var = $this->db->query($query)->result_array();
        $hadir = 0;
        foreach ($var as $v) :
            if ($v['status_per'] == 1) $hadir++;
        endforeach;
        echo $hadir;
    }
    public function user_excel()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('data_model');
        $data['mahasiswa'] = $this->data_model->data('user')->result();

        $object = new Spreadsheet();

        $object->getProperties()->setCreator("Calon Asisten Laboratorium");
        $object->getProperties()->setLastModifiedBy("Calon Asisten Laboratorium");
        $object->getProperties()->setTitle("Manajemen User");
        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Name User');
        $object->getActiveSheet()->setCellValue('C1', 'NPM');
        $object->getActiveSheet()->setCellValue('D1', 'Email');
        $object->getActiveSheet()->setCellValue('E1', 'Role');
        $object->getActiveSheet()->setCellValue('F1', 'Aktif');
        $object->getActiveSheet()->setCellValue('G1', 'Tanggal dibuat');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $m) {
            $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $object->getActiveSheet()->setCellValue('B' . $baris, $m->name);
            $object->getActiveSheet()->setCellValue('C' . $baris, $m->npm);
            $object->getActiveSheet()->setCellValue('D' . $baris, $m->email);
            $object->getActiveSheet()->setCellValue('E' . $baris, $m->role_id);
            $object->getActiveSheet()->setCellValue('F' . $baris, $m->is_active);
            $object->getActiveSheet()->setCellValue('G' . $baris, $m->date_created);
            $baris++;
        }

        $object->getActiveSheet()->setTitle("Data User");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
        header('Chache-Control: max-age=0');

        $writer = IOFactory::createWriter($object, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function siswahadir_excel($idper)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('kelas_model');
        $data['hadir'] = $this->kelas_model->siswaHadir($idper);

        $object = new Spreadsheet();

        $object->getProperties()->setCreator("Calon Asisten Laboratorium");
        $object->getProperties()->setLastModifiedBy("Calon Asisten Laboratorium");
        $object->getProperties()->setTitle("Manajemen User");
        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Nama Mahasiswa');
        $object->getActiveSheet()->setCellValue('C1', 'NPM');
        $object->getActiveSheet()->setCellValue('D1', 'Kehadiran');
        $object->getActiveSheet()->setCellValue('E1', 'Lokasi Mahasiswa');

        $baris = 2;
        $no = 1;


        foreach ($data['hadir'] as $h) {
            $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $object->getActiveSheet()->setCellValue('B' . $baris, $h['name']);
            $object->getActiveSheet()->setCellValue('C' . $baris, $h['npm']);
            $object->getActiveSheet()->setCellValue('D' . $baris, $h['status_per']);
            $object->getActiveSheet()->setCellValue('E' . $baris, $h['latitude'] . "/" . $h['longitude']);

            $baris++;
        }

        $filename = "Data_Kehadiran" . '.xlsx';

        $object->getActiveSheet()->setTitle("Data Kehadiran");
        header('Content-Type: application/vnd.openxmlformats-officedocument.scpreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Chache-Control: max-age=0');

        $writer = IOFactory::createwriter($object, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function kelas_excel()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('data_model');
        $data['kelas'] = $this->data_model->data_kelas('user_kelas')->result();

        $object = new Spreadsheet();

        $object->getProperties()->setCreator("Calon Asisten Laboratorium");
        $object->getProperties()->setLastModifiedBy("Calon Asisten Laboratorium");
        $object->getProperties()->setTitle("Manajemen User");
        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Judul');
        $object->getActiveSheet()->setCellValue('C1', 'Mata Kuliah');
        $object->getActiveSheet()->setCellValue('D1', 'Aktif');

        $baris = 2;
        $no = 1;



        foreach ($data['kelas'] as $k) {

            $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $object->getActiveSheet()->setCellValue('B' . $baris, $k->title);
            $object->getActiveSheet()->setCellValue('C' . $baris, $k->matkul_id);
            $object->getActiveSheet()->setCellValue('D' . $baris, $k->is_active);

            $baris++;
        }

        $filename = "Data_Kelas" . '.xlsx';

        $object->getActiveSheet()->setTitle("Data Kelas");
        header('Content-Type: application/vnd.openxmlformats-officedocument.scpreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Chache-Control: max-age=0');

        $writer = IOFactory::createwriter($object, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
