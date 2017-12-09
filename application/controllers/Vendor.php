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
            $data['page'] = array('header'=>'Vendors', 'description'=>'pick a project or create new one','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Project List','link'=>base_url().'/Project', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Project','link'=>base_url().'/Project/new', 'icon'=>'fa fa-circle-o');
            $data['tabs'] = array($tab1,$tab2);
            $data['projects'] = $this->Project_model->get_projects_by_user($_SESSION['user']['id']);
            $this->load->view('template/header',$data);
            $this->load->view('Project/main',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }

    }
