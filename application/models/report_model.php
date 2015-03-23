<?php
// This is report model
// This will return records as per selected company/client and dates
class report_model extends CI_Model {

  
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /*
	*  search_records function will required two parameters
	*  client name and date type
	*
	*/
    function search_records($client, $dateType)
    {
		
		//$where is used to prepare our conditions
		$where = "p.client_id ='".$client."'";
		//Prepare where condition for dates
		switch($dateType){
			// prepare condition for Last month to date filter
			case 'last_m_to_d':
				// Fetch records from last month to current date
				$fromDate = date('Y-m-d', strtotime(date('Y-m')." -1 month"));
				$where .= ' And i.invoice_date >="'.$fromDate.'" and i.invoice_date <="'.date('Y-m-d').'"';
				break;
			
			// prepare condition for this month filter
			case 'this_m':
			// Fetch records from Current month only
				$where .= ' and i.invoice_date >="'.date('Y-m-1').'" and i.invoice_date <="'.date('Y-m-31').'"';
				break;
				
			// prepare condition for This Year filter
			case 'this_y':
				//Fetch records for current year
				$where .= ' and i.invoice_date >="'.date('Y-1-1').'" and i.invoice_date <="'.date('Y-12-31').'"';
				break;
				
			// prepare condition for Last Year filter
			case 'last_y':
				//Fetch records for last year.
				$year = date("Y",strtotime("-1 year"));
				$where .= ' and i.invoice_date >="'.$year.'-1-1" and i.invoice_date <="'.$year.'-12-31"';
				break;
			
		}
		
		//Select all required field from invoice, product and invoicelineitem table
		$this->db->select('i.invoice_num, i.invoice_date, p.product_description, ili.qty, ili.price');
		//define table name
		$this->db->from('invoices as i');
		
		//define condition if not empty
			$this->db->where($where);
		//Define join for invoicelineiatems with invoice table
		$this->db->join('invoicelineitems as ili','ili.invoice_num = i.invoice_num');
		//Define join for products with invoicelineitems table.
		$this->db->join('products as p','p.product_id = ili.product_id');
		// specify order by fields.
		$this->db->order_by('i.invoice_date Desc');
		$this->db->order_by('i.invoice_num ASC');
		
		// Fetch records 
        $query = $this->db->get();
		
		//return result
		return  $query->result_array();
    }
}