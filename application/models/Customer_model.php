<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function __construct()
	{

	}
	public function set_customer_data(){
		$data = array(
			'name' => $this->input->post('name'),
			'address'=> $this->input->post('address'),
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number')
		);
		$this->db->insert('customer',$data);
	}
}
