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
			$nice_rows[$row->object] = $row->read == '1'? true: false;
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

	public function set_role_data()
	{
		$data = array(
			'name' => $this->input->post('name'),
		);
		$this->db->insert('role',$data);
	}

	public function get_role_data($role_id)
	{
		$this->db->where('active', '1');
		$query = $this->db->get_where('role', array('id' => $role_id));
		return $query->result();
	}

	public function get_all_roles()
	{
		$this->db->where('active', '1');
		$query = $this->db->get('role');
		return $query->result();
	}

	public function editrole($id)
	{

		$this->db->where('id', $id);
		$this->db->where('active', '1');
		$query = $this->db->get('role');
		return $query->result();
	}

	public function get_roles_by_user($user_id)
	{
		$query = $this->db->get_where('role', array('user_id' => $user_id));
		return $query->results();
	}

	public function get_data_by_id($id)
	{

		$this->db->where('id', $id);
		$this->db->where('active', '1');
		$query = $this->db->get('role');
		return $query->result();
	}

	public function get_user($id)
	{
		$this->db->where('role_id', $id);
		$query = $this->db->get('user');
		return $query->result();
	}

	public function delete($id){
		$data = array(
			'active' => '0'
		);
		$this->db->where('id', $id);
		$this->db->update('role', $data);
	}

	public function update_role($id){
		$data = array(
		'id' => $this->input->post('id'),
		'name'=> $this->input->post('name'),
	);
	$this->db->where('id', $id);
	$this->db->update('role', $data);

	}
}
