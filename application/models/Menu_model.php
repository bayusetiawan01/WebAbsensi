<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Menu_model extends Ci_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";
        return $this->db->query($query)->result_array();
        
    }

    public function hapusDataMenu($m)
    {
        $this->db->where('menu_id',$m);
        $this->db->delete('menu_id');
    }
}