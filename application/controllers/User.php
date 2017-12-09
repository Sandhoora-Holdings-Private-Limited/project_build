<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Role_model');

    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name' => 'User List', 'link' => base_url() . '/User/listuser', 'icon' => 'fa fa-circle-o');
            $tab2 = array('name' => 'New user', 'link' => base_url() . '/User/new', 'icon' => 'fa fa-circle-o');
            $tab3 = array('name' => 'Role', 'link' => base_url() . '/User/role', 'icon' => 'fa fa-circle-o');
            $data['tabs'] = array($tab1, $tab2, $tab3);
            $data['users'] = $this->User_model->get_all_users();
            $this->load->view('template/header', $data);
            $this->load->view('User/listuser');
            $this->load->view('template/footer');
        } else {
            redirect('/Main/login', 'refresh');
        }

    }

    public function Addnewuser()
    {
        if (isset($_SESSION['user'])) {

            $this->User_model->set_user_data();
            $data['page'] = array('header' => 'User New', 'description' => 'create a new user', 'app_name' => 'USER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];

            $this->load->view('template/header', $data);
            $this->load->view('User/new', $data);
            $this->load->view('template/footer');


        }

    }


public function new()
  {
      if (isset($_SESSION['user'])) {
          $data['page'] = array('header' => 'User New', 'description' => 'create a new user', 'app_name' => 'USER');
          $data['user'] = $_SESSION['user'];
          $data['apps'] = $_SESSION['apps'];
          $tab1 = array('name' => 'User List', 'link' => base_url() . '/User/listuser', 'icon' => 'fa fa-circle-o');
          $tab2 = array('name' => 'New user', 'link' => base_url() . '/User/new', 'icon' => 'fa fa-circle-o');
          $tab3 = array('name' => 'Role', 'link' => base_url() . '/User/role', 'icon' => 'fa fa-circle-o');
          $data['tabs'] = array($tab1, $tab2, $tab3);

          $this->load->view('template/header', $data);
          $this->load->view('User/new', $data);
          $this->load->view('template/footer');
      }
      else {
          redirect('/Main/login', 'refresh');
      }
    }


    public function role(){
        if(isset($_SESSION['user'])){
            $data['page'] = array('header'=>'User Roles', 'description'=>'pick a role or add new role','app_name'=>'Role');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'User List','link'=>base_url().'/User/listuser', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New User','link'=>base_url().'/User/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Role','link'=>base_url().'/User/role', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
            $data['roles'] = $this->Role_model->get_all_roles();
            $this->load->view('template/header',$data);
            $this->load->view('User/role',$data);
            $this->load->view('template/footer');

        }

    }
    public function listuser()
    {
        if (isset($_SESSION['user'])) {
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'User List','link'=>base_url().'/User/listuser', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New User','link'=>base_url().'/User/new', 'icon'=>'fa fa-circle-o');
            $tab3 = array('name'=>'Role','link'=>base_url().'/User/Role', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2,$tab3);
            $data['users'] = $this->User_model->get_all_users();
            $this->load->view('template/header',$data);
            $this->load->view('User/listuser',$data);
            $this->load->view('template/footer');

        }
    }
}
