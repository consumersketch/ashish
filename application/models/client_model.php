<?php
//This is client model
// This model is used get records from client table
class client_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /*
	*	 This function will return all records for company/client from clients table
	*
	*/
    function get_all_client()
    {
		// Fetch records from client table.
        $query = $this->db->get('clients');
		$results = $query->result_array();
		
		$rec = array();
		if(empty($results)){
			$rec[0] = 'No company available';
		}else{
			$rec[0]= 'Select Client/Company';
		}
		
		//convert all records into key=>value pair.
		foreach($results as $row){
			$rec[$row['client_id']] = $row['client_name'];
		}
		
		//return records
		return $rec;
    }
}