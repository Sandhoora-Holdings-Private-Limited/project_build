<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_material_model extends CI_Model {

	public function __construct()
	{

	}

	public function get_to_be_approved_transaction_data($project_id)
	{
		$query = 'SELECT i.name as item, i.unit as unit, p.price as price, p.price as price, t.no_of_units as ammount, t.`time` as `time`, b.no_of_units as budgeted_ammount, , b.over_budget_limit as over_budget_ammount, bs.name as stage, b.parent_transaction_id as parent_transaction_id  from material_transaction as t JOIN budget_entry_material as b JOIN budget_stage as bs JOIN inventory_item as i JOIN inventory_item_price as p WHERE bs.project_id = "'.$project_id.'" AND t.state = "to_be_approved" ';
		$query = $this->db->query($query);
		return $query->result();
	}

	public function add_user($user_id, $project_id)
	{
		@$this->db->insert('team_member', $data);
	}

	public function new_project($name, $address, $start_date, $end_date)
	{
		$data = array('name'=>$name, 'address'=>$address, 'start_date'=>$start_date, 'end_date'=>$end_date);
		$query = $this->db->insert('project', $data);
		var_dump($query);
	}

	public function get_project_details($project_id)
	{
		$query = $this->db->get_where('project',array('id' => $project_id));
		return $query->row();
	}

}
