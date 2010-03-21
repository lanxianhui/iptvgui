<?php
class Main extends Controller {
	var $methodName;
	var $pagesize = 15;
	
	function Main() {
		parent::Controller ();
	}
	
	function submitSign() {
		$sql = "INSERT INTO consulting (title,phone,company,content) VALUES" . " ('" . $_POST ["title"] . "'," . "'" . $_POST ["phone"] . "'," . "'" . $_POST ["company"] . "'," . "'" . $_POST ["content"] . "')";
		$this->db->query ( $sql );
		echo "Success";
	}
	
	function test($rid = 8, $catid = 1) {
		$data = array ();
		//$data["indexlink"] = $this->getIndexFriend();
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "test" );
	}
	
	function index($rid = 8, $catid = 1) {
		$data = array ();
		$data ["indexlink"] = $this->getIndexFriend ();
		$this->executeFrame ( $data, 8 );
		$this->showIndexView ( $data, "index" );
	}
	function signflow($rid = 0, $catid = 20) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		$data ["partner"] = $this->getAllPartners ();
		//$data["servicelist"] = $this->getServiceByCat($catid,0);
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "signflow" );
	}
	
	// 站点内容
	function catinfo($rid = 9, $catid = 7) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		$data ["servicelist"] = $this->getServiceByCat ( $catid, 0 );
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "catinfo" );
	}
	
	// 关于清雅 
	function elegant($rid, $catid = 2, $offset = 0) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		if($catid == 2){
			$data["team"] = $this->getTeamList();
		}
		//$this->pagiServiceNation ( "elegant", $rid, $catid, "service", $this->pagesize );
		//$data ["servicelist"] = $this->getServiceByCat ( $catid, $offset );
		//$data ["offset"] = $offset;
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "elegant" );
	}
	// 关于清雅详细页面
	function elegantinfo($rid, $catid, $teamid) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
	if($catid == 2){
			$data["team"] = $this->getTeamInfo($teamid);
		}
		//$data["partner"] = $this->getAllPartners();
		//$data["servicelist"] = $this->getServiceByCat($catid);
		//$data ["partnerinfo"] = $this->getServiceByID ( $serviceid );
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "elegantinfo" );
	}
	//新闻资讯
	function news($rid,$newcat=1,$offset = 0) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["newscat"] = $this->getNewsCat ();
		//$data ["selectcat"] = $catid;
		$data["selectncat"] = $newcat;
		$this->pagiNewsNation ( $rid, $newcat, "news", $this->pagesize );
		$data ["newslist"] = $this->getNewsByCat ( $newcat, $offset );
		//$data ["newspiclist"] = $this->getPicNewsByCat ( 2, 37 );
		$data ["offset"] = $offset;
		//$data ["content"] = $this->getNewsCatByID ( $catid );
		$this->executeFrame ( $data, 4 );
		$this->showView ( $data, "news" );
	}
	//新闻资讯详细内容
	function newsinfo($rid, $newcat, $nid, $offset = 0) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["newscat"] = $this->getNewsCat ();
		//$data ["selectcat"] = $catid;
		$data["selectncat"] = $newcat;
		$this->pagiNewsNation ( $rid, $newcat, "news", $this->pagesize );
		$data ["newslist"] = $this->getNewsByCat ( $newcat, $offset );
		$data ["offset"] = $offset;
		$data ["newsinfo"] = $this->getNewsByID ( $nid );
		$this->executeFrame ( $data, 4);
		$this->showView ( $data, "newsinfo" );
	}
	// 项目案例
	function cases($rid, $catid = 3, $offset = 0) {
		$data = array ();
		$data ["catmenu"] = $this->getCasesCatByID ();
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		$this->pagiServiceNation ( "cases", $rid, $catid, "service", $this->pagesize );
		$data ["offset"] = $offset;
		$data ["servicelist"] = $this->getServiceByCat ( $catid, $offset );
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "cases" );
	}
	// 加入我们
	function join($rid, $catid = 6, $offset = 0) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		$this->pagiServiceNation ( "join", $rid, $catid, "service", $this->pagesize );
		$data ["offset"] = $offset;
		$data ["servicelist"] = $this->getServiceByCat ( $catid, $offset );
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "join" );
	}
	
