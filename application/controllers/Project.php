<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
        $this->load->model('Transaction_material_model');
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

    function operation_inbox($project_id)
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
                            $data['message'] = 'Failed to approve transaction '.$_POST['transaction_id'];
                        }
                        else
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully approved transaction '.$_POST['transaction_id'];
                        }
                        break;
                    }
                    case 'denie' :
                    {
                        $result = $this->Transaction_material_model->approve_transaction($_POST['transaction_id'],$_SESSION['user']['id'],0,$_POST['transaction_type']);
                        if(!$result)
                        {
                            $data['fail'] = true;
                            $data['message'] = 'Failed to approve transaction '.$_POST['transaction_id'];
                        }
                        else
                        {
                            $data['sucess'] = true;
                            $data['message'] = 'Sucessfully approved transaction '.$_POST['transaction_id'];
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
                }
            }
            $data['page'] = array('header'=>'Inbox', 'description'=>'Requests need your approval','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            $transactions['to_be_approved'] = $this->Transaction_material_model->get_material_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_purchased'] = $this->Transaction_material_model->get_material_transaction_data_by_state($project_id, 'to_be_purchased');
            $transactions['to_be_recived'] = $this->Transaction_material_model->get_material_transaction_data_by_state($project_id, 'to_be_recived');
            $transactions['to_be_transfered'] = $this->Transaction_material_model->get_material_transaction_data_by_state($project_id, 'to_be_transfered');

            $transactions['to_be_approved_other'] = $this->Transaction_material_model->get_other_transaction_data_by_state($project_id, 'to_be_approved');
            $transactions['to_be_paid_other'] = $this->Transaction_material_model->get_other_transaction_data_by_state($project_id, 'to_be_paid');

            $data['transactions'] = $transactions;
            $data['data_tables'] = array('table_approvals');
            $data['active_tab'] = 'tab_approvals';
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/operation_inbox',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    function operation_inbox_create_purchase_order($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Inbox', 'description'=>'Requests need your approval','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $data['project_id'] = $project_id;
            //$data['']
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/inbox/operation_inbox_material_PO',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    function operation_inbox_pay_purchase_order($project_id, $order_id)
    {

    }

    function operation_inbox_confirm_goods_recived($project_id)
    {

    }

    function operation_request($project_id)
    {
        if(isset($_SESSION['user']))
        {
            $data['page'] = array('header'=>'Create requests', 'description'=>'Create requests for material and other payments','app_name'=>'PROJECTS');
            $data['user'] = $_SESSION['user'];
            $data['apps'] = $_SESSION['apps'];
            $data['tabs'] = $this->make_tabs($_SESSION['access'],$project_id);
            $this->load->view('template/header',$data);
            $this->load->view('Project/Operation/operation_request',$data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('/Main/login', 'refresh');
        }
    }

    function operation_pending($project_id)
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

    function operation_history($project_id)
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
