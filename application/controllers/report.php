<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	/**
	 * Index Page for report controller.
	 *
	 */
	public function index()
	{
		//Load Client Model
		$this->load->model('client_model','clientModel');
		
		$data = array();
		//Get all available client
		$data['client'] = $this->clientModel->get_all_client();
		//Define date types.
		$data['dates'] = array(
						'0'=>"Select Date",
						'last_m_to_d'=>"Last Month to Date",
						'this_m'=>"This Month",
						'this_y'=>"This Year",
						'last_y'=>"Last Year",
						);
						
		//Load report view
		$this->load->view('report',$data);
	}
	/**
	 * Index Page for this controller.
	 *
	 */
	public function generate_report(){
		$post = $this->input->post();
		//Load Invoice Model
		$this->load->model('report_model','reportModel');
		
		
		//Fetch records 
		$data = array();
		$data['result'] = $this->reportModel->search_records($post['client'],$post['dates']);
		
		//generate reports
		$this->load->view('detail_report',$data);
		
	}
	
	public function get_client_products(){
		//Fetch post variable
		$post = $this->input->post();
		//Load Invoice Model
		$this->load->model('product_model','productModel');
		
		//Fetch records 
		$data = array();
		$result = $this->productModel->get_all_client_products($post['client']);
		//Print jason encoded response
		echo json_encode($result);exit;
		
	}
	
}
