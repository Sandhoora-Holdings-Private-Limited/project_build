<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects', 'description'=>'pick a project or create new one','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $this->load->view('template/header',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }

    }

    public function new()
    {

    }

    public function team()
    {

    }

    public function opperation_request()
    {

    }

    public function opperation_pending()
    {

    }

    public function opperation_inbox()
    {

    }

    function make_tabs($access, $project_id)
    {
        $lv2_1 = array('name'=>'level 2.1','link'=>base_url().'/Main', 'icon'=>'fa fa-circle-o');
            $lv2_2 = array('name'=>'level 2.2','link'=>base_url().'/Main', 'icon'=>'fa fa-circle-o');
            $lvl1 = array('name'=>'level 1.1','icon'=>'fa fa-link', 'next_level'=>array($lv2_1,$lv2_2));

            $data['tabs'] =  array($lvl1);

    }
}
