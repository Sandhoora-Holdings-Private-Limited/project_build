<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function __construct()
	{

	}
	public function set_customer_data(){
		$data = array(
			'name' => 'name',
			'address'=> 'address',
			'email' => 'email',
			'phone_number' => 'phone_number'
		);
		$this->db->insert('customer',$data);
	}
}
