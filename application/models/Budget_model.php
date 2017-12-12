<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_model extends CI_Model
{

	public function __construct()
	{

	}

	public function add_new_stage($project_id, $name)
	{
		$query = 'INSERT INTO budget_stage(project_id,name) VALUES ('.$project_id.',"'.$name.'")';
		$query = $this->db->query($query);
		return $this->db->affected_rows();
	}

	public function get_stages_by_project($project_id)
	{
		$query = $this->db->get_where('budget_stage', array("project_id"=>$project_id));
		return $query->result();
	}

	public function get_entries_material_by_stage($stage_id)
	{
		$query = 'SELECT
			i.name as item_name,
			i.id as item_id,
			i.unit as item_unit,
			be.id as budget_entry_id,
			be.no_of_units as ammount
			FROM
			budget_entry_material as be JOIN
			inventory_item as i
			on be.inventory_item_id = i.id

			WHERE be.budget_stage_id = '.$stage_id;
		$query = $this->db->query($query);
		return $query->result();
	}

	public function get_entries_payments_by_stage($stage_id)
	{
		$query = 'SELECT
			be.name as name,
			be.id as budget_entry_id,
			be.ammount as ammount
			FROM
			budget_entry_other as be

			WHERE be.budget_stage_id = '.$stage_id;
		$query = $this->db->query($query);
		return $query->result();
	}

	public function get_items_not_in_stage($stage_id)
	{
		$query = 'SELECT b.inventory_item_id as item_id FROM budget_stage as bs JOIN budget_entry_material as b on bs.id = b.budget_stage_id WHERE bs.id = '.$stage_id;
		$query = $this->db->query($query);
		$items = $query->result();
		if($query->num_rows())
		{
			$query = 'SELECT * FROM inventory_item WHERE NOT (';
			for($i=0; $i<sizeof($items)-1; $i++)
			{
				$query = $query.' id = '.$items[$i]->item_id.' OR ';
			}
			$query = $query.' id = '.$items[$i]->item_id.')';
			$query = $this->db->query($query);
			return $query->result();
		}
		else
		{
			$query = 'SELECT * FROM inventory_item';
			$query = $this->db->query($query);
			return $query->result();
		}
	}

	public function get_price_list()
	{
		$query = 'SELECT * FROM inventory_item_price_list';
		$query = $this->db->query($query);
		return $query->result();
	}

	public function create_new_entry($stage_id, $ammount, $type, $name, $price_list_id=NULL)
	{
		switch($type)
		{
			case 'material':
			$query = 'INSERT INTO budget_entry_material(budget_stage_id,inventory_item_id,no_of_units,inventory_item_price_list_id) VALUES ('.$stage_id.', '.$name.' ,'.$ammount.','.$price_list_id.')';
			break;
			case 'payment':
			$query = 'INSERT INTO budget_entry_other(budget_stage_id,ammount,name) VALUES ('.$stage_id.','.$ammount.', "'.$name.'")';
			break;
		}
		echo $query;
		$query = $this->db->query($query);
		return $this->db->affected_rows();
	}

	public function get_project_budget_details($project_id)
	{
		//get total budgeted ammont
		$budgeted = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id JOIN budget_stage as bs on bs.id = be.budget_stage_id WHERE bs.project_id = '.$project_id;
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$budgeted += $entry->no_of_units;
		}
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id JOIN budget_stage as bs on bs.id = be.budget_stage_id WHERE bs.project_id = '.$project_id;
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$budgeted += $entry->ammount;
		}
		//get pending transactions
		$pending = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id JOIN budget_stage as bs on bs.id = be.budget_stage_id WHERE bs.project_id = '.$project_id.' AND (t.state = "to_be_transfered" OR t.state = "to_be_recived" OR t.state = "to_be_paid")';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$pending += $entry->no_of_units;
		}
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id JOIN budget_stage as bs on bs.id = be.budget_stage_id WHERE bs.project_id = '.$project_id.' AND t.state = "to_be_paid"';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$pending += $entry->ammount;
		}
		//get spent
		$spent = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id JOIN budget_stage as bs on bs.id = be.budget_stage_id WHERE bs.project_id = '.$project_id.' AND (t.state = "paid" OR t.state = "transfered")';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$spent += $entry->no_of_units;
		}
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id JOIN budget_stage as bs on bs.id = be.budget_stage_id WHERE bs.project_id = '.$project_id.' AND t.state = "paid"';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$spent += $entry->ammount;
		}

		return array('spent'=>$spent, 'pending'=>$pending, 'budgeted'=>$budgeted, 'remaining'=>($budgeted-$pending-$spent));
	}

	public function get_stage_budget_details($stage_id)
	{
		//get budgeted ammount
		$stage_budgted_ammount = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id WHERE be.budget_stage_id = '.$stage_id;
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$stage_budgted_ammount += $entry->no_of_units;
		}
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id WHERE be.budget_stage_id = '.$stage_id;
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$stage_budgted_ammount += $entry->ammount;
		}

		//get pending transactions
		$stage_pending_transactions = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id WHERE be.budget_stage_id = '.$stage_id.' AND (t.state = "to_be_transfered" OR t.state = "to_be_recived" OR t.state = "to_be_paid")';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$stage_pending_transactions += $entry->no_of_units;
		}
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id WHERE be.budget_stage_id = '.$stage_id.' AND t.state = "to_be_paid"';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$stage_pending_transactions += $entry->ammount;
		}
		//get spent
		$stage_spent = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id WHERE be.budget_stage_id = '.$stage_id.' AND (t.state = "paid" OR t.state = "transfered")';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$stage_spent += $entry->no_of_units;
		}
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id WHERE be.budget_stage_id = '.$stage_id.' AND t.state = "paid"';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$stage_spent += $entry->ammount;
		}

		$query = $this->db->get_where('budget_stage', array('id'=>$stage_id));
		$name = $query->row()->name;

		return array('name'=>$name, 'spent'=>$stage_spent, 'pending'=>$stage_pending_transactions, 'budgeted'=>$stage_budgted_ammount,'remaining'=>($stage_budgted_ammount-$stage_pending_transactions-$stage_spent));
	}

	public function get_entry_material_budget_details($id)
	{
		//get total budgeted ammont
		$budgeted = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id WHERE be.id = '.$id;
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$budgeted += $entry->no_of_units;
		}
		//get pending transactions
		$pending = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id WHERE be.id = '.$id.' AND (t.state = "to_be_transfered" OR t.state = "to_be_recived" OR t.state = "to_be_paid")';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$pending += $entry->no_of_units;
		}
		//get spent
		$spent = 0.00;
		$query = 'SELECT be.no_of_units FROM budget_entry_material as be JOIN material_transaction as t on t.budget_entry_material_id = be.id WHERE be.id = '.$id.' AND (t.state = "paid" OR t.state = "transfered")';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$spent += $entry->no_of_units;
		}

		$query = 'SELECT i.name, i.id FROM budget_entry_material as be JOIN inventory_item as i on i.id=be.inventory_item_id WHERE be.id = '.$id;
		$query = $this->db->query($query);
		$row = $query->row();
		$name = $row->name;
		//$item_id = $row->id;

		return array('id'=>$id, 'name'=>$name, 'spent'=>$spent, 'pending'=>$pending, 'budgeted'=>$budgeted, 'remaining'=>($budgeted-$pending-$spent));
	}

	public function get_entry_other_budget_details($id)
	{
		//get total budgeted ammont
		$budgeted = 0.00;
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id WHERE be.id = '.$id;
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$budgeted += $entry->ammount;
		}
		//get pending transactions
		$pending = 0.00;
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id WHERE be.id = '.$id.' AND t.state = "to_be_paid"';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$pending += $entry->ammount;
		}
		//get spent
		$spent = 0.00;
		$query = 'SELECT be.ammount FROM budget_entry_other as be JOIN other_payment_transaction as t on t.budget_entry_other_id = be.id WHERE be.id = '.$id.' AND t.state = "paid"';
		$query = $this->db->query($query);
		foreach ($query->result() as $entry)
		{
			$spent += $entry->ammount;
		}

		$query = $this->db->get_where('budget_entry_other', array('id'=>$id));
		$row = $query->row();
		//$entry_id = $row->id;
		$name = $row->name;

		return array('id'=>$id ,'name'=>$name, 'spent'=>$spent, 'pending'=>$pending, 'budgeted'=>$budgeted, 'remaining'=>($budgeted-$pending-$spent));
	}

	public function process_cvs($project_id, $file_target)
	{

		$query = $this->db->get_where('budget_stage', array('project_id'=>$project_id));
		if($query->num_rows())
			return 0;

		$file = fopen($file_target,"r");

		$this->db->trans_begin();

		while(! feof($file))
		{
			$row = fgetcsv($file);
			switch($row[0])
			{
				case '#stage':
					$query = 'INSERT INTO budget_stage(project_id,name) VALUES ('.$project_id.', "'.$row[1].'")';
					@$this->db->query($query);
					$query = 'SELECT LAST_INSERT_ID() as result';
					$query = @$this->db->query($query);
					$stage_id = $query->row()->result;
					break;
				case '#material':
					$query = 'INSERT INTO budget_entry_material(budget_stage_id, inventory_item_id, inventory_item_price_list_id, no_of_units) VALUES ('.$stage_id.', '.$row[1].', '.$row[2].', '.$row[3].')';
					@$this->db->query($query);
					break;
				case '#payment':
					$query = 'INSERT INTO budget_entry_other(budget_stage_id, name, ammount) VALUES ('.$stage_id.', "'.$row[1].'" , '.$row[2].' )';
					@$this->db->query($query);
					break;
			}
		}

		fclose($file);

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


}
