<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_model extends CI_Model
{
    private $_table = "user_sub_menu";

    public $id;
    public $menu_id;
    public $title;
    public $url;
    public $icon;
    public $is_active;

    public function delete($phapus)
    {
        return $this->db->delete($this->_table, array("title" => $phapus));
    }

    public function edit($id)
    {
        return $this->db->get_where($this->_table,array("id"=>$id));
    }
}
