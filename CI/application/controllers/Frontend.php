<?php
class Frontend extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->view("header");
        $this->load->model("Product_model");
    }

    public function home(){
    }


    public function product_list($page=1){
        

      
        $sql=array('is_deleted' => 0,);


        $item_per_page=5;
        $start=($page-1)*$item_per_page;
        $total_records=$this->Product_model->record_count($sql);
        $this->data['product_list']=$this->Product_model->fetch($sql, $item_per_page,$start);
        
        $product_data=[
            'List' => $this->data['product_list'],
        ];

        //print_r($this->db->last_query());exit;

        $this->load->library('pagination');
        $config['base_url']=base_url('product_list');
        $config['total_rows']=$total_records;
        $config['per_page']=$item_per_page;
        $config['use_page_numbers']=true;
        $config['full_tag_open']="<ul class='pagination'>";
        $config['full_tag_close']="</ul>";

        $config['first_link']="First";
        $config['first_tag_open']="<li>";
        $config['first_tag_close']="</li>";

        $config['last_link']="Last";
        $config['last_tag_open']="<li>";
        $config['last_tag_close']="</li>";

        $config['prev_link']="<i class='fa fa-angle-left'></i>";
        $config['prev_tag_open']="<li>";
        $config['prev_tag_close']="</li>";

        $config['next_link']="<i class='fa fa-angle-right'></i>";
        $config['next_tag_open']="<li>";
        $config['next_tag_close']="</li>";

        $config['num_tag_open']="<li>";
        $config['num_tag_close']="</li>";
        $config['cur_tag_open']="<li class='active'><a href='#'>";
        $config['cur_tag_close']="</a></li>";

        $this->pagination->initialize($config);
        $product_data['pagination']=$this->pagination->create_links();

        $this->load->view("product_list",$product_data);
    }

    public function add_product(){
        $this->load->view('add_product');
    }

    public function update_product($product_id){
        $this->data['productData'] = $this->Product_model->getOne(array(
            'product_id'=> $product_id
        ));    
        $this->load->view('update_product',$this->data);

        if(empty($this->data['productData'])){
            alert("This product doesn't exist!");
        }else{
            $id=$this->input->post('id',true);
            $pro_name=$this->input->post('product_name',true);
            $qty=$this->input->post('quantity',true);
    
            $this->Product_model->update(array(
                'product_id'=>$id,
            ),array(
                'product_name'=>$pro_name,
                'quantity'=>$qty,
                'motified_date' =>date("Y-m-d H:i:s"),
            ));

            if($this->db->affected_rows() > 0){
                redirect('product_list');
            }
        }
        
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