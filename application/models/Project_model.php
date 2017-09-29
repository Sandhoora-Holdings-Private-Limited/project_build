<? php
class Project_model extends CI_Model{
	public function getAllProjects(){
		$query= this->db->get('project');
		return $query->result();
	}
	public function getProjectById(){
		$query = $this->db->get_where('project', array('id' => $id));
		return $query->result();
	}
	public function addProject(){
		$data =array(
			'customerId' => 'customerId',
			'name' => 'name',
			'address' => 'address',
			'startDate' => 'startDate',
			'endDate' =>'endDate'
		);
		$this->db->insert('project',$data);
	}
	public function deleteProject(){
		$this->db->where('id', $id);
		$this->db->delete('project');
	}
	public function updateProject(){
		$data =array(
			'customerId' => 'customerId',
			'name' => 'name',
			'address' => 'address',
			'startDate' => 'startDate',
			'endDate' =>'endDate'
		);
		$this->db->where('id', $id);
		$this->db->update('project', $data);
	}
}
?>