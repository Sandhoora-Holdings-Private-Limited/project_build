<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Defualt_model discription
 */
class Default_model extends CI_Model {

	public function __construct()
	{

	}
	/**
	 * [getAllSiteData description]
	 * @return [type] [description]
	 */
	public function getAllSiteData()
	{
		// $this->db->select('name, data');
		// $query = $this->db->get_where('Site', array('name' => 'site'));
		// $site = json_decode($query->row()->data);
		// return $site;
	}

}
