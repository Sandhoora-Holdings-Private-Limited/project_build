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
            $data['page'] = array('header'=>'Apps', 'description'=>'apps accessible for you','app_name'=>'APP NAME');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            //$data['tabs'] = NULL;
            //example
            $lv2_1 = array('name'=>'level 2.1','link'=>base_url().'/Main', 'icon'=>'fa fa-circle-o');
            $lv2_2 = array('name'=>'level 2.2','link'=>base_url().'/Main', 'icon'=>'fa fa-circle-o');
            $lvl1 = array('name'=>'level 1.1','icon'=>'fa fa-link', 'next_level'=>array($lv2_1,$lv2_2));

            $data['tabs'] =  array($lvl1);
            $this->load->view('template/header',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }

    }

    public function login()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $this->load->model('User_model');
            $this->load->model('Role_model');

            $user  = $this->User_model->get_user_data($_POST['email']);

            if($user !== NULL)
            {
                if(hash('sha256', $_POST['password'])==$user['password_hash'])
                {
                	$role_data = $this->Role_model->get_role_acess_data($user['role_id']);
                	$_SESSION['user'] = $user;
                	$_SESSION['access'] = $role_data['access'];
                	$_SESSION['apps'] = $role_data['apps'];
                	$_SESSION['tabs'] = $this->$make_side_menu($role_data['access']);
                	redirect('/Main', 'refresh');
                }
            }
            $data['error'] = true;
        }
        if(isset($_POST['clicked'])) $data['error'] = true;
        else $data['error'] = false;
        $this->load->view('Main/login',$data);
        echo 'USE username : user1@user , password : password';
    }

    public function logout()
    {

    }
}
