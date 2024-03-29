<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
    }
    public function index()
    {
        $data['title'] = 'Test';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('test/index', $data);
        $this->load->view('templates/footer');
    }
}
