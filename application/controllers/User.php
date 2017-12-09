<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name' => 'User List', 'link' => base_url() . '/User/listuser', 'icon' => 'fa fa-circle-o');
            $tab2 = array('name' => 'New User', 'link' => base_url() . '/User/new', 'icon' => 'fa fa-circle-o');
            $data['tabs'] = array($tab1, $tab2,);
            $data['users'] = $this->User_model->get_user_data($_SESSION['user']['id']);
            $this->load->view('template/header', $data);
            $this->load->view('User/listuser', $data);
            $this->load->view('template/footer');
        } else {
            redirect('/Main/login', 'refresh');
        }

    }

    public function new()
    {
        if (isset($_SESSION['user'])) {
            $data['page'] = array('header' => 'User New', 'description' => 'create a new user', 'app_name' => 'USER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];


            $this->load->view('template/header', $data);
            $this->load->view('User/new', $data);
            $this->load->view('template/footer');
        } else {
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
    public function Addnewuser()
    {
        if (isset($_SESSION['user'])) {

            $this->User_model->set_user_data();
            $data['page'] = array('header' => 'User New', 'description' => 'create a new user', 'app_name' => 'USER');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];

            $this->load->view('template/header', $data);
            $this->load->view('Customer/new', $data);
            $this->load->view('template/footer');


        }

    }


    public function listuser()
    {
        if (isset($_SESSION['user'])) {
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name' => 'User List', 'link' => base_url() . '/User/listuser', 'icon' => 'fa fa-circle-o');
            $tab2 = array('name' => 'New User', 'link' => base_url() . '/User/new', 'icon' => 'fa fa-circle-o');
            $data['tabs'] = array($tab1, $tab2, );
            $data['customers'] = $this->User_model->get_user_data();
            $this->load->view('template/header', $data);
            $this->load->view('Customer/list_customer', $data);
            $this->load->view('template/footer');

        }

    }

    public function userbyid()
    {
        if (isset($_SESSION['user'])) {
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $id = $this->input->post('id');
            $this->load->model('User_model');
            $data['users'] = $this->User_model->get_data_by_id($id);
            $this->load->view('template/header', $data);
            $this->load->view('Customer/list_customer', $data);
            $this->load->view('template/footer');
        }


    }

    public function customerbyidview($id)
    {
        if (isset($_SESSION['user'])) {
            //$id = $this->input->post('id');
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->maketab($_SESSION['access'], $id);
            //$id = $this->input->post('id');
            $data['users'] = $this->User_model->get_data_by_id($id);
            $data['roles'] = $this->User_model->get_role($id);
            $this->load->view('template/header', $data);
            $this->load->view('Customer/view', $data);
            $this->load->view('template/footer');
        }
    }

    public function edit($id)
    {
        if (isset($_SESSION['user'])) {
            //$id = $this->input->post('id');
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            //$id = $this->input->post('id');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['id'] = $id;
            //$_SESSION['id'] = $id;


            $this->load->view('template/header', $data);
            $this->load->view('Customer/edit', $data);
            $this->load->view('template/footer');

        }


    }

    public function update($id)
    {
        if (isset($_SESSION['user'])) {
            //$id = $_SESSION['id'];
            $this->User_model->update($id);
            $data['page'] = array('header' => 'Users', 'description' => 'pick a user or create new user', 'app_name' => 'User');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['users'] = $this->User_model->get_user_data();
            $data['tabs'] = $this->maketab($_SESSION['access'], $id);
            $this->load->view('template/header', $data);
            $this->load->view('User/listuser', $data);
            $this->load->view('template/footer');


        }

    }

    public function delete()
    {
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['id'];
            $this->User_model->delete($id);
        }
    }
}