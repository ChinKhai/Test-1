<?php
class Frontend extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("Product_model");
    }

    public function home(){
        $this->load->view("header");
        $this->load->view('home');
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

        $config['prev_link']="<i class='fa fa-angle-left'><</i>";
        $config['prev_tag_open']="<li>";
        $config['prev_tag_close']="</li>";

        $config['next_link']="<i class='fa fa-angle-right'>></i>";
        $config['next_tag_open']="<li>";
        $config['next_tag_close']="</li>";

        $config['num_tag_open']="<li>";
        $config['num_tag_close']="</li>";
        $config['cur_tag_open']="<li class='active'><a href='#'>";
        $config['cur_tag_close']="</a></li>";

        $this->pagination->initialize($config);
        $product_data['pagination']=$this->pagination->create_links();

        $this->load->view("header");
        $this->load->view("product_list",$product_data);
    }

    public function add_product(){
        $this->load->view("header");
        $this->load->view('add_product');
    }

    public function update_product($product_id){
        $this->load->view("header");

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
                redirect(base_url('product_list'));
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

            redirect(base_url('product_list'));
        }
        
    }

    public function submit(){
        $product_name = $this->input->post('product_name',true);
        $quantity = $this->input->post('quantity',true);
        

        $this->Product_model->insert(array(
            'product_name'=>$product_name,
            'quantity'=>$quantity,
            'created_date'=>date("Y-m-d H:i:s"),
        ));
        if($this->db->affected_rows() > 0){
            redirect(base_url('product_list'));
        }
    }

    public function dashboard(){
        $this->load->view("header");
        //get the data
        $datalist=$this->Product_model->get_where(array(
            'is_deleted'=>0,
        ));

        //get the date group
        $dateGroup=array();


        //check whether the datalist empty
        if(!empty($datalist)){
            foreach($datalist as $v){
                //show all the data
                //sub string and get the create data from 0-10 bits -> (2001-02-03)
                if(isset($dateGroup[substr($v['created_date'],0,10)])){
                    //if the date exist, it will increase the value 
                    $dateGroup[substr($v['created_date'],0,10)]++;
                }else{
                    //if there is new date, it will make the value of the date become 1
                    $dateGroup[substr($v['created_date'],0,10)]=1;
                }
            }
        }

        //ksort = key sort, sort= value sort
        ksort($dateGroup);

        //array（“横轴”，“纵轴”）
        $finalFormat=array(
            array("Created-date","Quantity")
        );

        //confirm the date group is not empty
        if(!empty($dateGroup)){

            //show the key(created_date) and value(add the product times)
            foreach($dateGroup as $k=>$v){
                $finalFormat[]=array(
                    $k, $v
                );
            }

        }
        //declare the data and bring them to view to proceed
        $this->data['finalFormat']=$finalFormat;

        $this->load->view('dashboard',$this->data);
    }

    public function search(){
        $page_number = $this->input->get('page_number', true);
    
        // Validate page number
        if(!is_numeric($page_number) || $page_number <= 0) {
            // Invalid page number, redirect to product list
            redirect(base_url('product_list'));
        }
    
        // Redirect to the requested page
        redirect(base_url('product_list/' . $page_number));
    }

    //after click a function, it do not go to backend page and can do the read from the web server after doing a function (ajax)
    //need to do an ajax, need to have a API
    public function addqtyAPI(){
        //post the quantity
        $qty=$this->input->post("quantity",true);
        $product_id=$this->input->post("product_id",true);

        //get the data according to the product_id
        $productData=$this->Product_model->getOne(array(
            'product_id'=>$product_id,
        ));

        //check whether the data empty or not
        if(empty($productData)){
            show_error();
        }

        $product_name=$productData['product_name'];

        //Determine the product exists
        $product_Data=$this->Product_model->getOne(array(
            'product_id'=>$product_id,
            'is_deleted'=>0,
        ));
        if(!empty($product_Data)){
            $currentqty=$product_Data['quantity'];
            $totalqty=$currentqty+$qty;

            $this->Product_model->update(array(
                'product_id'=>$product_Data['product_id'],
            ),array(
                'quantity'=>$totalqty,
                'motified_date'=>date("Y-m-d H:i:s"),
            ));
        }else{
            alert("This product doesn't exist!");
        }

        echo json_encode(array(
            'status'=>"OK",
        ));
    }
}
?>