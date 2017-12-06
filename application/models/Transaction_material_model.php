<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_material_model extends CI_Model {

	public function __construct()
	{
	}

	public function pay_PO($transaction_ids, $po_id)
	{
		$this->db->trans_begin();
		$query ='UPDATE purchase_order SET state = "paid" WHERE id = '.$po_id;
		$this->db->query($query);
		foreach ($transaction_ids as $transaction) {
			$query = 'UPDATE material_transaction SET state="paid" WHERE id='.$transaction->transaction_id;
			$this->db->query($query);
		}
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return 0;
		}
		else
		{
		        $this->db->trans_commit();
		        return 1;
		}
	}
	public function get_PO_details($po_id)
	{
		$query = 'SELECT
					po.date as date,
					v.name as vendor_name,
					v.address as vendor_address,
					v.email as vendor_email,
					v.phone_number as vendor_phone_number

					FROM
					purchase_order as po
					JOIN
					vendor as v
					on po.vendor_id = v.id

					WHERE po.id = '.$po_id;
		$query = $this->db->query($query);
		return $query->row();
	}

	public function get_PO_items($po_id)
	{
		$query = 'SELECT material_transaction_id as transaction_id FROM material_transaction_has_purchase_order WHERE purchase_order_id = '.$po_id;
		$query = $this->db->query($query);
		return $query->result();
	}

	public function get_all_POs()
	{
		$query = 'SELECT p.id as po_id, p.date as time, v.name as vendor FROM `purchase_order` as p JOIN `vendor` as v ON p.vendor_id=v.id WHERE p.state = "to_be_paid"';
		$query = $this->db->query($query);
		return $query->result();
	}

	public function create_GR($transactions, $project_id, $user_id)
	{
		$this->db->trans_begin();
		foreach ($transactions as $transaction) {
			switch ($transaction['state']) {
				case 'to_be_transfered':
					$query = 'UPDATE material_transaction SET state="transfered" WHERE id='.$transaction['id'];
					$this->db->query($query);
					break;
				case 'to_be_recived':
					$query = 'UPDATE material_transaction SET state="to_be_paid" WHERE id='.$transaction['id'];
					$this->db->query($query);
					$query = 'SELECT no_of_units,inventory_item_id as item_id from budget_entry_material WHERE id='.$transaction['id'];
					$res = $this->db->query($query);
					$e = $res->row();
					$query = 'CALL inventory_IN('.$e->item_id.', '.$project_id.', '.$e->no_of_units.', "'.$user_id.'")';
					$this->db->query($query);
					break;
			}
		}
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return 0;
		}
		else
		{
		        $this->db->trans_commit();
		        return 1;
		}
	}

	public function create_PO($transactions, $vendor_id, $user_id, $date)
	{
		$this->db->trans_begin();
		$query ='INSERT INTO purchase_order(`vendor_id`,`user_id`,`date`) VALUES ('.$vendor_id.',"'.$user_id.'","'.$date.'")';
		echo $query;
		$this->db->query($query);
		$query = 'SELECT LAST_INSERT_ID() as result';
		$query = $this->db->query($query);
		$po_id = (int)$query->row()->result;
		foreach ($transactions as $transaction) {
			$query = 'UPDATE material_transaction SET state="to_be_recived" WHERE id='.$transaction;
			$this->db->query($query);
			$query = 'INSERT INTO material_transaction_has_purchase_order (material_transaction_id, purchase_order_id) VALUES ('.$transaction.', '.$po_id.')';
			$this->db->query($query);
		}


		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return 0;
		}
		else
		{
		        $this->db->trans_commit();
		        return $po_id;
		}
	}

	public function change_transaction_state($transaction_id, $state, $type)
	{
		switch($type)
		{
			case 'material':
			{
				$query = 'UPDATE material_transaction SET state="'.$state.'" WHERE id='.$transaction_id;
			}
			case 'other_payment':
			{
				$query = 'UPDATE other_payment_transaction SET state="'.$state.'" WHERE id='.$transaction_id;
			}
		}
		$this->db->query($query);
		return $this->db->affected_rows();
	}

	public function get_material_transaction_details($transaction_id)
	{
		$query = 'SELECT
				t.id as transaction_id,
				t.time as time,
				t.no_of_units as no_of_units,
				t.state as state,
				b.id as budget_entry_id,
				b.no_of_units as budgeted_no_of_units,
				b.over_budget_limit as over_budget_limit,
				bs.name as stage_name,
				i.name as item_name,
				i.unit as item_unit,
				i.id as item_id,
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
				WHERE t.id = '.$transaction_id ;

		$query = $this->db->query($query);
		return $query->row();
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
				i.id as item_id,
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

	public function get_material_transaction_data_with_po($project_id)
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
				i.id as item_id,
				p.price as price,
                po.id as po_id,
                v.name as vendor

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

                JOIN material_transaction_has_purchase_order as t_po
                on t_po.material_transaction_id = t.id

                JOIN purchase_order as po
                on t_po.purchase_order_id = po.id

                JOIN vendor as v
                on po.vendor_id = v.id


				WHERE bs.project_id = '.$project_id.' AND t.state = "to_be_recived"';

		$query = $this->db->query($query);
		return $query->result();
	}

	public function get_other_transaction_data_by_state($project_id,$state)
	{
		$query = 'SELECT
				t.id as transaction_id,
				b.name as name,
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
				$query = 'CALL approve_material_transaction("'.$user_id.'", '.$transaction_id.', '.$approval.')';
				//$query = 'CALL approve_material_transaction("'.$user_id.'", '.$transaction_id.')';
				break;
			}
			case 'other_payment':
			{
				$query = 'CALL approve_other_payment_transaction("'.$user_id.'", '.$transaction_id.', '.$approval.')';
				break;
			}
		}

		$query = $this->db->query($query);

		//return 1 for error
		if(!$this->db->error()['code'])
			mysqli_next_result( $this->db->conn_id );
			return 1;
		if($query->row()->result == '1')
			mysqli_next_result( $this->db->conn_id );
			return 1;


		mysqli_next_result( $this->db->conn_id );
		return 0;
	}

	public function approve_and_transfer_material_transaction($transaction_id, $user_id)
	{
	}
}
