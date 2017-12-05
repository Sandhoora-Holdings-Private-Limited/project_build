<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_material_model extends CI_Model {

	public function __construct()
	{

	}

	public function get_material_transaction_data_by_state($project_id,$state)
	{
		$query = 'SELECT
				t.id as transaction_id,
				t.time as time,
				t.no_of_units as no_of_units,
				b.id as budget_entry_id,
				b.no_of_units as budgeted_no_of_units,
				b.over_budget_limit as over_budget_limit,
				bs.name as stage_name,
				i.name as item_name,
				i.unit as item_unit,
				p.price as price

				from
				material_transaction as t
				JOIN budget_entry_material as b
				on t.budget_entry_material_id = b.id

				JOIN budget_stage as bs
				on bs.id = b.budget_stage_id

				JOIN inventory_item as i
				on b.inventory_item_id = i.id

				JOIN inventory_item_price as p
				on (b.inventory_item_price_list_id = p.inventory_item_price_list_id AND b.inventory_item_id = p.inventory_item_id)
				WHERE bs.project_id = "'.$project_id.'" AND t.state = "'.$state.'" ';

		$query = $this->db->query($query);
		return $query->result();
	}

	public function get_other_transaction_data_by_state($project_id,$state)
	{
		$query = 'SELECT
				t.id as transaction_id,
				t.time as time,
				t.ammount as ammount,
				b.id as budget_entry_id,
				b.ammount as budgeted_ammount,
				b.over_budget_limit as over_budget_limit,
				bs.name as stage_name

				from
				other_payment_transaction as t
				JOIN budget_entry_other as b
				on t.budget_entry_other_id = b.id

				JOIN budget_stage as bs
				on bs.id = b.budget_stage_id

				WHERE bs.project_id = "'.$project_id.'" AND t.state = "'.$state.'" ';

		$query = $this->db->query($query);
		return $query->result();
	}

	public function split_transaction($transaction_id, $user_id, $transfered_ammount)
	{

	}

	public function approve_transaction($transaction_id, $user_id, $approval, $transaction_type)
	{
		switch($transaction_type)
		{
			case 'material':
			{
				//$query = 'CALL approve_material_transaction("'.$user_id.'", '.$transaction_id.', '.$approval.')';
				$query = 'CALL approve_material_transaction("'.$user_id.'", '.$transaction_id.')';
				break;
			}
			case 'other_payment':
			{
				$query = 'CALL approve_other_payment_transaction("'.$user_id.'", '.$transaction_id.', '.$approval.')';
				break;
			}
		}

		$query = 'SELECT 1 as result';
		$query = $this->db->query($query);

		//return 1 for error
		if(!$this->db->error()['code'])
			return 1;
		if($query->row()->result == '1')
			return 1;

		return 0;
	}

	public function approve_and_transfer_material_transaction($transaction_id, $user_id)
	{
		//query
	}
}
