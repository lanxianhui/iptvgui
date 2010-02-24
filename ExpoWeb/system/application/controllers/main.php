<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}
	
	function index($rid=7,$catid=15)
	{
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		$data["notice"] = $this->getNotice();
		$this->executeFrame($data,7);
		$this->showIndexView($data,"index");
	}
	
	function service($rid){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"servicelist");
	}

	// 站点内容
	function catinfo($rid=7,$catid=15){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		$data["partner"] = $this->getAllPartners();
		$data["servicelist"] = $this->getServiceByCat($catid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"catinfo");
	}

	// 合作伙伴页面，活动掠影
	function partner($rid,$catid = 0){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		$data["partner"] = $this->getAllPartners();
		$data["servicelist"] = $this->getServiceByCat($catid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"partner");
	}
	// 活动掠影详细页面
	function partnerinfo($rid,$catid,$serviceid){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		//$data["partner"] = $this->getAllPartners();
		//$data["servicelist"] = $this->getServiceByCat($catid);
		$data["partnerinfo"] = $this->getServiceByID($serviceid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"partnerinfo");
	}
	// 我看世博详细页
	function myexpoinfo($rid,$catid,$serviceid){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		//$data["partner"] = $this->getAllPartners();
		//$data["servicelist"] = $this->getServiceByCat($catid);
		$data["partnerinfo"] = $this->getServiceByID($serviceid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"myexpoinfo");
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
	//我看世博
	function myexpo($rid,$catid =2 ){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		$data["servicelist"] = $this->getServiceByCat($catid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"myexpo");
	}
	//沟通推荐
	function recommend($rid,$catid=5){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		$data["servicelist"] = $this->getServiceByCat($catid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"recommend");
	}
	//沟通推荐子页面
	function recommendinfo($rid,$catid,$serviceid){
		$data = array();
		$data["catmenu"] = $this->getServiceCat($rid);
		$data["selectcat"] = $catid;
		$data["content"] = $this->getServiceCatByID($catid);
		//$data["partner"] = $this->getAllPartners();
		//$data["servicelist"] = $this->getServiceByCat($catid);
		$data["partnerinfo"] = $this->getServiceByID($serviceid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"recommendinfo");
	}
	//智慧城市
	function knowledgecity($rid,$catid=4){
		$data = array();
		$data["catmenu"]=$this->getServiceCat($rid);
		$data["selectcat"]=$catid;
		$data["content"]=$this->getServiceCatByID($catid);
		$data["servicelist"]=$this->getServiceByCat($catid);
		$this->executeFrame($data,$rid);
		$this->showView($data,"knowledgecity");
	}
//信息咨询
//	function  news($rid,$catid =1){
//		$data = array();
//		$data["catmenu"] = $this->getNewsCat($rid);
//		$data["selectcat"] = $catid;
//		$data["partner"] =$this->getAllPartners();
//		$data["newslist"] = $this->getNewsByCat($catid);
//		$this->executeFrame($data,$rid);
//		$this->showView($data,"news");
//	}
	function newslist($catid,$offset){
		$data = array();
		$data["newscat"] = $this->getNewsCat();
		$data["content"]=$this->getNewsCatByID($catid);
		$data["newslist"]=$this->getNewsByCat($catid,1);
		$this->executeFrame($data,1);
		$this->showView($data,"newslist.php");
	}
	
	// -------------------------------------------数据库需要的方法集合--------------------------------------
	function getNewsByCat($catid,$offset){
	     $this->db->order_by("pubtime desc");
	     $result =  $this->db->get_where("news",array("catid"=>$catid));
	     return $result->result_array();
	}
     function getNewsCat(){
		$this->db->order_by("catorder");
		$result = $this->db->get("newscat");
		return $result->result_array();
	}
	 function getNewsByID($newsid){
		$result = $this->db->get_where("news",array("id"=>$newsid));
		return $result->result_array();
	}
      function getNewsCatByID($catid){
		$this->db->order_by("catorder");
		$result = $this->db->get_where("newscat",array("id"=>$catid));
		return $result->result_array();
	}
	function getAllPartners(){
		//$this->db->order_by("porder");
		$result = $this->db->get("partner");
		return $result->result_array();
	}
	
	function getServiceByID($serviceid){
		$result = $this->db->get_where("service",array("id"=>$serviceid));
		return $result->result_array();
	}
	
	function getServiceByCat($catid){
		$this->db->order_by("pubtime desc");
		$result = $this->db->get_where("service",array("catid"=>$catid));
		return $result->result_array();
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
	
	
	
	function getServiceRootByID($rid){
		$result = $this->db->get_where("serviceroot",array("id"=>$rid));
		return $result->result_array();
	}
	
	function getNotice(){
		$result = $this->db->get_where("servicecat",array("id"=>19));
		return $result->result_array();
	}
	// -------------------------------------------整个页面需要用到的方法-------------------------------------
	function executeFrame(&$data,$rid){
		$data["nav"] = $this->getRootNav();
		$data["root"] = $this->getServiceRootByID($rid);
		$data["footer"] = $this->getServiceCat(7);
	}
	// 头部导航栏
	function getRootNav(){
		$this->db->order_by("rootorder");
		$this->db->where("id < ",7);
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