// 加入我们
	function joininfo($rid, $catid = 6,$jid) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		$data["infocontent"] = $this->getServiceByID($jid);
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "joininfo" );
	}
	// 联系我们
	function contack($rid, $catid = 7, $offset = 0) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		$this->pagiServiceNation ( "contack", $rid, $catid, "service", $this->pagesize );
		$data ["offset"] = $offset;
		$data ["servicelist"] = $this->getServiceByCat ( $catid, $offset );
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "contack" );
	}
	// 项目咨询
	function consulting($rid, $catid = 5, $offset = 0) {
		$data = array ();
		$data ["catmenu"] = $this->getServiceCat ( $rid );
		$data ["selectcat"] = $catid;
		$data ["content"] = $this->getServiceCatByID ( $catid );
		$this->pagiServiceNation ( "consulting", $rid, $catid, "service", $this->pagesize );
		$data ["offset"] = $offset;
		$data ["servicelist"] = $this->getServiceByCat ( $catid, $offset );
		$this->executeFrame ( $data, $rid );
		$this->showView ( $data, "consulting" );
	}
	// -------------------------------------------数据库需要的方法集合--------------------------------------
	function getJoinInfo($jid){
		$result = $this->db->get_where("join",array("id"=>$jid));
		return $result->result_array();
	}
	function getIndexFriend() {
		$result = $this->db->get ( "friendlink", 6, 0 );
		return $result->result_array ();
	}
	
	function getAllFriend() {
		$result = $this->db->get ( "friendlink" );
		return $result->result_array ();
	}
	function getCasesCat() {
		$this->db->order_by ( "catorder" );
		$result = $this->db->get ( "casescat" );
		return $result->result_array ();
	}
	function getCasesCatByID() {
		$this->db->order_by ( "catorder" );
		$result = $this->db->get_where ( "casescat");
		return $result->result_array ();
	}
	function getCasesByID($casesid) {
		$result = $this->db->get_where ( "cases", array ("id" => $casesid ) );
		return $result->result_array ();
	}
	
	function getIndexTopNews() {
		$this->db->order_by ( "pubtime", "desc" );
		$result = $this->db->get ( "news", 1, 0 );
		return $result->result_array ();
	}
	function getIndexNews($catid) {
		$this->db->order_by ( "pubtime", "desc" );
		$result = $this->db->get_where ( "news", array ("catid" => $catid ), 7, 0 );
		return $result->result_array ();
	}
	
	function getNewsByCat($catid, $offset) {
		$this->db->order_by ( "pubtime", "desc" );
		$result = $this->db->get_where ( "news", array ("catid" => $catid ), $this->pagesize, $offset );
		return $result->result_array ();
	}
	
	function getPicNewsByCat($size, $offset) {
		$this->db->order_by ( "pubtime desc" );
		$result = $this->db->get_where ( "news", array ("catid" => 3 ), $size, $offset );
		return $result->result_array ();
	}
	function getNewsCat() {
		$this->db->order_by ( "catorder" );
		$result = $this->db->get ( "newscat" );
		return $result->result_array ();
	}
	function getNewsByID($newsid) {
		$result = $this->db->get_where ( "news", array ("id" => $newsid ) );
		return $result->result_array ();
	}
	function getNewsCatByID($catid) {
		$this->db->order_by ( "catorder" );
		$result = $this->db->get_where ( "newscat", array ("id" => $catid ) );
		return $result->result_array ();
	}
	
	function getServiceByID($serviceid) {
		$result = $this->db->get_where ( "service", array ("id" => $serviceid ) );
		return $result->result_array ();
	}
	
	function getServiceByCat($catid, $offset) {
		$this->db->order_by ( "pubtime", "desc" );
		$result = $this->db->get_where ( "service", array ("catid" => $catid ), $this->pagesize, $offset );
		return $result->result_array ();
	}
	
	function getServiceCatByID($catid) {
		$this->db->order_by ( "catorder" );
		$result = $this->db->get_where ( "servicecat", array ("id" => $catid ) );
		return $result->result_array ();
	}
	
	function getServiceCat($rid) {
		$this->db->order_by ( "catorder" );
		$result = $this->db->get_where ( "servicecat", array ("rootid" => $rid ) );
		return $result->result_array ();
	}
	
	function getServiceRootByID($rid) {
		$result = $this->db->get_where ( "serviceroot", array ("id" => $rid ) );
		return $result->result_array ();
	}
	
	function getNotice() {
		$result = $this->db->get_where ( "servicecat", array ("id" => 10 ) );
		return $result->result_array ();
	}
	
	function getTeamList(){
		$this->db->order_by("id","desc");
		$result = $this->db->get("team");
		return $result->result_array();
	}
	
	function getTeamInfo($teamid){
		$result = $this->db->get_where("team",array("id"=>$teamid));
		return $result->result_array();
	}
	// -------------------------------------------整个页面需要用到的方法-------------------------------------
	function executeFrame(&$data, $rid) {
		$data ["nav"] = $this->getRootNav ();
		$data ["root"] = $this->getServiceRootByID ( $rid );
		$data ["selectroot"] = $rid;
		$data ["footer"] = $this->getServiceCat ( 8 );
	}
	// 头部导航栏
	function getRootNav() {
		$this->db->order_by ( "rootorder" );
		$this->db->where ( "id < ", 8 );
		$result = $this->db->get ( "serviceroot" );
		return $result->result_array ();
	}
	// -------------------------------------------分页用函数-------------------------------------------------
	function pagiServiceNation($commend, $rootid, $catid, $table, $perpage, $base_url = null, $uri_segment = 5, $total = null) {
		$this->load->library ( 'pagination' );
		if (! $base_url) {
			$config ['base_url'] = base_url () . 'index.php/main/' . $commend . '/' . $rootid . "/" . $catid . "/" . $this->methodName;
		} else {
			$config ['base_url'] = $base_url;
		}
		if (! $total) {
			$rownumber = $this->db->query ( "select * from service where catid=" . $catid . " and rootid=" . $rootid );
			$config ['total_rows'] = $rownumber->num_rows;
		} else {
			$config ['total_rows'] = $total;
		}
		$config ['uri_segment'] = $uri_segment;
		$config ['per_page'] = $perpage;
		$this->pagination->initialize ( $config );
	}
	
	function pagiExpertNation($commend, $rootid, $table, $perpage, $base_url = null, $uri_segment = 5, $total = null) {
		$this->load->library ( 'pagination' );
		if (! $base_url) {
			$config ['base_url'] = base_url () . 'index.php/main/' . $commend . '/' . $rootid . "/6/" . $this->methodName;
		} else {
			$config ['base_url'] = $base_url;
		}
		if (! $total) {
			$rownumber = $this->db->query ( "select * from expert" );
			$config ['total_rows'] = $rownumber->num_rows;
		} else {
			$config ['total_rows'] = $total;
		}
		$config ['uri_segment'] = $uri_segment;
		$config ['per_page'] = $perpage;
		$this->pagination->initialize ( $config );
	}
	
	function pagiSearchNation($keywordvalue, $keyword, $table, $perpage, $base_url = null, $uri_segment = 4, $total = null) {
		$this->load->library ( 'pagination' );
		if (! $base_url) {
			$config ['base_url'] = base_url () . 'index.php/main/search/' . $keywordvalue . "/" . $this->methodName;
		} else {
			$config ['base_url'] = $base_url;
		}
		if (! $total) {
			$keywordvalue = urldecode ( $keyword );
			$rownumber = $this->db->query ( "select * from news where newstitle like '%$keywordvalue%'" );
			$config ['total_rows'] = $rownumber->num_rows;
		} else {
			$config ['total_rows'] = $total;
		}
		$config ['uri_segment'] = $uri_segment;
		$config ['per_page'] = $perpage;
		$this->pagination->initialize ( $config );
	}
	
	function pagiNewsNation($rootid, $catid, $table, $perpage, $base_url = null, $uri_segment = 5, $total = null) {
		$this->load->library ( 'pagination' );
		if (! $base_url) {
			$config ['base_url'] = base_url () . 'index.php/main/news/' . $rootid . "/" . $catid . "/" . $this->methodName;
		} else {
			$config ['base_url'] = $base_url;
		}
		if (! $total) {
			$rownumber = $this->db->query ( "select * from news where catid=" . $catid . "" );
			$config ['total_rows'] = $rownumber->num_rows;
		} else {
			$config ['total_rows'] = $total;
		}
		$config ['uri_segment'] = $uri_segment;
		$config ['per_page'] = $perpage;
		$this->pagination->initialize ( $config );
	}
	// -------------------------------------------视图展示方法-----------------------------------------------
	// 视图展示
	function showView($data, $viewName = null) {
		$this->load->view ( "header", $data );
		$this->load->view ( "ad", $data );
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
		$this->load->view ( "ifooter", $data );
	}
}
?>