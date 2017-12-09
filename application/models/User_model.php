<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{

	}

	public function set_user_data()
	{
		$data = array(

			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'role_id' => $this->input->post('role_id')
		);
		$this->db->insert('user',$data);
	}

	public function get_user_data($user_id)
	{
		$query = $this->db->get_where('user', array('id' => $user_id));
		return $query->row_array();
	}

	public function get_all_users()
	{
		$query = $this->db->get('user');
		return $query->result();
	}

	public function update($id){
		$data = array(
        'name' => $this->input->post('name'),
			);
	$this->db->where('id', $id);
	$this->db->update('user', $data);
}

	public function get_users_by_project($project_id)
	{
		$query = $this->db->get_where('user', array('project_id' => $project_id));
		return $query->results();
	}

	public function get_data_by_id($id)
     {

         $this->db->where('id', $id);
         $this->db->where('active', '1');
         $query = $this->db->get('user');
         return $query->result();


}
}
