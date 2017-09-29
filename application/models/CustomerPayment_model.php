<? php
class Allowance_model extends CI_Model{
	public function getAllCustomerPayments(){
		$query= this->db->get('customerpayment');
		return $query->result();
	}
	public function getCustomerPaymentById(){
		$query = $this->db->get_where('customerpayment', array('id' => $id));
		return $query->result();
	}
	public function addCustomerPayment(){
		$data =array(
			'customerId' => 'customerId',
			'projectId' => 'projectId',
			'description' =>'description'
			'ammount'=>'ammount'
			
		);
		$this->db->insert('customerpayment',$data);
	}
	public function deleteCustomerPayment(){
		$this->db->where('id', $id);
		$this->db->delete('customerpayment');
	}

} 
?>