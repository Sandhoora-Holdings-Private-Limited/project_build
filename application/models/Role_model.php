<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

	public function __construct()
	{

	}

	public function get_role_acess_data($role_id)
	{
		$query = $this->db->get_where('access', array('role_id' => $role_id));
		foreach($query->result() as $row)
		{
			$nice_rows[$row->object] = array('create' => ($row->create == '1'? true: false) ,'read' => ($row->read == '1'? true: false),'update' => ($row->update == '1'? true: false) ,'delete' => ($row->delete == '1'? true: false));
			$can_read = $row->read;
			switch($row->object)
			{
				case 'project':
					if($can_read) $apps['project'] = array('icon'=>'fa fa-fw fa-futbol-o', 'name'=>'Projects', 'controller_name'=>'Project');
					break;
				case 'inventory':
					if($can_read) $apps['inventory'] = array('icon'=>'fa fa-fw fa-cubes','name'=>'Inventory', 'controller_name'=>'Inventory');
					break;
				case 'user':
					if($can_read) $apps['user'] = array('icon'=>'fa fa-fw fa-users','name'=>'Users', 'controller_name'=>'User');
					break;
				case 'customer':
					if($can_read) $apps['customer'] = array('icon'=>'fa fa-fw fa-diamond','name'=>'Customers', 'controller_name'=>'Customer');
					break;
				case 'vendor':
					if($can_read) $apps['vendor'] = array('icon'=>'fa fa-fw fa-shopping-cart','name'=>'Vendors', 'controller_name'=>'Vendor');
					break;

			}
		}

		$ret = array('access'=>$nice_rows,'apps'=>$apps);

		return $ret;
	}

}
