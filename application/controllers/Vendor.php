<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vendor_model');

    }

    public function index()
    {
        if(isset($_SESSION['user']))
         {
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a Vendor or create new customer','app_name'=>'Vendor');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Vendor List','link'=>base_url().'/Vendor/listvendor', 'icon'=>'fa fa-server');
            $tab2 = array('name'=>'New Vendor','link'=>base_url().'/Vendor/new', 'icon'=>'fa fa-plus');
            $data['tabs'] = array($tab1,$tab2);
            $data['vendors'] = $this->Vendor_model->get_vendor_data();
            $this->load->view('template/header',$data);
            $this->load->view('Vendor/list_vendor',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }

    }
   /* public function newVen(){
        $data['page'] = array('header'=>'Vendor', 'description'=>'pick a Vendor or create new one','app_name'=>'VENDOR');
        //$data['page'] = array('header'=>'Projects', 'description'=>'pick a project or create new one','app_name'=>'PROJECTS');
        $data['user'] = $_SESSION['user'];
        $data['apps'] = $_SESSION['apps'];
        
        #$data['tabs'] = 
        $this->load->view('template/header',$data);
        $this->load->view('Vendor/new');
        $this->load->view('template/footer');
    }*/
    public function new()
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Vendor New', 'description'=>'create a new vendor','app_name'=>'VENDOR');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            
            $this->load->view('template/header',$data);
            $this->load->view('Vendor/new',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }
    public function Addnewvendor()
    {
        if(isset($_SESSION['user']))
        {
             $this->Vendor_model->set_vendor_data();
             $data['page'] = array('header'=>'Vendor New', 'description'=>'create a new Vendor','app_name'=>'VENDOR');
             $data['user'] = $_SESSION['user'];
             $data['apps'] = $_SESSION['apps'];
             
             $this->load->view('template/header',$data);
             $this->load->view('Vendor/new',$data);
             $this->load->view('template/footer');
           
            //$this->load->library('form_validation');
            //$this->form_validation->set_rules('name', 'name', 'required');
            //$this->form_validation->set_rules('address', 'address', 'required');
           // $this->form_validation->set_rules('email', 'email', 'required|valid_email');
           // $this->form_validation->set_rules('phone_number', 'phone_number', 'required');

        //if ($this->form_validation->run() == FALSE)
                //{
                       // redirect('/Vendor/new', 'refresh');
               // }
               // else
                //{
                   
                       
                //}

                
           
           
        }
        
    }
     public function listvendor(){
        if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a vendor or create new vendor','app_name'=>'Vendor');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Vendor List','link'=>base_url().'/Vendor/listvendor', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Vendor','link'=>base_url().'/Vendor/new', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2);
            $data['vendors']=$this->Vendor_model->get_vendor_data();
            $this->load->view('template/header',$data);
            $this->load->view('Vendor/list_vendor',$data);
            $this->load->view('template/footer');

        }

    }
    public function vendorbyid()
    {   if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a vendor or create new vendor','app_name'=>'Vendor');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
        $id = $this->input->post('id');
        $this->load->model('Vendor_model');
        $data['vendors']=$this->Vendor_model->get_data_by_id($id);
        $this->load->view('template/header',$data);
        $this->load->view('Vendor/list_vendor',$data);
        $this->load->view('template/footer');
    }
        
        
    
    }
    public function vendorbyidview()
    {
        if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a vendor or create new vendor','app_name'=>'Vendor');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
        $id = $this->input->post('id');
            
            $data['tabs'] = $this->maketab($_SESSION['access'],$id);
       // $data['projects'] =$this->Customer_model->get_project($id);
        $data['vendors']=$this->Vendor_model->get_data_by_id($id);
        $this->load->view('template/header',$data);
        $this->load->view('Vendor/view',$data);
        $this->load->view('template/footer');}
    }
     public function edit(){
        if(isset($_SESSION['user'])){
            $id = $this->input->post('id');
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a vendor or create new vendor','app_name'=>'Vendor');
            $id = $this->input->post('id');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $_SESSION['id'] = $id;
        
        
        $this->load->view('template/header',$data);
        $this->load->view('Vendor/edit',$data);
        $this->load->view('template/footer');
        
    }
       

    }
     public function update(){
        if(isset($_SESSION['user']))
        {
            $id = $_SESSION['id'];
            $this->Vendor_model->update($id);
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a vendor or create new vendor','app_name'=>'Vendor');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['vendors']=$this->Vendor_model->get_vendor_data();
            $data['tabs'] = $this->maketab($_SESSION['access'],$id);
            $this->load->view('template/header',$data);
            $this->load->view('Vendor/list_vendor',$data);
            $this->load->view('template/footer');
                
           
           
        }

    }
     public function deletevendor($id){
        if(isset($_SESSION['user']))
        {
            //$id = $_SESSION['id'];
            $this->Vendor_model->delete($id);
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a vendor or create new vendor','app_name'=>'Vendor');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Vendor List','link'=>base_url().'/Vendor/listvendor', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Vendor','link'=>base_url().'/Vendor/new', 'icon'=>'fa fa-circle-o');
            
            $data['tabs'] = array($tab1,$tab2);
            $data['vendors']=$this->Vendor_model->get_vendor_data();
            $this->load->view('template/header',$data);
            $this->load->view('Vendor/list_vendor',$data);
            $this->load->view('template/footer');

        }

    }
     public function maketab($access, $id){
        //info
        $tab1 = array('name'=>'Info', 'link'=>base_url().'/Vendor/vendorbyidview/'.$id,'icon'=>'fa fa-briefcase');
        //Update Details
        $tab2 = array('name'=>'Update Details', 'link'=>base_url().'/Vendor/edit/'.$id, 'icon'=>'fa fa-briefcase');
        

        return array($tab1,$tab2);
    }

}

    


    /*public function Newvendor(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                        //$this->load->view('Customer/new');
                       // $this->load->view('template/footer');
                        redirect('http://localhost/group-project-1.1/index.php/Vendor/newVen', 'refresh');
                }
                else
                {
                       $this->load->model('Vendor_model');
                       $this->Customer_model->set_vendor_data();
                       
                }
    }
    public function aa(){
        $this->load->view('Vendor/view');
        //$this->load->model('Customer_model');
        //$this->Customer_model->get_customer_data();
    }
    public function listvendor(){
        $this->load->model('Vendor_model');
        $data['vendors']=$this->Vendor_model->get_vendor_data();
        $this->load->view('Vendor/list_vendor',$data);

    }
    public function vnedorbyid()
    {
        $id = $this->input->post('id');
        $this->load->model('Vendor_model');
        $data['vendors']=$this->Vendor_model->get_data_by_id($id);
        $this->load->view('Vendor/list_vendor',$data);
        
    
    }
    public function vendorbyidview()
    {
        $id = $this->input->post('ID');
        $this->load->model('Vendor_model');
        $data['vendors']=$this->Vendor_model->get_data_by_id($id);
        $this->load->view('Vendor/view',$data);
    }
    }*/