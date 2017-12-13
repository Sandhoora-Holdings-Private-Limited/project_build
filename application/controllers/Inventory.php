<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventory_model');
        $this->load->model('Project_model');
    }

    //inventory_stock pages
    public function index()
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['inventory'])
        {
            $project_id = 1;
            $data['page'] = array('header'=>'Inventory stock', 'description'=>'inventory stock','app_name'=>'INVENTORY');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access']);
            $data['data_tables'] = array('table_stock_log');
            $data['stocks'] = $this->Inventory_model->get_stock($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Inventory/inventory_stock',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //inventory operation page
     public function inventory_dashboard()
    {
    	$project_id = 1;
        if(isset($_SESSION['user']) && $_SESSION['access']['inventory_stock'])
        {
            if(isset($_POST['item_id']))
            {
                if($_POST['no_of_units']!="")
                {
                    if(isset($_POST['out']))
                    {//transfer out
                        $result = $this->Inventory_model->stock_out($project_id, $_POST['item_id'], $_POST['no_of_units'], $_SESSION['user']['id']);
                    }
                    else
                    {//transfer to main
                        $result = $this->Inventory_model->stock_transfer($_POST['item_id'],$_POST['no_of_units'],1,$_POST['to_project_id'],$_SESSION['user']['id']);
                    }
                    if($result)
                    {
                        $data['sucess'] = true;
                        $data['message'] = 'Sucessfully transfered';
                    }
                    else
                    {
                        $data['fail'] = true;
                        $data['message'] = 'Failed to transfer';
                    }
                }
                else
                {
                    $data['fail'] = true;
                    $data['message'] = 'Please enter an ammount to transfer';
                }
            }
            $data['projects'] = $this->Project_model->get_all_projects();
            $data['page'] = array('header'=>'Inventory Dashboard', 'description'=>'do stock operations here','app_name'=>'INVENTORY');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['data_tables'] = array('table_stock_log');
            $data['stocks'] = $this->Inventory_model->get_stock($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Inventory/inventory_dashboard',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //inventory log page
    public function inventory_log()
    {
    	$project_id = 1;
        if(isset($_SESSION['user']) && $_SESSION['access']['inventory'])
        {
            $data['page'] = array('header'=>'Inventory log', 'description'=>'log of all inventory tansactions','app_name'=>'INVENTORY');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('table_stock_log');
            $data['logs'] = $this->Inventory_model->get_stock_log($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Inventory/inventory_log',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //item_list pages
    public function item_list()
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['inventory_item'])
        {
            if(isset($_POST['new_item_form']))
            {
                $result = $this->Inventory_model->add_new_item($_POST['item_name'],$_POST['item_unit']);
                if($result)
                {
                    $data['sucess'] = true;
                    $data['message'] = 'Sucessfully added the item';
                }
                else
                {
                    $data['fail'] = true;
                    $data['message'] = 'Failed to add the item';
                }
            }
            if(isset($_POST['upload']))
            {
                $target_dir = dirname(dirname(__FILE__))."/uploads/";
                $target_file = $target_dir . basename("uploaded_item_list.cvs");
                $uploadOk = 1;
                $cvsFileType = $_FILES["item_list_file"]["type"];
                // Check if file already exists
                if (file_exists($target_file))
                {
                    unlink($target_file);
                }
                // Check file size
                if ($_FILES["item_list_file"]["size"] > 500000)
                {
                    $data['fail'] = true;
                    $data['message'] = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($cvsFileType != "cvs" && $cvsFileType !=  "text/csv" && $cvsFileType !=  "text" && $cvsFileType !=  "csv/text")
                {
                    $data['fail'] = true;
                    $data['message'] = "Sorry, only cvs allowed.";
                    $uploadOk = 0;
                }
                //upload file
                if ($uploadOk != 0)
                {
                    if(move_uploaded_file($_FILES["item_list_file"]["tmp_name"], $target_file)) {
                        $result = $this->Inventory_model->process_cvs_item_list($target_file);
                        if($result)
                        {
                            $data['sucess'] = true;
                            $data['message'] = "The file ". basename( $_FILES["item_list_file"]["name"]). " has been processed.";
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = "Failed to process file ". basename( $_FILES["item_list_file"]["name"]). " .";
                        }
                    } else {
                        $data['fail'] = true;
                        $data['message'] = "Sorry, there was an error uploading your file.";
                    }
                }
            }
            $data['page'] = array('header'=>'Inventory Items', 'description'=>'add , edite  ypur items here','app_name'=>'INVENTORY');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access']);
            $data['data_tables'] = array('table_items');
            $data['items'] = $this->Inventory_model->get_all_items();
            $this->load->view('template/header',$data);
            $this->load->view('Inventory/item_list',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //price_list pages
    public function price_list($list_id=NULL)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['inventory_price'])
        {
            if($list_id==NULL)
            {
                if(isset($_POST['new_list_form']))
                {
                    if(isset($_POST['upload']))
                    {
                        $target_dir = dirname(dirname(__FILE__))."/uploads/";
                        $target_file = $target_dir . basename("uploaded_price_list.cvs");
                        $uploadOk = 1;
                        $cvsFileType = $_FILES["price_list_file"]["type"];
                        // Check if file already exists
                        if (file_exists($target_file))
                        {
                            unlink($target_file);
                        }
                        // Check file size
                        if ($_FILES["price_list_file"]["size"] > 500000)
                        {
                            $data['fail'] = true;
                            $data['message'] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if($cvsFileType != "cvs" && $cvsFileType !=  "text/csv" && $cvsFileType !=  "text" && $cvsFileType !=  "csv/text")
                        {
                            $data['fail'] = true;
                            $data['message'] = "Sorry, only cvs allowed.";
                            $uploadOk = 0;
                        }
                        //upload file
                        if ($uploadOk != 0)
                        {
                            if(move_uploaded_file($_FILES["price_list_file"]["tmp_name"], $target_file)) {
                                $result = $this->Inventory_model->process_cvs_price_list($target_file,$_POST['list_name']);
                                if($result)
                                {
                                    $data['sucess'] = true;
                                    $data['message'] = "The file ". basename( $_FILES["price_list_file"]["name"]). " has been processed.";
                                }
                                else
                                {
                                    $data['fail'] = true;
                                    $data['message'] = "Failed to process file ". basename( $_FILES["price_list_file"]["name"]). " .";
                                }
                            } else {
                                $data['fail'] = true;
                                $data['message'] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }
                    else
                    {
                        $result = $this->Inventory_model->add_new_price_list($_POST['list_name']);
                        if($result)
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully added the item';
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Failed to add the item';
                        }
                    }
                }
                $data['page'] = array('header'=>'Inventory Price Lists', 'description'=>'manage your price lists here','app_name'=>'INVENTORY');
                $data['user'] = $_SESSION['user'];
                $data['apps'] = $_SESSION['apps'];
                $data['tabs'] = $this->make_tabs($_SESSION['access']);
                $data['data_tables'] = array('table_price_lists');
                $data['lists'] = $this->Inventory_model->get_all_price_lists();
                $this->load->view('template/header',$data);
                $this->load->view('Inventory/price_lists',$data);
                $this->load->view('template/footer',$data);
            }
            else
            {
                if(isset($_POST['new_price_form']))
                {
                    var_dump($_POST);
                    $result = $this->Inventory_model->add_new_price($_POST['new_item_id'],$list_id,$_POST['new_price']);
                    if($result)
                    {
                        $data['sucess'] = true;
                        $data['message'] = 'Sucessfully added the item';
                    }
                    else
                    {
                        $data['fail'] = true;
                        $data['message'] = 'Failed to add the item';
                    }
                }
                $data['page'] = array('header'=>'Inventory Price List ', 'description'=>'manage your price lists here','app_name'=>'INVENTORY');
                $data['user'] = $_SESSION['user'];
                $data['apps'] = $_SESSION['apps'];
                $data['tabs'] = $this->make_tabs($_SESSION['access']);
                $data['data_tables'] = array('table_prices');
                $data['prices'] = $this->Inventory_model->get_all_prices($list_id);
                $data['items'] = $this->Inventory_model->get_all_items();
                $data['list_id'] = $list_id;
                $this->load->view('template/header',$data);
                $this->load->view('Inventory/single_price_list',$data);
                $this->load->view('template/footer',$data);
            }
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //private functions
    function make_tabs($access)
    {
        //Inventory
        $tab1_1 = array('name'=>'Stock','link'=>base_url().'/Inventory', 'icon'=>'fa fa-fw fa-circle-o');
        $tab1_2 = array('name'=>'Dashboard','link'=>base_url().'/Inventory/inventory_dashboard/' , 'icon'=>'fa fa-fw fa-circle-o');
        $tab1_3 = array('name'=>'Log','link'=>base_url().'/Inventory/inventory_log/' , 'icon'=>'fa fa-fw fa-circle-o');
        $tab1 = array('name'=>'Inventory', 'icon'=>'fa fa-fw fa-cubes', 'next_level'=>array($tab1_1,$tab1_2,$tab1_3));
        //Items
        $tab2 = array('name'=>'Item list','link'=>base_url().'/Inventory/item_list/' , 'icon'=>'fa fa-fw fa-cube');
        //Price list
        $tab3 = array('name'=>'Price list','link'=>base_url().'/Inventory/price_list/' , 'icon'=>'fa fa-fw fa-money');

        $return_ary = array();
        if($access['inventory_stock'])
        {
            array_push($return_ary, $tab1);
        }
        if($access['inventory_item'])
        {
            array_push($return_ary, $tab2);
        }
        if($access['inventory_price'])
        {
            array_push($return_ary, $tab3);
        }
        return $return_ary;
    }
}
