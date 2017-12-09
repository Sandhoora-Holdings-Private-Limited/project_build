<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');

    }

    public function index()
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Customer List','link'=>base_url().'/Customer/listcustomer', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Customer','link'=>base_url().'/Customer/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Payment','link'=>base_url().'/Customer/makepayment', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
            $data['customers'] = $this->Customer_model->get_customer_data($_SESSION['user']['id']);
            $data['data_tables'] = array('customer_details');
            $this->load->view('template/header',$data);
            $this->load->view('Customer/list_customer',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }

    }
    public function new()
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Customer New', 'description'=>'create a new customer','app_name'=>'CUSTOMER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Customer List','link'=>base_url().'/Customer/listcustomer', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Customer','link'=>base_url().'/Customer/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Payment','link'=>base_url().'/Customer/makepayment', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
            
            $this->load->view('template/header',$data);
            $this->load->view('Customer/new',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }



    }
   /* public function newCus(){
        $data['page'] = array('header'=>'Customer', 'description'=>'pick a customer or create new one','app_name'=>'CUSTOMER');
        $data['page'] = array('header'=>'Projects', 'description'=>'pick a project or create new one','app_name'=>'PROJECTS');
        $data['user'] = $_SESSION['user'];
        $data['apps'] = $_SESSION['apps'];
        
        #$data['tabs'] = 
        $this->load->view('template/header',$data);
        $this->load->view('Customer/new');
        $this->load->view('template/footer');
    }*/
    public function Addnewcustomer()
    {
        if(isset($_SESSION['user']))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'name', 'required');
            if ($this->form_validation->run() == FALSE)
                {
                        $data['fail'] = true;
                        $data['message'] = 'Validation Error';
                }
                else
                {
                        $result =$this->Customer_model->set_customer_data();
                        if($result)
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Failed to add Customer ';
                        }
                        else
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully added Customer ';
                        }
                }
                $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
                $data['user'] = $_SESSION['user'];
                $data['apps'] = $_SESSION['apps'];
                    
                    $this->load->view('template/header',$data);
                    $this->load->view('Customer/new',$data);
                    $this->load->view('template/footer');
                
           
           
        }
        
    }
    
    
    public function listcustomer(){
        if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            
            $tab1 = array('name'=>'Customer List','link'=>base_url().'/Customer/listcustomer', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Customer','link'=>base_url().'/Customer/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Payment','link'=>base_url().'/Customer/makepayment', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
            $data['data_tables'] = array('customer_details');
            $data['customers']=$this->Customer_model->get_customer_data();
            $this->load->view('template/header',$data);
            $this->load->view('Customer/list_customer',$data);
            $this->load->view('template/footer',$data);

        }

    }
    public function customerbyid()
    {   if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Customer List','link'=>base_url().'/Customer/listcustomer', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Customer','link'=>base_url().'/Customer/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Payment','link'=>base_url().'/Customer/makepayment', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
        $id = $this->input->post('id');
        $this->load->model('Customer_model');
        $data['customers']=$this->Customer_model->get_data_by_id($id);
        $this->load->view('template/header',$data);
        $this->load->view('Customer/list_customer',$data);
        $this->load->view('template/footer');
    }
        
        
    
    }
    public function customerbyidview($id)
    {
        if(isset($_SESSION['user'])){
            //$id = $this->input->post('id');
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->maketab($_SESSION['access'],$id);
        //$id = $this->input->post('id');
        $data['customers']=$this->Customer_model->get_data_by_id($id);
        $data['projects'] =$this->Customer_model->get_project($id);
        $this->load->view('template/header',$data);
        $this->load->view('Customer/view',$data);
        $this->load->view('template/footer');}
    }
    public function edit($id){
        if(isset($_SESSION['user'])){
            //$id = $this->input->post('id');
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            //$id = $this->input->post('id');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['id'] = $id;
            $data['tabs'] = $this->maketab($_SESSION['access'],$id);
            //$_SESSION['id'] = $id;
        
        
        $this->load->view('template/header',$data);
        $this->load->view('Customer/edit',$data);
        $this->load->view('template/footer');
        
    }
       

    }
    public function update($id){
        if(isset($_SESSION['user']))
        {
            //$id = $_SESSION['id'];
            $this->Customer_model->update($id);
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['customers']=$this->Customer_model->get_customer_data();
            $data['tabs'] = $this->maketab($_SESSION['access'],$id);
            $this->load->view('template/header',$data);
            $this->load->view('Customer/list_customer',$data);
            $this->load->view('template/footer');
                
           
           
        }

    }
    public function deletecustomer($id){
        if(isset($_SESSION['user']))
        {
            $this->Customer_model->delete($id);
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Customer List','link'=>base_url().'/Customer/listcustomer', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Customer','link'=>base_url().'/Customer/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Payment','link'=>base_url().'/Customer/makepayment', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
            $data['customers']=$this->Customer_model->get_customer_data();
            $this->load->view('template/header',$data);
            $this->load->view('Customer/list_customer',$data);
            $this->load->view('template/footer');

        }
    }
    public function makepayment(){
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Customer New', 'description'=>'create a new customer','app_name'=>'CUSTOMER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Customer List','link'=>base_url().'/Customer/listcustomer', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Customer','link'=>base_url().'/Customer/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Payment','link'=>base_url().'/Customer/makepayment', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
            
            $this->load->view('template/header',$data);
            $this->load->view('Customer/makepayment',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }


    }
    public function payment(){
        if(isset($_SESSION['user'])){
        $this->Customer_model->makepayment();
        $data['page'] = array('header'=>'Customer New', 'description'=>'create a new customer','app_name'=>'CUSTOMER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            
            $this->load->view('template/header',$data);
            $this->load->view('Customer/makepayment',$data);
            $this->load->view('template/footer');
    }
    }

    public function makepaymentbyid($id){
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Customer New', 'description'=>'create a new customer','app_name'=>'CUSTOMER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['id'] = $id;
            $data['tabs'] = $this->maketab($_SESSION['access'],$id);
            $this->load->view('template/header',$data);
            $this->load->view('Customer/makepaymentbyid',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }

    }
    public function paymentbyid($id){
        if(isset($_SESSION['user'])){
            $id = $id;
        $this->Customer_model->makepaymentbyid($id);
        $data['page'] = array('header'=>'Customer New', 'description'=>'create a new customer','app_name'=>'CUSTOMER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            
            $this->load->view('template/header',$data);
            $this->load->view('Customer/makepaymentbyid',$data);
            $this->load->view('template/footer');
    }
    }

    

    public function maketab($access, $id){
        //info
        $tab1 = array('name'=>'Info', 'link'=>base_url().'/Customer/customerbyidview/'.$id,'icon'=>'fa fa-briefcase');
        //Update Details
        $tab2 = array('name'=>'Update Details', 'link'=>base_url().'/Customer/edit/'.$id, 'icon'=>'fa fa-briefcase');
        //payment
        $tab3_1 = array('name'=>'Make Payment', 'link'=>base_url().'/Customer/makepaymentbyid/'.$id,'icon'=>'fa fa-fw fa-circle-o');
        $tab3_2 = array('name'=>'View Payment Details', 'link'=>base_url().'','icon'=>'fa fa-fw fa-circle-o');
        $tab3 = array('name'=>'Payment','icon'=>'fa fa-fw fa-cubes','next_level'=>array($tab3_1,$tab3_2));

        return array($tab1,$tab2,$tab3);
    }
    
    public function opertion(){
        if(isset($_SESSION['user']))
        {
            $result =$this->Customer_model->set_customer_data();
            if(!$result)
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Failed to approve transaction ';
                        }
                        else
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully approved transaction ';
                        }
                        $data['page'] = array('header'=>'Customer New', 'description'=>'create a new customer','app_name'=>'CUSTOMER');
                    $data['user'] = $_SESSION['user'];
                    $data['apps'] = $_SESSION['apps'];
                    
                    $this->load->view('template/header',$data);
                    $this->load->view('Customer/new',$data);
                    $this->load->view('template/footer');
        }
    }

    //$this->load->library('form_validation');
            //$this->form_validation->set_rules('name', 'name', 'required');
            //$this->form_validation->set_rules('address', 'address', 'required');
           // $this->form_validation->set_rules('email', 'email', 'required|valid_email');
           // $this->form_validation->set_rules('phone_number', 'phone_number', 'required');







    
}

