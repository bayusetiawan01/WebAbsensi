<?php

class Icon extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("dashboard/icon_view");
	}
}