<?php

class Product_model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function get_where($where=array()){
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get('product');
        return $query->result_array();
    }

}

?>