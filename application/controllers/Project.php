<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
        $this->load->model('Transaction_model');
        $this->load->model('Vendor_model');
        $this->load->model('Budget_model');
        $this->load->model('User_model');
        $this->load->model('Inventory_model');
    }

    //project CRUD pages
    public function index()
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {

            $data['page'] = array('header'=>'Projects', 'description'=>'pick a project or create new one','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Project List','link'=>base_url().'/Project', 'icon'=>'fa fa-tasks');
            $tab2 = array('name'=>'New Project','link'=>base_url().'/Project/new', 'icon'=>'fa fa-plus');
            $data['tabs'] = array($tab1,$tab2);
            $data['projects'] = $this->Project_model->get_projects_by_user($_SESSION['user']['id']);
            $data['data_tables'] = array('table_projects');
            $this->load->view('template/header',$data);
            $this->load->view('Project/main',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function new()
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            if(isset($_POST['form']))
            {
                if($_POST['name'] != "")
                {
                    $result = $this->Project_model->new_project($_POST['name'], $_POST['address'], $_POST['start_date'], $_POST['end_date']);
                    if($result)
                    {
                        $data['sucess'] = true;
                        $data['message'] = 'Sucessfully created the project';
                    }else
                    {
                        $data['fail'] = true;
                        $data['message'] = 'Failed to create the project';
                    }
                }
                else
                {
                    $data['fail'] = true;
                    $data['message'] = 'Please enter a project name';
                }

            }
            $data['page'] = array('header'=>'Project New', 'description'=>'create a new project','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Project List','link'=>base_url().'/Project', 'icon'=>'fa fa-tasks');
            $tab2 = array('name'=>'New Project','link'=>base_url().'/Project/new', 'icon'=>'fa fa-plus');
            $data['tabs'] = array($tab1,$tab2);
            $this->load->view('template/header',$data);
            $this->load->view('Project/new',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function view($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            $project = $this->Project_model->get_project_details($project_id);
            $data['page'] = array('header'=>'Project '.$project->name, 'description'=>'manage your project here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['access'] = $_SESSION['access'];
            $data['project_id'] = $project_id;
            $this->load->view('template/header',$data);
            $this->load->view('Project/view',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //project_team pages
    public function team_members($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_team'])
        {
            if(isset($_POST['type']))
            {
                switch($_POST['type'])
                {
                    case 'remove':
                        $result = $this->User_model->remove_team_member($project_id, $_POST['user_id']);
                        if($result)
                        {
                            $data['sucess'] = true;
                            $data['message'] = "Sucessfully removed team member";
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = "Failed to remove team member";
                        }
                    case 'add':
                        $result = $this->User_model->add_team_member($project_id, $_POST['user_id']);
                        if($result)
                        {
                            $data['sucess'] = true;
                            $data['message'] = "Sucessfully added team member";
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = "Failed to add team member";
                        }
                }
            }
            $data['page'] = array('header'=>'Project team', 'description'=>'pick project team members here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('team_members','non_team_users');
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['team_members'] = $this->User_model->get_team_members($project_id);
            $data['non_team_users'] = $this->User_model->get_non_team_users($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Team/team_members.php',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function team_authority($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_operation_hierachy'])
        {
            if(isset($_POST['id']))
            {
                 $result = $this->User_model->create_approving_user((int)$project_id, $_POST);
                if($result)
                {
                    $data['sucess'] = true;
                    $data['message'] = "Sucessfully updated authorization";
                }
                else
                {
                    $data['fail'] = true;
                    $data['message'] = "Failed to update authorization";
                }
            }
            $data['page'] = array('header'=>'Project team', 'description'=>'pick project team members here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('team_members');
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['team_members'] = $this->User_model->get_team_members($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Team/team_authority',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //project_inventory pages
    public function inventory_dashboard($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_inventory'])
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
                        $result = $this->Inventory_model->stock_transfer($_POST['item_id'],$_POST['no_of_units'],$project_id,1,$_SESSION['user']['id']);
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
            $data['page'] = array('header'=>'Projects inventory stock', 'description'=>'inventory stock','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('table_stock_log');
            $data['stocks'] = $this->Inventory_model->get_stock($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Inventory/inventory_dashboard',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function inventory_stock($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_inventory'])
        {
            $data['page'] = array('header'=>'Projects inventory stock', 'description'=>'inventory stock','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('table_stock_log');
            $data['stocks'] = $this->Inventory_model->get_stock($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Inventory/inventory_stock',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function inventory_log($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_inventory'])
        {
            $data['page'] = array('header'=>'Projects inventory log', 'description'=>'log of all inventory tansactions','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('table_stock_log');
            $data['logs'] = $this->Inventory_model->get_stock_log($project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Inventory/inventory_log',$data);
            $this->load->view('template/footer',$data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //project_budget pages
    public function budget($project_id, $stage_id=NULL)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_budget'])
        {
            $data['page'] = array('header'=>'Projects budget', 'description'=>'view and edite your budget here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('table_stages_budget');
            if($stage_id == NULL)
            {
                if(isset($_POST['new_stage_form']))
                {
                    $result = $this->Budget_model->add_new_stage($project_id, $_POST['stage_name']);
                    if($result)
                    {
                        $data['sucess'] = true;
                        $data['message'] = 'Sucessfully created new stage';
                    }
                    else
                    {
                        $data['fail'] = true;
                        $data['message'] = 'Failed to create new stage';
                    }
                }
                $data['stages'] = $this->Budget_model->get_stages_by_project($project_id);
                $this->load->view('template/header',$data);
                $this->load->view('Project/Budget/budget',$data);
                $this->load->view('template/footer', $data);
            }
            else
            {
                if(isset($_POST['new_entry_form']))
                {
                    if($_POST['new_ammount'] != "")
                    {
                        var_dump($_POST);
                        switch($_POST['type'])
                        {
                            case 'material':
                                $result = $this->Budget_model->create_new_entry($stage_id, $_POST['new_ammount'], $_POST['type'], $_POST['item'], $_POST['price']);
                                break;
                            case 'payment':
                                $result = $this->Budget_model->create_new_entry($stage_id, $_POST['new_ammount'], $_POST['type'], $_POST['name']);
                                break;
                        }
                        if($result)
                        {
                            $data['sucess'] = true;
                            $data['message'] = "Sucessfully created new entry";
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = "Failed to create new entry";
                        }
                    }
                    else
                    {
                        $data['fail'] = true;
                        $data['message'] = "Please enter ammount";
                    }
                }
                $data['form_items'] = $this->Budget_model->get_items_not_in_stage($stage_id);
                $data['form_prices'] = $this->Budget_model->get_price_list();
                $data['items'] = $this->Budget_model->get_entries_material_by_stage($stage_id);
                $data['payments'] = $this->Budget_model->get_entries_payments_by_stage($stage_id);
                $data['stage_id'] = $stage_id;
                $this->load->view('template/header',$data);
                $this->load->view('Project/Budget/budget_stage',$data);
                $this->load->view('template/footer',$data);
            }

        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function budget_change($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_budget'])
        {

            if(isset($_POST['upload']))
            {
                $target_dir = dirname(dirname(__FILE__))."/uploads/budgets/";
                $target_file = $target_dir . basename("project_".$project_id.".cvs");
                $uploadOk = 1;
                $cvsFileType = $_FILES["budget_file"]["type"];
                // Check if file already exists
                if (file_exists($target_file))
                {
                    unlink($target_file);
                }
                // Check file size
                if ($_FILES["budget_file"]["size"] > 500000)
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
                    if(move_uploaded_file($_FILES["budget_file"]["tmp_name"], $target_file)) {
                        $result = $this->Budget_model->process_cvs($project_id, $target_file);
                        if($result)
                        {
                            $data['sucess'] = true;
                            $data['message'] = "The file ". basename( $_FILES["budget_file"]["name"]). " has been processed.";
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = "Failed to process file ". basename( $_FILES["budget_file"]["name"]). " .";
                        }
                    } else {
                        $data['fail'] = true;
                        $data['message'] = "Sorry, there was an error uploading your file.";
                    }
                }
            }
            $data['page'] = array('header'=>'Projects budget', 'description'=>'add or change you buget here upload a CSV','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $this->load->view('template/header',$data);
            $this->load->view('Project/Budget/budget_change',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //project_operation_pages
    public function operation_inbox($project_id, $active_tab='tab_approvals')
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            if(isset($_POST['type']))
            {
                switch($_POST['type'])
                {
                    case 'approve' :
                    {
                        $result = $this->Transaction_model->approve_transaction($_POST['transaction_id'],$_SESSION['user']['id'],1,$_POST['transaction_type']);
                        if(!$result)
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Failed to approve transaction '.$_POST['transaction_type'].' '.$_POST['transaction_id'];
                        }
                        else
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully approved transaction '.$_POST['transaction_type'].' '.$_POST['transaction_id'];
                        }
                        break;
                    }
                    case 'denie' :
                    {
                        $result = $this->Transaction_model->approve_transaction($_POST['transaction_id'],$_SESSION['user']['id'],0,$_POST['transaction_type']);
                        if(!$result)
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Failed to denie transaction '.$_POST['transaction_type'].' '.$_POST['transaction_id'];
                        }
                        else
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully denied transaction '.$_POST['transaction_type'].' '.$_POST['transaction_id'];
                        }
                        break;
                    }
                    case 'view' :
                    {
                        $data['view_transaction_details'] = true;
                        $modal_data = $this->Transaction_model->get_material_transaction_budegte_datails($_POST['transaction_id'],$project_id);
                        $data['transaction_id'] = $_POST['transaction_id'];
                        $data['modal_data'] = $modal_data;
                        $remaining = $modal_data['budgeted_ammount_on_stage'] - $modal_data['spent_on_stage'];
                        if($remaining < 0)
                        {
                            $remaining = 0 - $remaining;
                            $d_items = $d_items = array(
                                array('name'=>'Remaining','value'=>$remaining),
                                array('name'=>'To be recived','value'=>$modal_data['pending_on_stage']),
                                array('name'=>'In stock','value'=>$modal_data['in_project_stock']) );
                        }
                        else
                        {
                            $d_items = array(
                                array('name'=>'To be recived','value'=>$modal_data['pending_on_stage']),
                                array('name'=>'In stock','value'=>$modal_data['in_project_stock']),
                                array('name'=>'Remaining','value'=>$remaining));
                        }


                        $donut_chart['id'] = 'budet_detail';
                        $donut_chart['items'] = $d_items;

                        $data['donut_charts'] = array($donut_chart);
                        break;
                    }
                    case 'split':
                    {
                        if($_POST['split_ammount'] != "" )
                        {
                            if($_POST['split_ammount'] == $_POST['request_ammount'])
                            {
                                $result = $this->Transaction_model->approve_and_transfer_material_transaction($_POST['transaction_id'], $_SESSION['user']['id'], $project_id);
                            }
                            else
                            {
                                $result = $this->Transaction_model->split_transaction($_POST['transaction_id'], $_SESSION['user']['id'],$_POST['split_ammount'], $project_id);
                            }
                            if($result)
                            {
                                $data['sucess'] = true;
                                $data['message'] = 'Sucessfully splited transaction and approved';
                            }
                            else
                            {
                                $data['fail'] = true;
                                $data['message'] = 'Failed to split transaction';
                            }
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Please insert transfer ammount to split tranaction';
                        }

                        break;
                    }
                    case 'pay':
                        $result = $this->Transaction_model->change_transaction_state($_POST['transaction_id'],'paid', 'other_payment');
                        if($result)
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully paid transaction '.$_POST['transaction_id'];
                        }
                        else
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Failed to pay transaction '.$_POST['transaction_id'];
                        }
                        break;
                }
            }
            $data['page'] = array('header'=>'Inbox', 'description'=>'Requests need your approval','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $transactions['to_be_approved'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_purchased'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_purchased');
            $transactions['to_be_recived'] = $this->Transaction_model->get_material_transaction_data_with_po($project_id);
            $transactions['to_be_transfered'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_transfered');

            $transactions['to_be_approved_other'] = $this->Transaction_model->get_other_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_paid_other'] = $this->Transaction_model->get_other_transaction_data_by_state($project_id, 'to_be_paid');

            $data['POs'] = $this->Transaction_model->get_all_POs();
            $data['transactions'] = $transactions;
            $data['data_tables'] = array('table_approvals', 'table_purchases', 'table_recivables','table_pay');
            $data['active_tab'] = $active_tab;
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/operation_inbox',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function operation_inbox_create_purchase_order($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            $data['page'] = array('header'=>'Inbox', 'description'=>'Requests need your approval','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $data['vendors'] = $this->Vendor_model->get_all_vendors();
            $transactions = array();
            if(isset($_POST['po_form']))
            {
                $j = 6;
                if(isset($_POST['po_id']))
                    $data['po_id'] = $_POST['po_id'];
                if(isset($_POST['vendor']))
                    $data['vendor'] = $this->Vendor_model->get_vendor_details_by_id($_POST['vendor']);
                else
                {
                    $j--;
                    $data['fail'] = true;
                    $data['message'] = 'Please pick a vendor';
                }
                if(isset($_POST['tax']))
                    $data['tax'] = $_POST['tax'];
                else
                {
                    $j--;
                    $data['fail'] = true;
                    $data['message'] = 'Please enter tax percentage';
                }
                if(isset($_POST['date']))
                    $data['date'] = $_POST['date'];
                else
                {
                    $j--;
                    $data['fail'] = true;
                    $data['message'] = 'Please pick a order date';
                }
                for ($i=0; $i < sizeof($_POST)-$j; $i++)
                {
                    array_push($transactions, $this->Transaction_model->get_material_transaction_details($_POST['t_'.$i]));
                }
                if(sizeof($_POST) == $j)
                {
                    $data['fail'] = true;
                    $data['message'] = 'Go back and pick some items to putchase';
                }
                //Sucess
                if(!isset($data['fail']) && !isset($_POST['print']))
                {
                    $transaction_ids = array();
                    for ($i=0; $i < sizeof($_POST)-$j; $i++)
                    {
                        array_push($transaction_ids, $_POST['t_'.$i]);
                    }
                    $result = $this->Transaction_model->create_PO($transaction_ids, $_POST['vendor'],$_SESSION['user']['id'], $_POST['date']);
                    if($result)
                    {
                        $data['sucess'] = true;
                        $date['message'] = 'Sucessfully created purchase order';
                        $data['po_id'] = $result;
                    }
                    else
                    {
                        $data['failed'] = true;
                        $date['message'] = 'Failed created purchase order';
                    }

                }
            }
            else
            {
                if(isset($_POST['table_purchases_length']))
                    unset($_POST['table_purchases_length']);
                foreach ($_POST as $id)
                {
                    $there_is_items = true;
                    array_push($transactions, $this->Transaction_model->get_material_transaction_details($id));
                }
                if(!isset($there_is_items))
                {
                    $data['failed'] = true;
                    $date['message'] = 'Please go back and pick items to purchase';
                }
            }
            $data['transactions'] = $transactions;

            if(isset($_POST['print']))
            {
                $this->load->view('Project/Operation/inbox/print/operation_inbox_material_PO_print',$data);
            }
            else
            {
                $this->load->view('template/header',$data);
                $this->load->view('Project/Operation/inbox/operation_inbox_material_PO',$data);
                $this->load->view('template/footer');
            }

        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function operation_inbox_pay_purchase_order($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            $data['page'] = array('header'=>'Inbox', 'description'=>'Requests need your approval','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            if(isset($_POST['tab_pay_length']))
                    unset($_POST['tab_pay_length']);
            $transaction_ids = $this->Transaction_model->get_PO_items($_POST['po_id']);
            $transactions = array();
            foreach ($transaction_ids as $transaction)
            {
                array_push($transactions, $this->Transaction_model->get_material_transaction_details($transaction->transaction_id));
            }
            $data['transactions'] = $transactions;
            $data['po'] = $this->Transaction_model->get_PO_details($_POST['po_id']);
            $data['po_id'] = $_POST['po_id'];
            if(isset($_POST['po_pay_form']))
            {
                $result = $this->Transaction_model->pay_PO($transaction_ids, $_POST['po_id']);
                if($result)
                {
                    $data['sucess'] = true;
                    $data['message'] = 'Sucessully recorded payment on #PO-'.$_POST['po_id'];
                }
                else
                {
                    $data['fail'] = true;
                    $data['message'] = 'Failed to record payment on #PO-'.$_POST['po_id'];
                }
            }
            if(isset($_POST['print']))
            {
                $this->load->view('Project/Operation/inbox/print/operation_inbox_material_pay_print',$data);
            }
            else
            {
                $data['data_tables'] = array('table_PO_reconsiliation');
                $this->load->view('template/header',$data);
                $this->load->view('Project/Operation/inbox/operation_inbox_material_pay',$data);
                $this->load->view('template/footer',$data);
            }
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function operation_inbox_confirm_goods_recived($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            $data['page'] = array('header'=>'Inbox', 'description'=>'Requests need your approval','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $transactions = array();
            if(isset($_POST['table_recivables_length']))
                    unset($_POST['table_recivables_length']);
            if(isset($_POST['gr_form']))
            {
                $j = 3;
                for ($i=0; $i < (sizeof($_POST)-$j)/2; $i++)
                {
                    array_push($transactions, $this->Transaction_model->get_material_transaction_details($_POST['t_'.$i]));
                }
                if(sizeof($_POST) == $j)
                {
                    $data['fail'] = true;
                    $data['message'] = 'Go back and pick recived items';
                }
                //Sucess
                if(!isset($data['fail']) && !isset($_POST['print']))
                {
                    $transaction_ids = array();
                    for ($i=0; $i < (sizeof($_POST)-$j)/2; $i++)
                    {
                        $transaction = array('state' => $_POST['t_state_'.$i], 'id' => $_POST['t_'.$i]);
                        array_push($transaction_ids, $transaction);
                    }
                    $result = $this->Transaction_model->create_GR($transaction_ids, $project_id, $_SESSION['user']['id']);
                    if($result)
                    {
                        $data['sucess'] = true;
                        $date['message'] = 'Sucessfully created goods recived note';
                    }
                    else
                    {
                        $data['failed'] = true;
                        $date['message'] = 'Failed created goods recived note';
                    }

                }
            }
            else
            {
                foreach ($_POST as $id)
                {
                    $there_is_items = true;
                    array_push($transactions, $this->Transaction_model->get_material_transaction_details($id));
                }
                if(!isset($there_is_items))
                {
                    $data['failed'] = true;
                    $date['message'] = 'Please go back and pick items to purchase';
                }
            }
            $data['transactions'] = $transactions;

            if(isset($_POST['print']))
            {
                $this->load->view('Project/Operation/inbox/print/operation_inbox_material_GR_print',$data);
            }
            else
            {
                $data['data_tables'] = array('table_GR_items');
                $this->load->view('template/header',$data);
                $this->load->view('Project/Operation/inbox/operation_inbox_material_GR',$data);
                $this->load->view('template/footer',$data);
            }

        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function operation_request($project_id, $stage_id=NULL)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            $data['page'] = array('header'=>'Create requests', 'description'=>'Create requests for material and other payments','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $data['data_tables'] = array('table_stages_material_request','table_stages_material_request');
            if($stage_id == NULL)
            {
                $data['stages'] = $this->Budget_model->get_stages_by_project($project_id);
                $this->load->view('template/header',$data);
                $this->load->view('Project/Operation/operation_request',$data);
                $this->load->view('template/footer',$data);
            }
            else
            {
                if(isset($_POST['budget_entry_id']))
                {
                    $result = $this->Transaction_model->create_transaction($_POST['budget_entry_id'], $_POST['ammount'], $_POST['type']);
                    if($result)
                    {
                        $data['sucess'] = true;
                        $data['message'] = "Sucessfully created the request";
                    }
                    else
                    {
                        $data['fail'] = true;
                        $data['message'] = "Failed to create request";
                    }
                }
                $data['items'] = $this->Budget_model->get_entries_material_by_stage($stage_id);
                $data['payments'] = $this->Budget_model->get_entries_payments_by_stage($stage_id);
                $data['stage_id'] = $stage_id;
                $this->load->view('template/header',$data);
                $this->load->view('Project/Operation/operation_request_stage',$data);
                $this->load->view('template/footer',$data);
            }
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function operation_pending($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            $data['page'] = array('header'=>'Pending requests', 'description'=>'Your pending requests','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;

            $transactions['to_be_approved'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_purchased'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_purchased');
            $transactions['to_be_recived'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_recived');
            $transactions['to_be_transfered'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_transfered');
            $transactions['to_be_paid'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'to_be_paid');

            $transactions['to_be_approved_other'] = $this->Transaction_model->get_other_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_paid_other'] = $this->Transaction_model->get_other_transaction_data_by_state($project_id, 'to_be_paid');

            $data['transactions'] = $transactions;
            $data['data_tables'] = array('table_pending_requesst');
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/operation_pending',$data);
            $this->load->view('template/footer', $data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function operation_history($project_id)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project'])
        {
            $data['page'] = array('header'=>'Pending requests', 'description'=>'Your pending requests','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;

            $transactions['paid'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'paid');
            $transactions['denied'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'denied');
            $transactions['transfered'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'transfered');
            $transactions['splitted'] = $this->Transaction_model->get_material_transaction_data_by_state($project_id, 'splitted');

            $transactions['paid_other'] = $this->Transaction_model->get_other_transaction_data_by_state($project_id, 'paid');
            $transactions['denied_other'] = $this->Transaction_model->get_other_transaction_data_by_state($project_id, 'denied');

            $data['transactions'] = $transactions;
            $data['data_tables'] = array('table_history_requesst');
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/operation_history',$data);
            $this->load->view('template/footer', $data);
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //operation_analytics pages
    public function analytics($project_id, $stage_id=NULL)
    {
        if(isset($_SESSION['user']) && $_SESSION['access']['project_customer'])
        {
            $data['page'] = array('header'=>'Projects Analytics', 'description'=>'cost analysis on your project','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            if($stage_id == NULL)
            {
                $project_data = $this->Budget_model->get_project_budget_details($project_id);
                if($project_data['remaining'] < 0)
                {//over spent
                    $remaining = 0 - $project_data['remaining'];
                    $project_dc = array(
                        array('name'=>'Spent','value'=>$project_data['spent']),
                        array('name'=>'Pending', 'value'=>$project_data['pending']),
                        array('name'=>'Over spent', 'value'=>$remaining));
                }
                else
                {
                    $project_dc = array(
                        array('name'=>'Spent','value'=>$project_data['spent']),
                        array('name'=>'Pending', 'value'=>$project_data['pending']),
                        array('name'=>'Remaining', 'value'=>$project_data['remaining']));
                }
                $donut_charts = array(
                    array('id' => 'project', 'items' => $project_dc));

                $stages = $this->Budget_model->get_stages_by_project($project_id);
                $stages_data= array();
                foreach ($stages as $stage) {
                    $stage_data = $this->Budget_model->get_stage_budget_details($stage->id);
                    $stage_data['id'] = $stage->id;
                    array_push($stages_data, $stage_data);
                    if($stage_data['remaining'] < 0)
                    {//over spent
                        $remaining = 0 - $stage_data['remaining'];
                        $stage_dc = array(
                            array('name'=>'Spent','value'=>$stage_data['spent']),
                            array('name'=>'Pending', 'value'=>$stage_data['pending']),
                            array('name'=>'Over spent', 'value'=>$remaining));
                    }
                    else
                    {
                        $stage_dc = array(
                            array('name'=>'Spent','value'=>$stage_data['spent']),
                            array('name'=>'Pending', 'value'=>$stage_data['pending']),
                            array('name'=>'Remaining', 'value'=>$stage_data['remaining']));
                    }
                    $stage_push = array('id'=>'stage_'.$stage->id, 'items'=>$stage_dc);
                    array_push($donut_charts, $stage_push);
                }

                $data['stages'] = $stages_data;
                $data['donut_charts'] = $donut_charts;
                $data['data_tables'] = array('table_stage_anayltics');
                $this->load->view('template/header',$data);
                $this->load->view('Project/Analytics/analytics_project',$data);
                $this->load->view('template/footer', $data);
            }
            else
            {
                $donut_charts = array();
                //material budget entries
                $items = $this->Budget_model->get_entries_material_by_stage($stage_id);
                $items_data= array();
                foreach ($items as $item)
                {
                    $item_data = $this->Budget_model->get_entry_material_budget_details($item->item_id);
                    array_push($items_data, $item_data);
                    if($item_data['remaining'] < 0)
                    {//over spent
                        $remaining = 0 - $item_data['remaining'];
                        $item_dc = array(
                            array('name'=>'Spent','value'=>$item_data['spent']),
                            array('name'=>'Pending', 'value'=>$item_data['pending']),
                            array('name'=>'Over spent', 'value'=>$remaining));
                    }
                    else
                    {
                        $item_dc = array(
                            array('name'=>'Spent','value'=>$item_data['spent']),
                            array('name'=>'Pending', 'value'=>$item_data['pending']),
                            array('name'=>'Remaining', 'value'=>$item_data['remaining']));
                    }
                    $item_push = array('id'=>'item_'.$item_data['id'], 'items'=>$item_dc);
                    array_push($donut_charts, $item_push);
                }

                //payments budget entries
                $payments = $this->Budget_model->get_entries_payments_by_stage($stage_id);
                $payments_data= array();
                foreach ($payments as $payment)
                {
                    $payment_data = $this->Budget_model->get_entry_other_budget_details($payment->budget_entry_id);
                    array_push($payments_data, $payment_data);
                    if($payment_data['remaining'] < 0)
                    {//over spent
                        $remaining = 0 - $payment_data['remaining'];
                        $payment_dc = array(
                            array('name'=>'Spent','value'=>$payment_data['spent']),
                            array('name'=>'Pending', 'value'=>$payment_data['pending']),
                            array('name'=>'Over spent', 'value'=>$remaining));
                    }
                    else
                    {
                        $payment_dc = array(
                            array('name'=>'Spent','value'=>$payment_data['spent']),
                            array('name'=>'Pending', 'value'=>$payment_data['pending']),
                            array('name'=>'Remaining', 'value'=>$payment_data['remaining']));
                    }
                    $payment_push = array('id'=>'payment_'.$payment_data['id'], 'items'=>$payment_dc);
                    array_push($donut_charts, $payment_push);
                }
                $data['payments'] = $payments_data;
                $data['items'] = $items_data;
                $data['donut_charts'] = $donut_charts;
                $data['data_tables'] = array('table_stage_anayltics');
                $this->load->view('template/header',$data);
                $this->load->view('Project/Analytics/analytics_stage',$data);
                $this->load->view('template/footer', $data);
            }

        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    //private functions
    function make_tabs($access, $project_id)
    {
        //Dashboard
        $tab1 = array('name'=>'Dashboard','link'=>base_url().'/Project/view/'.$project_id, 'icon'=>'fa fa-briefcase');
        //Analytics
        $tab2 = array('name'=>'Analytics','link'=>base_url().'/Project/analytics/'.$project_id, 'icon'=>'fa fa-line-chart');
        //Inventory
        $tab3_1 = array('name'=>'Dashboard','link'=>base_url().'/Project/inventory_dashboard/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab3_2 = array('name'=>'Stock','link'=>base_url().'/Project/inventory_stock/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab3_3 = array('name'=>'Log','link'=>base_url().'/Project/inventory_log/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab3 = array('name'=>'Inventory', 'icon'=>'fa fa-fw fa-cubes', 'next_level'=>array($tab3_1,$tab3_2,$tab3_3));

        //Team
        $tab4_1 = array('name'=>'Members','link'=>base_url().'/Project/team_members/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab4_2 = array('name'=>'Authority','link'=>base_url().'/Project/team_authority/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab4 = array('name'=>'Team','icon'=>'fa fa-fw fa-users','next_level'=>array($tab4_1,$tab4_2,));

        //Budget
        $tab5_1 = array('name'=>'View','link'=>base_url().'/Project/budget/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab5_2 = array('name'=>'Change','link'=>base_url().'/Project/budget_change/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab5 = array('name'=>'Budget', 'icon'=>'fa fa-fw fa-calculator','next_level'=>array($tab5_1,$tab5_2));

        //Opperation
        $tab6_1 = array('name'=>'Inbox','link'=>base_url().'/Project/operation_inbox/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab6_2 = array('name'=>'Create request','link'=>base_url().'/Project/operation_request/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab6_3 = array('name'=>'Pending request','link'=>base_url().'/Project/operation_pending/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab6_4 = array('name'=>'Request history','link'=>base_url().'/Project/operation_history/'.$project_id, 'icon'=>'fa fa-fw fa-circle-o');
        $tab6 = array('name'=>'Operation','link'=>base_url().'/Project/operation/'.$project_id, 'icon'=>'fa fa-fw fa-inbox','next_level'=>array($tab6_1,$tab6_2,$tab6_3,$tab6_4));

        $return_ary = array();
        if($access['project'])
        {
            array_push($return_ary, $tab1);
            array_push($return_ary, $tab6);
        }
        if($access['project_customer'])
        {
            array_push($return_ary, $tab2);
        }
        if($access['project_inventory'])
        {
            array_push($return_ary, $tab3);
        }
        if($access['project_team'])
        {
            array_push($return_ary, $tab4);
        }
        if($access['project_budget'])
        {
            array_push($return_ary, $tab5);
        }

        return $return_ary;
    }
}
