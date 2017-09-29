<? php
class Customer_model extends CI_Model{
	public function getAllCustomers(){
		$query= this->db->get('customer');
		return $query->result();
	}
	public function getCustomerById(){
		$query = $this->db->get_where('customer', array('id' => $id));
		return $query->result();
	}
	public function addCustomer(){
		$data =array(
			'name' => 'name',
			'address' => 'address',
		);
		$this->db->insert('customer',$data);
	} 
	public function deleteCustomer(){
		$this->db->where('id', $id);
		$this->db->delete('customer');
	}
	public function updateCustomer(){
		$data =array(
			
			'name' => 'name',
			'address' => 'address',
		);
		$this->db->where('id', $id);
		$this->db->update('customer', $data);

	}
	public function getProject(){
		$query = $this->db->get_where('project', array('customerId' => $id));
		return $query->result();
	}
	public function getProjectTransactions(){
		$query = $this->db->get_where('customerpayment', array('customerId' => $id,'projectId'=> $id));
		return $query->result();

	} 
	public function getTransactions(){
		$query = $this->db->get_where('project', array('customerpayment' => $id));
		return $query->result();
	}
}
?>