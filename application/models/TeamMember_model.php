<? php
class TeamMember extends CI_Model(){
	public function getAllTeamMembers(){
		$query= this->db->get('teammember');
		return $query->result();
	}
	public function getTeamMemberById(){
		$query = $this->db->get_where('teammember', array('id' => $id));
		return $query->result();
	}
	public function addTeamMember(){
		$data =array(
			'employeeId' => 'employeeId',
			'projectId' =>'projectId',
			'allowanceAppPriority'=>'allowanceAppPriority',
			'allowanceAppMember'=>'allowanceAppMember',
			'paymentAppPriority' => 'paymentAppPriority',
			'paymentAppMember' => 'paymentAppMember'
				);
		$this->db->insert('teammember',$data);
	}
	public function deleteTeamMember(){
		$this->db->where('id', $id);
		$this->db->delete('teammember');
	}
	public function updateTeamMember(){
		$data =array(
			'employeeId' => 'employeeId',
			'projectId' =>'projectId',
			'allowanceAppPriority'=>'allowanceAppPriority',
			'allowanceAppMember'=>'allowanceAppMember',
			'paymentAppPriority' => 'paymentAppPriority',
			'paymentAppMember' => 'paymentAppMember'	);
		$this->db->where('id', $id);
		$this->db->update('teammember', $data);
	}

}
?>