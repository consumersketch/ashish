<?php
//This is product model
// This model is used get records from product table
class product_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /*
	*	 This function will search products from client
	*
	*/
    function get_all_client_products($client)
    {
		// Fetch records from client table.
		$this->db->where('client_id',$client);
        $query = $this->db->get('products');
		
		$results = $query->result_array();
		
		$rec = array();
		if(empty($results)){
			$rec[0] = 'No products found';
		}else{
			$rec[0]= 'Select products';
		}
		
		//convert all records into key=>value pair.
		foreach($results as $row){
			$rec[]=array("key"=>$row['product_id'],"value"=>$row['product_description']);
		}
		
		//return records
		return $rec;
    }
}