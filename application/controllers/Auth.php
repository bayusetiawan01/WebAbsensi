<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('pass');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            //user ada
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                    //redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Akun ini belum diverifikasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email ini belum diaktivasi!</div>');
            redirect('auth');
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('npm', 'Npm', 'required|trim|is_unique[user.npm]|min_length[12]', [
            'min_length' => 'NPM harus memuat 12 karakter!',
            'is_unique' => 'NPM ini sudah terregistrasi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terregistrasi!'
        ]);
        $this->form_validation->set_rules(
            'pass1',
            'Password',
            'required|trim|min_length[6]|matches[pass2]',
            [
                'matches' => 'Password tidak cocok!',
                'min_length' => 'Password harus memuat 6 karakter!'
            ]
        );
        $this->form_validation->set_rules(
            'pass2',
            'Password',
            'required|trim|matches[pass1]'
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'npm' => htmlspecialchars($this->input->post('npm', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat, akun anda berhasil dibuat! Tolong cek email anda, untuk aktivasi akun!</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'ssl://smtp.googlemail.com';            // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'EMAIL';                                // SMTP username
        $mail->Password   = 'PASSWORD';                             // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('absensipraktikum.mtk@gmail.com', 'Absensi Praktikum Matematika Unpad');
        $mail->addAddress($this->input->post('email'));             // Add a recipient

        // Content
        if ($type == 'verify') {
            $data = array(
                'email' => $this->input->post('email'),
                'token' => urlencode($token),
                'text' => "auth/verify?email=",
                'text2' => "Aktivasi",
            );
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verifikasi Akun';
            $mail->Body    = $this->load->view('templates/email_template', $data, true);
            if ($mail->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        } elseif ($type == 'forgot') {
            $data = array(
                'email' => $this->input->post('email'),
                'token' => urlencode($token),
                'text' => "auth/resetpassword?email=",
                'text2' => "Reset Password",
            );
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body    = $this->load->view('templates/email_template', $data, true);
            if ($mail->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
        /*
        $this->load->library('email');
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'EMAIL';
        $config['smtp_pass'] = 'PASSWRD';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('absensipraktikum.mtk@gmail.com', 'Absensi Praktikum Matematika Unpad');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $data = array(
                'email' => $this->input->post('email'),
                'token' => urlencode($token),
                'text' => "auth/verify?email=",
                'text2' => "Aktivasi",
            );
            $this->email->subject('Verifikasi Akun');
            $this->email->message($this->load->view('templates/email_template', $data, true));
        } elseif ($type == 'forgot') {
            $data = array(
                'email' => $this->input->post('email'),
                'token' => urlencode($token),
                'text' => "auth/resetpassword?email=",
                'text2' => "Reset Password",
            );
            $this->email->subject('Reset Password');
            $this->email->message($this->load->view('templates/email_template', $data, true));
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
        */
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])
                ->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    ' . $email . 'sudah aktif, silakan login!</div>');
                    redirect('auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Aktivasi akun gagal! Token sudah kadaluwarsa. </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Aktivasi akun gagal! Token salah. </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Aktivasi akun gagal! Email salah. </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Anda sudah keluar! </div>');
        redirect('auth');
    }
    public function blocked()
    {
        redirect('error403');
    }

    public function forgotPassword()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
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
                Tolong cek email anda untuk mereset password!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email tidak terdaftar atau teraktivasi!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])
                ->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset password gagal! Email salah.</div>');
                redirect('auth/forgotpassword');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password gagal! Email salah.</div>');
            redirect('auth/forgotpassword');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'trim|required|min_length[6]|matches[password2]'
        );
        $this->form_validation->set_rules(
            'password2',
            'Repeat Password',
            'trim|required|min_length[6]|matches[password1]'
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password berhasil diganti. Silahkan login!</div>');
            redirect('auth');
        }
    }
}
