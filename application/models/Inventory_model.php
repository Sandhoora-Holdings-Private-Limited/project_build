<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_new_price($item_id, $list_id, $ammount)
    {
    	$query = 'SELECT * FROM inventory_item_price WHERE inventory_item_price_list_id = '.$list_id.' AND inventory_item_id = '.$item_id;
    	$query = $this->db->query($query);
    	if($query->num_rows())
    	{
    		$query = 'UPDATE inventory_item_price SET price = '.$ammount.' WHERE inventory_item_price_list_id = '.$list_id.' AND inventory_item_id = '.$item_id;
    		$this->db->query($query);
    	}
    	else
    	{
    		$query = 'INSERT INTO inventory_item_price(inventory_item_price_list_id,inventory_item_id,price) VALUES ('.$list_id.','.$item_id.','.$ammount.')';
    		$this->db->query($query);
    	}
    	return $this->db->affected_rows();
    }
    public function get_all_prices($list_id)
    {
    	$query = 'SELECT i.name, i.unit, i.id as item_id, p.price FROM inventory_item_price as p JOIN inventory_item as i on i.id = p.inventory_item_id WHERE p.inventory_item_price_list_id = '.$list_id;
    	$query = $this->db->query($query);
    	return $query->result();
    }
	public function get_all_price_lists()
	{
    	$query = $this->db->get('inventory_item_price_list');
    	return $query->result();
    }
    public function add_new_price_list($name)
    {
    	$data = array('name'=>$name);
    	$this->db->insert('inventory_item_price_list',$data);
    	return $this->db->affected_rows();
    }

    public function add_new_item($name, $unit)
    {
    	$data = array('name'=>$name, 'unit'=>$unit);
    	$this->db->insert('inventory_item',$data);
    	return $this->db->affected_rows();
    }

    public function get_all_items()
    {
    	$query = $this->db->get('inventory_item');
    	return $query->result();
    }
    public function get_stock_log($project_id)
	{
		$query = 'SELECT i.name, i.id, i.unit, sl.user_id, sl.time, sl.to_project_id, sl.from_project_id, sl.no_of_units FROM inventory_item_stock_log as sl JOIN inventory_item as i on i.id = sl.inventory_item_id  WHERE from_project_id = '.$project_id.' OR to_project_id = '.$project_id;
		$query = $this->db->query($query);
		return $query->result();
	}

	public function get_stock($project_id)
	{
		$query = 'SELECT i.name, i.id, i.unit, s.no_of_units FROM inventory_item_stock as s JOIN inventory_item as i on i.id = s.inventory_item_id WHERE s.project_id = '.$project_id;
		$query = $this->db->query($query);
		return $query->result();
	}

	public function stock_in($project_id, $item_id, $no_of_units, $user_id)
	{
		$this->db->trans_begin();
		// get inventory stock details
		$query = 'SELECT no_of_units FROM inventory_item_stock WHERE inventory_item_id='.$item_id.' AND project_id='.$project_id;
		$query = $this->db->query($query);
		// update or insert stock entry
		if($query->num_rows() > 0)
		{
			$ammount = $query->row()->no_of_units + $no_of_units;
			$query = 'UPDATE `inventory_item_stock` SET `no_of_units` = '.$ammount.' WHERE `inventory_item_id` = '.$item_id.' AND `project_id` = '.$project_id ;
			$this->db->query($query);
		}
		else
		{
			$ammount = $no_of_units;
			$query = 'INSERT INTO `inventory_item_stock` (`inventory_item_id`, `project_id`, `no_of_units`) VALUES('.$item_id.', '.$project_id.', '.$ammount.')';
			$this->db->query($query);
		}
		//insert to inverntory log;
		$query = 'INSERT INTO `inventory_item_stock_log` (`inventory_item_id`, `to_project_id`, `no_of_units`, `user_id`) VALUES('.$budget_entry->item_id.', '.$project_id.', '.$no_of_units.', "'.$user_id.'" )';
		$this->db->query($query);
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

	public function stock_out($project_id, $item_id, $no_of_units, $user_id)
	{
		$this->db->trans_begin();
		//update stock entry
		$query_stock_from = 'SELECT no_of_units FROM inventory_item_stock WHERE inventory_item_id ='.$item_id.' AND project_id = '.$project_id;
		$query = $this->db->query($query_stock_from);
		$ammount = $query->row()->no_of_units - $no_of_units;
		$query_stock_from = 'UPDATE inventory_item_stock SET no_of_units = '.$ammount.' WHERE inventory_item_id = '.$item_id.' AND project_id = '.$project_id;
		$this->db->query($query_stock_from);
		//insert stock log entry
		$query = 'INSERT INTO inventory_item_stock_log(inventory_item_id,from_project_id,no_of_units,user_id) VALUES ('.$item_id.', '.$project_id.', '.$no_of_units.' , "'.$user_id.'")';
		$this->db->query($query);
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

	public function stock_transfer($item_id,$no_of_units,$from_project_id,$to_project_id,$user_id)
	{
		$this->db->trans_begin();
		//updating or inserting to to_project
		$query_stock_to = 'SELECT no_of_units FROM inventory_item_stock WHERE inventory_item_id ='.$item_id.' AND project_id = '.$to_project_id;
		$query = $this->db->query($query_stock_to);
		if($query->num_rows())
		{
			$ammount = $query->row()->no_of_units + $no_of_units;
			$query_stock_to = 'UPDATE inventory_item_stock SET no_of_units = '.$ammount.' WHERE inventory_item_id = '.$item_id.' AND project_id = '.$to_project_id;
			$this->db->query($query_stock_to);
		}
		else
		{
			$query_stock_to = 'INSERT INTO inventory_item_stock(inventory_item_id,project_id,no_of_units) VALUES ('.$item_id.', '.$to_project_id.', '.$no_of_units.')';
			$this->db->query($query_stock_to);
		}
		//updating from_project
		$query_stock_from = 'SELECT no_of_units FROM inventory_item_stock WHERE inventory_item_id ='.$item_id.' AND project_id = '.$from_project_id;
		$query = $this->db->query($query_stock_from);
		$ammount = $query->row()->no_of_units - $no_of_units;
		$query_stock_from = 'UPDATE inventory_item_stock SET no_of_units = '.$ammount.' WHERE inventory_item_id = '.$item_id.' AND project_id = '.$from_project_id;
		$this->db->query($query_stock_from);

		//inserting to log
		$query = 'INSERT INTO inventory_item_stock_log(inventory_item_id,to_project_id, from_project_id,no_of_units,user_id) VALUES ('.$item_id.', '.$to_project_id.', '.$from_project_id.', '.$no_of_units.' , "'.$user_id.'")';
		$this->db->query($query);

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


