<?php

class Blank extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("dashboard/blank_view");
	}
}
