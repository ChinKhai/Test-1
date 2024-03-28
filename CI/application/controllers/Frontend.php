<?php
class Frontend extends CI_Controller{
    public function home(){
        $this->load->view("header");
    }

    public function product_list(){
        $this->load->view("header");
        $this->load->model("Product_model");

        $productlist=$this->Product_model->get_where(array(
            'is_deleted'=> 0,
        ));

        $product_data=[
            'List' => $productlist,
        ];


        $this->load->view("product_list",$product_data);
    }

    public function add_product(){
        $this->load->view('header');
        
        $this->load->view('add_product');
    }

    public function update_product($product_id){
        $this->load->view('header');
        $this->load->view('update_product');
    }

    public function delete_product(){
        $this->load->view('delete_product');

    }

    public function submit(){
        $this->load->view("submit");
    }
}

?>