<?php
class Frontend extends CI_Controller{
    public function home(){
        $this->load->view("header");
    }

    public function product_list(){
        $this->load->view("header");
        $this->load->view("product_list");
    }

    public function add_product(){
        $this->load->view('header');
        $this->load->view('add_product');

    }

    public function update_product(){
        echo "<h1>Update Product</h1>";
    }

    public function view_product(){
        echo "<h1>Product Details</h1>";
    }
}

?>