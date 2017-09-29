<? php
class Allowance_model extends CI_Model{
	public function getAllAllowances(){
		$query= this->db->get('allowance');
		return $query->result();
	}
	public function getAllowanceById(){
		$query = $this->db->get_where('allowance', array('id' => $id));
		return $query->result();
	}
	public function addAllowance(){
		$data =array(
			'customerId' => 'customerId',
			'projectId' => 'projectId',
			'description' =>'description'
			'ammount'=>'ammount',
			'active'=>'active'
		);
		$this->db->insert('allowance',$data);
	}
	public function deleteAllowance(){
		$query= $this->db->query("UPDATE allowance
		SET active = 'false'
		WHERE id = $id AND customerId=customerId AND projectid=projectid");
		return $query->result();
	}

}

?>