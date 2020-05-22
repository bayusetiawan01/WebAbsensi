<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{
  public function data()
  {
  	return $this->db->get('user');
  }
  public function data_kelas()
  {
  	return $this->db->get('user_kelas');
  }
  public function siswa_hadir()
  {
  	return $this->db->get('user');
  }
}