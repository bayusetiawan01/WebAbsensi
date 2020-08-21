<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function index()
	{
		$this->load->library('mypdf');
		$data['data']  = array(
			['npm' => '140110180063'],
			['nim']
		);
		$this->mypdf->generate('Laporan/dompdf', $data);
	}
}
