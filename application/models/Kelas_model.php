<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    private $_table = "user_matkul";

    public $id;
    public $matkul;


    public function getKelas()
    {
        $query = "SELECT `user_kelas`.*, `user_matkul`.`matkul`
        FROM `user_kelas` JOIN `user_matkul` ON `user_kelas`.`matkul_id` = `user_matkul`.`id`";

        return $this->db->query($query)->result_array();
    }
    public function delete($phapus)
    {
        return $this->db->delete($this->_table, array("matkul" => $phapus));
    }
}
