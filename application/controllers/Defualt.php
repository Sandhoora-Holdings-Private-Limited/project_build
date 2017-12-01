<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defualt extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page'] = array('header'=>'Page Header', 'description'=>'Page description');
        $data['user'] = array('name'=>'Alex Hndrick', 'email'=>'alex@something@mail.com');
        $data['user'] = array('name'=>'Alex Hndrick', 'email'=>'alex@something@mail.com','app'=>'Defualt','tabs'=>array('new_customer','list_customer'));
        $this->load->view('template/header',$data);
        $this->load->view('template/footer');
    }

    public function function_name($parameter_name)
    {

    }
}
