<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
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
    }
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
}
