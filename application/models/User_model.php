<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{

	}

	public function get_user_data($user_id)
	{
		$query = $this->db->get_where('user', array('id' => $user_id));
		return $query->row_array();
	}

	public function get_all_users()
	{
		$query = $this->db->get('user');
		return $query->results();
	}

	public function get_users_by_project($project_id)
	{
		$query = $this->db->get_where('user', array('project_id' => $project_id));
		return $query->results();
	}

}
