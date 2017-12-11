<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{

	public function __construct()
	{

	}

	public function set_customer_data()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'address'=> $this->input->post('address'),
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number')
		);
		$this->db->insert('customer',$data);

	}

	public function get_customer_data()
	{
		$this->db->where('active', '1');
		$query = $this->db->get('customer');
		return $query->result();
	}

	public function get_data_by_id($id)
	{

		$this->db->where('id', $id);
		$this->db->where('active', '1');
		$query = $this->db->get('customer');
		return $query->result();
	}

	public function get_project($id)
	{
		$this->db->where('customer_id', $id);
		$query = $this->db->get('customer_has_project');
		return $query->result();
	}
	
	public function update($id){
		$data = array(
        'name' => $this->input->post('name'),
		'address'=> $this->input->post('address'),
		'email' => $this->input->post('email'),
		'phone_number' => $this->input->post('phone_number')
);
	$this->db->where('id', $id);
	$this->db->update('customer', $data);

	}
	public function delete($id){
		$data = array(
			'active' => '0'
		);
		$this->db->where('id', $id);
		$this->db->update('customer', $data);
	}
	public function makepayment(){
		$data = array(
			'customer_id' => $this->input->post('customer_id'),
			'project_id' => $this->input->post('project_id'),
			'ammount' => $this->input->post('ammount'),
			'memo'=>$this->input->post('memo')
		);
		$this->db->insert('customer_payment',$data);
	}
	public function makepaymentbyid($id){
		$data = array(
			'customer_id' => $id,
			'project_id' => $this->input->post('project_id'),
			'ammount' => $this->input->post('ammount'),
			'memo'=>$this->input->post('memo')
		);
		$this->db->insert('customer_payment',$data);
	}
	public function getpaymentdetails($id){
		$this->db->where('customer_id', $id);
		$query = $this->db->get('customer_payment');
		return $query->result();
	}
	
}
