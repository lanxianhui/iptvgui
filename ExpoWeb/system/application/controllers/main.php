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
	
	function service($rid){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"servicelist");
	}
	// 项目概况子页面
	function scatinfo($rid,$catid = 12){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"scatinfo");
	}
	// 合作伙伴
	function partner(){
		$data = array();
		$this->showView($data,"index");
	}
	
	function newslist($catid,$offset){
		$data = array();
		$data["newscat"] = $this->getNewsCat();
		$this->executeFrame($data,1);
		$this->showView($data,"newslist.php");
	}
	// -------------------------------------------数据库需要的方法集合--------------------------------------
	function getNewsByCat($catid,$offset){
		
	}
	
	function getServiceCatByID($catid){
		$this->db->order_by("catorder");
		$result = $this->db->get_where("servicecat",array("id"=>$catid));
		return $result->result_array();
	}
	
	function getServiceCat($rid){
		$this->db->order_by("catorder");
		$result = $this->db->get_where("servicecat",array("rootid"=>$rid));
		return $result->result_array();
	}
	
	function getNewsCat(){
		$this->db->order_by("catorder");
		$result = $this->db->get("newscat");
		return $result->result_array();
	}
	
	function getServiceRootByID($rid){
		$result = $this->db->get_where("serviceroot",array("id"=>$rid));
		return $result->result_array();
	}
	// -------------------------------------------整个页面需要用到的方法-------------------------------------
	function executeFrame(&$data,$rid){
		$data["nav"] = $this->getRootNav();
		$data["root"] = $this->getServiceRootByID($rid);
	}
	// 头部导航栏
	function getRootNav(){
		$this->db->order_by("rootorder");
		$result = $this->db->get("serviceroot");
		return $result->result_array();
	}
	// -------------------------------------------视图展示方法-----------------------------------------------
	// 视图展示
	function showView($data,$viewName = null){
		$this->load->view ( "header", $data );
		$this->load->view("ad",$data);
		if (! $viewName) {
			$this->load->view ( $this->methodName, $data );
		} else {
			$this->load->view ( $viewName, $data );
		}
		$this->load->view ( "footer", $data );
	}
	
	function showIndexView($data, $viewName = null) {
		$this->load->view ( "header", $data );
		if (! $viewName) {
			$this->load->view ( $this->methodName, $data );
		} else {
			$this->load->view ( $viewName, $data );
		}
		$this->load->view ( "footer", $data );
	}
}
?>