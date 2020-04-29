<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    private $_table = "user_matkul";

    public $id;
    public $matkul;

    public function getMahasiswa($p)
    {
        $query = "SELECT `user_access_kelas`.*, `user`.*
        FROM `user_access_kelas` JOIN `user` ON `user_access_kelas`.`npm` = `user`.`npm`
        WHERE kelas_id = $p";

        return $this->db->query($query)->result_array();
    }
    public function getKelas()
    {
        $query = "SELECT `user_kelas`.*, `user_matkul`.`matkul`
        FROM `user_kelas` JOIN `user_matkul` ON `user_kelas`.`matkul_id` = `user_matkul`.`id`";

        return $this->db->query($query)->result_array();
    }
    public function getAkses()
    {
        $query = "SELECT `user_kelas`.*, `user_matkul`.*, `user_access_kelas`.*
        FROM `user_kelas` JOIN `user_matkul` ON `user_kelas`.`matkul_id` = `user_matkul`.`id`
        JOIN `user_access_kelas` ON `user_access_kelas`.`kelas_id` = `user_kelas`.`id`";

        return $this->db->query($query)->result_array();
    }
    public function getDetailclass()
    {
        $query = "SELECT `user_absen`.*, `user_kelas_pertemuan`.*
        FROM `user_absen` JOIN `user_kelas_pertemuan` ON `user_absen`.`pertemuan_id` = `user_kelas_pertemuan`.`id`";
        return $this->db->query($query)->result_array();
    }
    public function delete($phapus)
    {
        return $this->db->delete($this->_table, array("matkul" => $phapus));
    }
}
