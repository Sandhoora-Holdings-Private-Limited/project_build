<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_model extends CI_Model
{

	public function __construct()
	{

	}

	public function get_stages_by_project($project_id)
	{
		$query = $this->db->get_where('budget_stage', array("project_id"=>$project_id));
		return $query->result();
	}
}
