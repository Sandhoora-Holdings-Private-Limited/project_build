<? php 
class Vendor_model extends CI_Model{
	public function getAllVendors(){
		$query= this->db->get('vendor');
		return $query->result();
	}
	public function getVendorById(){
		$query = $this->db->get_where('vendor', array('id' => $id));
		return $query->result();
	}
	public function addVendor(){
		$data =array(
			'name' => 'name',
			'address' =>'address',
			'description'=>'description',
			'type'=>'type'
			);
		$this->db->insert('vendor',$data);
	}
	public function deleteVendorVendor(){
		$this->db->where('id', $id);
		$this->db->delete('vendor');
	}
	public function updateVendor(){
		$data =array(
			'name' => 'name',
			'address' =>'address',
			'description'=>'description',
			'type'=>'type'	);
		$this->db->where('id', $id);
		$this->db->update('teammember', $data);
	}
	public function getMicroTransactions(){
		$query = $this->db->get_where('microtransaction', array('vendorId' => $id));
		return $query->result();
	}
}
?>
