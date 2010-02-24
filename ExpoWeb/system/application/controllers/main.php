<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data = array();
		$data["nav"] = $this->getRootNav();
		$this->showView($data,"index");
	}
	
	function getRootNav(){
		$this->db->order_by("rootorder");
		$result = $this->db->get("serviceroot");
		return $result->result_array();
	}
	
	function showView($data, $viewName = null) {
		$this->load->view ( "header", $data );
		if (! $viewName) {
			$this->load->view ( $this->methodName, $data );
		} else {
			$this->load->view ( $viewName, $data );
		}
		//$object->load->view("ad",$data);
		$this->load->view ( "footer", $data );
		//$this->load->view("adbar",$data);
	}
}
?>