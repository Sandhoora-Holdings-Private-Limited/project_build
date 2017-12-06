<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
        $this->load->model('Transaction_material_model');
        $this->load->model('Vendor_model');
        $this->load->model('Budget_model');
    }

    public function index()
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects', 'description'=>'pick a project or create new one','app_name'=>'PROJECTS');
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

    public function new()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_POST['form']))
            {
                $this->Project_model->new_project($_POST['name'], $_POST['address'], $_POST['start_date'], $_POST['end_date']);
                $data['sucess'] = true;
                $data['error'] = false;
            }
            $data['page'] = array('header'=>'Project New', 'description'=>'create a new project','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $tab1 = array('name'=>'Project List','link'=>base_url().'/Project', 'icon'=>'fa fa-circle-o');
            $tab2 = array('name'=>'New Project','link'=>base_url().'/Project/new', 'icon'=>'fa fa-circle-o');
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
        if(isset($_SESSION['user']))
        {
            $project = $this->Project_model->get_project_details($project_id);
            $data['page'] = array('header'=>'Project '.$project->name, 'description'=>'manage your project here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/view',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function team_members($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Project team', 'description'=>'pick project team members here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Team/team_members.php',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function team_authority($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects team authorization', 'description'=>'pick who calls the shots in this project','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Team/team_authority',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function inventory_dashboard($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects Inventory', 'description'=>'move items in and out from here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Inventory/inventory_dashboard',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function inventory_stock($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects inventory stock', 'description'=>'get details of current stock','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Inventory/inventory_stock',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function inventory_log($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects inventory log', 'description'=>'log of all inventory tansactions','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Inventory/inventory_log',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function budget($project_id, $stage_id=NULL)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects budget', 'description'=>'view and edite your budget here','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['data_tables'] = array('table1');
            $data['project_id'] = $project_id;
            $this->load->view('template/header',$data);
            $this->load->view('Project/Budget/budget',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function budget_change($project_id)
    {
        if(isset($_SESSION['user']))
        {
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

    public function operation_inbox($project_id, $active_tab='tab_approvals')
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_POST['type']))
            {
                switch($_POST['type'])
                {
                    case 'approve' :
                    {
                        $result = $this->Transaction_material_model->approve_transaction($_POST['transaction_id'],$_SESSION['user']['id'],1,$_POST['transaction_type']);
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
                        $result = $this->Transaction_material_model->approve_transaction($_POST['transaction_id'],$_SESSION['user']['id'],0,$_POST['transaction_type']);
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
                        break;
                    }
                    case 'split':
                    {
                        $data['fail'] = true;
                        $data['sucess'] = true;
                        $data['message'] = 'some message';
                        break;
                    }
                    case 'transfer':
                    {
                        $data['fail'] = true;
                        $data['sucess'] = true;
                        $data['message'] = 'some message';
                        break;
                    }
                    case 'pay':
                        $result = $this->Transaction_material_model->change_transaction_state($_POST['transaction_id'],'paid', 'other_payment');
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
            $transactions['to_be_approved'] = $this->Transaction_material_model->get_material_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_purchased'] = $this->Transaction_material_model->get_material_transaction_data_by_state($project_id, 'to_be_purchased');
            $transactions['to_be_recived'] = $this->Transaction_material_model->get_material_transaction_data_with_po($project_id);
            $transactions['to_be_transfered'] = $this->Transaction_material_model->get_material_transaction_data_by_state($project_id, 'to_be_transfered');

            $transactions['to_be_approved_other'] = $this->Transaction_material_model->get_other_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_paid_other'] = $this->Transaction_material_model->get_other_transaction_data_by_state($project_id, 'to_be_paid');

            $data['POs'] = $this->Transaction_material_model->get_all_POs();
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
        if(isset($_SESSION['user']))
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
                    array_push($transactions, $this->Transaction_material_model->get_material_transaction_details($_POST['t_'.$i]));
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
                    $result = $this->Transaction_material_model->create_PO($transaction_ids, $_POST['vendor'],$_SESSION['user']['id'], $_POST['date']);
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
                    array_push($transactions, $this->Transaction_material_model->get_material_transaction_details($id));
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
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Inbox', 'description'=>'Requests need your approval','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            if(isset($_POST['tab_pay_length']))
                    unset($_POST['tab_pay_length']);
            $transaction_ids = $this->Transaction_material_model->get_PO_items($_POST['po_id']);
            $transactions = array();
            foreach ($transaction_ids as $transaction)
            {
                array_push($transactions, $this->Transaction_material_model->get_material_transaction_details($transaction->transaction_id));
            }
            $data['transactions'] = $transactions;
            $data['po'] = $this->Transaction_material_model->get_PO_details($_POST['po_id']);
            $data['po_id'] = $_POST['po_id'];
            if(isset($_POST['po_pay_form']))
            {
                $result = $this->Transaction_material_model->pay_PO($transaction_ids, $_POST['po_id']);
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
        if(isset($_SESSION['user']))
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
                    array_push($transactions, $this->Transaction_material_model->get_material_transaction_details($_POST['t_'.$i]));
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
                    $result = $this->Transaction_material_model->create_GR($transaction_ids, $project_id, $_SESSION['user']['id']);
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
                    array_push($transactions, $this->Transaction_material_model->get_material_transaction_details($id));
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
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Create requests', 'description'=>'Create requests for material and other payments','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            if($stage_id == NULL)
            {
                $data['data_tables'] = array('table_stages_material_request');
                $data['stages'] = $this->Budget_model->get_stages_by_project($project_id);
                $this->load->view('template/header',$data);
                $this->load->view('Project/Operation/operation_request',$data);
                $this->load->view('template/footer',$data);
            }
            else
            {

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
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Pending requests', 'description'=>'Your pending requests','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/operation_pending',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    public function operation_history($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Request history', 'description'=>'Your request history approved and denied','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/operation_history',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }


    public function analytics($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Projects Analytics', 'description'=>'cost analysis on your project','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Team/team_authority',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

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

        return array($tab1,$tab2,$tab3,$tab4,$tab5,$tab6);
    }

    function make_project_apps($access, $project_id)
    {
    }
}
