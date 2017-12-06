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
            $data['tabs'] = array($tab1,$tab2);
            $data['customers'] = $this->Customer_model->get_customer_data($_SESSION['user']['id']);
            $this->load->view('template/header',$data);
            $this->load->view('Customer/list_customer',$data);
            $this->load->view('template/footer');
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
           
                    $this->Customer_model->set_customer_data();
                    $data['page'] = array('header'=>'Customer New', 'description'=>'create a new customer','app_name'=>'CUSTOMER');
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
            $data['customers']=$this->Customer_model->get_customer_data();
            $this->load->view('template/header',$data);
            $this->load->view('Customer/list_customer',$data);
            $this->load->view('template/footer');

        }

    }
    public function customerbyid()
    {   if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
        $id = $this->input->post('id');
        $this->load->model('Customer_model');
        $data['customers']=$this->Customer_model->get_data_by_id($id);
        $this->load->view('Customer/list_customer',$data);}
        
        
    
    }
    public function customerbyidview()
    {
        if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
        $id = $this->input->post('id');
        $data['customers']=$this->Customer_model->get_data_by_id($id);
        $data['projects'] =$this->Customer_model->get_project($id);
        $this->load->view('template/header',$data);
        $this->load->view('Customer/view',$data);
        $this->load->view('template/footer');}
    }
    public function edit(){
        if(isset($_SESSION['user'])){
            $id = $this->input->post('id');
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $id = $this->input->post('id');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $_SESSION['id'] = $id;
        
        
        $this->load->view('template/header',$data);
        $this->load->view('Customer/edit',$data);
        $this->load->view('template/footer');
        
    }
       

    }
    public function update(){
        if(isset($_SESSION['user']))
        {
            $id = $_SESSION['id'];
            $this->Customer_model->update($id);
            $data['page'] = array('header'=>'Customers', 'description'=>'pick a customer or create new customer','app_name'=>'Customer');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['customers']=$this->Customer_model->get_customer_data();
            $this->load->view('template/header',$data);
            $this->load->view('Customer/list_customer',$data);
            $this->load->view('template/footer');
                
           
           
        }

    }



    
}

