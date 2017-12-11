<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model 
{

	public function __construct()
	{

	}
	public function set_vendor_data()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'address'=> $this->input->post('address'),
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number')
		);
		$this->db->insert('vendor',$data);
	}
	public function get_vendor_data()
	{
		$query = $this->db->get('vendor');
		return $query->result();
	}
	public function get_data_by_id($id)
	{
		
		$this->db->where('id', $id);
		$query = $this->db->get('vendor');
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
	$this->db->update('vendor', $data);

}
    public function delete($id){
		$data = array(
			'active' => '0'
		);
		$this->db->where('id', $id);
		$this->db->update('vendor', $data);
	}
}