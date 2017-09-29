<? php
class Allowance_model extends CI_Model{
	public function getAllAllowancePayments(){
		$query= this->db->get('allowancepayment');
		return $query->result();
	}
	public function getAllowancePaymentById(){
		$query = $this->db->get_where('allowancepayment', array('id' => $id));
		return $query->result();
	}
	public function addAllowancePayment(){
		$data =array(
			'customerId' => 'customerId',
			'projectId' => 'projectId',
			'description' =>'description'
			'ammount'=>'ammount'
		);
		$this->db->insert('allowancepayment',$data);
	}
	public function deleteAllowancePayment(){
		$this->db->where('id', $id);
		$this->db->delete('allowancepayment');
	}
}
?>