<?php
class Frontend extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->view("header");
        $this->load->model("Product_model");
    }

    public function home(){
    }


    public function product_list(){
        $productlist=$this->Product_model->get_where(array(
            'is_deleted'=> 0,
        ));

        $product_data=[
            'List' => $productlist,
        ];


        $this->load->view("product_list",$product_data);
    }

    public function add_product(){
        $this->load->view('add_product');
    }

    public function update_product($product_id){
        $this->data['productData'] = $this->Product_model->getOne(array(
            'product_id'=> $product_id
        ));    

        $id=$this->input->post('id',true);
        $pro_name=$this->input->post('product_name',true);
        $qty=$this->input->post('quantity',true);


        if(empty($this->data['productData'])){
            alert("This product doesn't exist!");
        }else{
            $this->Product_model->update(array(
                'product_id'=>$id,
            ),array(
                'product_name'=>$pro_name,
                'quantity'=>$qty,
                'motified_date' =>date("Y-m-d H:i:s"),
            ));
        }
        $this->load->view('update_product',$this->data);

        

    }

    public function delete_product($product_id){
        $this->data['productData'] = $this->Product_model->getOne(array(
            'product_id'=> $product_id
        ));    

        if(empty($this->data['productData'])){
            alert("This product doesn't exist!");
        }else{
            $this->Product_model->update(array(
                'product_id'=>$product_id,
            ),array(
                'is_deleted'=>1,
            ));

            redirect('product_list');
        }
        
    }

    public function submit(){
        $this->load->view("submit");
    }

    public function update(){

    }
}
?>