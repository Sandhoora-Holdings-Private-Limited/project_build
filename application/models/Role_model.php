<? php
class Role_model extends CI_Model{
	public function getAllRoles(){
		$query= this->db->get('role');
		return $query->result();
	}
	public function getRoleById(){
		$query = $this->db->get_where('role', array('id' => $id));
		return $query->result();
	}
	public function addRole(){
		$data =array(
			'name' => 'name',
			'description' =>'description'
		);
		$this->db->insert('role',$data);
	}
	public function deleteRole(){
		$this->db->where('id', $id);
		$this->db->delete('role');
	}
	public function updateRole(){
		$data =array(
			'name' => 'name',
			'description' =>'description'
		);
		$this->db->where('id', $id);
		$this->db->update('role', $data);
	}
}
?>