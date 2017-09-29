<? php
class Role_model extends CI_Model(){
	public function getAllStages(){
		$query= this->db->get('stage');
		return $query->result();
	}
	public function getStageById(){
		$query = $this->db->get_where('stage', array('id' => $id));
		return $query->result();
	}
	public function addRole(){
		$data =array(
			'projectId' => 'projectId',
			'name' =>'name',
			'priority'=>'priority',
			'description'=>'description',
			'startDate' => 'startDate',
			'endDate' => 'endDate',
			'ammount' =>'ammount'	);
		$this->db->insert('stage',$data);
	}
	public function deleteStage(){
		$this->db->where('id', $id);
		$this->db->delete('stage');
	}
	public function updateStage(){
		$data =array(
			'projectId' => 'projectId',
			'name' =>'name',
			'priority'=>'priority',
			'description'=>'description',
			'startDate' => 'startDate',
			'endDate' => 'endDate',
			'ammount' =>'ammount'	);
		$this->db->where('id', $id);
		$this->db->update('stage', $data);
	}
}
?>