<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /*public function index()
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Customer', 'description'=>'pick a customer or create new one','app_name'=>'CUSTOMER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $this->load->view('template/header',$data);
            $this->load->view('Customer/index',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }*/
    /*public function new()
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

    }*/
    public function newCus(){
        $data['page'] = array('header'=>'Customer', 'description'=>'pick a customer or create new one','app_name'=>'CUSTOMER');
        //$this->load->view('template/header',$data);
            $this->load->view('Customer/new');
            $this->load->view('template/footer');
    }
    public function Newcustomer(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                        //$this->load->view('Customer/new');
                       // $this->load->view('template/footer');
                        redirect('http://localhost/group-project-1.1/index.php/Customer/newCus', 'refresh');
                }
                else
                {
                       $this->load->model('Customer_model');
                       $this->Customer_model->set_customer_data();
                       
                }
    }
    /*public function aa(){
        //$this->load->view('Customer/list_customer');
        $this->load->model('Customer_model');
        $this->Customer_model->get_customer_data();
    }*/
    public function listcustomer(){
        $this->load->model('Customer_model');
        $data['customers']=$this->Customer_model->get_customer_data();
        $this->load->view('Customer/list_customer',$data);

    }
    public function customerbyid()
    {
        $id = $this->input->post('id');
        $this->load->model('Customer_model');
        $data['customers']=$this->Customer_model->get_data_by_id($id);
        $this->load->view('Customer/list_customer',$data);
    }
    

    
}

