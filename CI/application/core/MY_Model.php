<?php
class MY_Model extends CI_Model{
    protected $tablename="";

    public function __construct(){
        $this->load->database();
    }

    //可以抓一笔的资料
    public function getOne($where=array()){
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get('product');
        return $query->row_array();         //return associated array
    }

    //抓多笔的资料  
    public function get_where($where=array()){
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get('product');
        return $query->result_array();      //return multidimensional array
    }

    public function insert($insert_array=array())
    {
        //Insert tablename and array
        $this->db->insert($this->tablename,$insert_array);
        return $this->db->insert_id();
    }

    public function update($where=array(),$update_array=array())
    {
        $this->db->update($this->tablename,$update_array,$where);
    }
}

?>