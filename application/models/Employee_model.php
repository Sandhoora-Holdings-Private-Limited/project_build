<? php
class Employee_model extends CI_Model{
	public function getAllEmployees(){
		$query= this->db->get('employee');
		return $query->result();
	}
	public function getEmployeesById(){
		$query = $this->db->get_where('employee', array('id' => $id));
		return $query->result();
	}
	public function addEmployee(){
		$data =array(
			'roleId' => 'roleId',
			'name' => 'name',
			'address' => 'address',
			'salary' => 'salary',
			'designation' =>'designation'
		);
		$this->db->insert('employee',$data);

	}
	public function deleteEmployee(){
		$this->db->where('id', $id);
		$this->db->delete('employee');
	}
	public function updateEmployee(){
		$data =array(
			'roleId' => 'roleId',
			'name' => 'name',
			'address' => 'address',
			'salary' => 'salary',
			'designation' =>'designation'
		);
		$this->db->where('id', $id);
		$this->db->update('employee', $data);

	}
}

?>