<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Page Header', 'description'=>'Page description');
            $data['user'] = array('name'=>'Alex Hndrick', 'email'=>'alex@something@mail.com');
            $this->load->view('template/header',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');;
        }

    }

    public function login()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $data['error'] = false;
        }
        else
        {
            $data['error'] = true;
        }
        $this->load->view('Main/login',$data);
        echo hash('sha256', 'password');
    }

    public function logout()
    {

    }
}
