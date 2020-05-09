<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    private $_table = "user_matkul";
    private $_table2 = "user_kelas";
    private $_table3 = "user_access_kelas";
    private $_table4 = "user_absen";
    public $id;
    public $matkul;

    public function getMahasiswa($p)
    {
        $query = "SELECT `user_access_kelas`.*, `user`.`name`, `user`.`npm`
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
    public function deletematkul($phapus)
    {
        return $this->db->delete($this->_table, array("id" => $phapus));
    }
    public function deletekelas($id)
    {
        return $this->db->delete($this->_table2, array("id" => $id));
    }
    public function deletemahasiswa($id)
    {
        return $this->db->delete($this->_table3, array("id" => $id));
    }
    public function setHadir($pbantu, $p2, $code, $lat, $long, $res)
    {
        if ($p2 <= 180 && $res == $code) {
            $this->db->set("status_per", 1);
            $this->db->set("latitude", $lat);
            $this->db->set("longitude", $long);
            $this->db->where("absen_id", $pbantu);
            $this->db->update($this->_table4);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat anda berhasil mengisi absensi!</div>');
            redirect('user/');
        } elseif ($res != $code) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            QR Code Tidak Cocok, Coba Lagi!</div>');
            redirect('user/');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Maaf waktu habis, Anda gagal mengisi absensi!</div>');
            redirect('user/');
        }
    }
    public function siswaHadir($p)
    {
        $query = "SELECT `user_absen`.*, `user`.`name`, `user_kelas_pertemuan`.`kelas_id`
        FROM `user_absen` JOIN `user_kelas_pertemuan` ON `user_kelas_pertemuan`.`id` = `user_absen`.`pertemuan_id`
        JOIN `user` ON `user_absen`.`npm` = `user`.`npm`
        WHERE pertemuan_id = $p";

        return $this->db->query($query)->result_array();
    }
}
