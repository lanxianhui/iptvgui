<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "serviceinfo.php" ?>
<?php include "admininfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$service_list = new cservice_list();
$Page =& $service_list;

// Page init processing
$service_list->Page_Init();

// Page main processing
$service_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($service->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var service_list = new ew_Page("service_list");

// page properties
service_list.PageID = "list"; // page ID
var EW_PAGE_ID = service_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
service_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
service_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
service_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
service_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($service->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($service->Export == "" && $service->SelectLimit);
	if (!$bSelectLimit)
		$rs = $service_list->LoadRecordset();
	$service_list->lTotalRecs = ($bSelectLimit) ? $service->SelectRecordCount() : $rs->RecordCount();
	$service_list->lStartRec = 1;
	if ($service_list->lDisplayRecs <= 0) // Display all records
		$service_list->lDisplayRecs = $service_list->lTotalRecs;
	if (!($service->ExportAll && $service->Export <> ""))
		$service_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $service_list->LoadRecordset($service_list->lStartRec-1, $service_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Service
<?php if ($service->Export == "" && $service->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $service_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $service_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $service_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($service->Export == "" && $service->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(service_list);" style="text-decoration: none;"><img id="service_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="service_list_SearchPanel">
<form name="fservicelistsrch" id="fservicelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="service">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($service->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $service_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($service->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($service->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($service->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $service_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fservicelist" id="fservicelist" class="ewForm" action="" method="post">
<?php if ($service_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$service_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$service_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$service_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$service_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$service_list->lOptionCnt++; // Multi-select
}
	$service_list->lOptionCnt += count($service_list->ListOptions->Items); // Custom list options
?>
<?php echo $service->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($service->id->Visible) { // id ?>
	<?php if ($service->SortUrl($service->id) == "") { ?>
		<td>服务ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>服务ID</td><td style="width: 10px;"><?php if ($service->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->servicename->Visible) { // servicename ?>
	<?php if ($service->SortUrl($service->servicename) == "") { ?>
		<td>服务名称</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->servicename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>服务名称&nbsp;(*)</td><td style="width: 10px;"><?php if ($service->servicename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->servicename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->pubtime->Visible) { // pubtime ?>
	<?php if ($service->SortUrl($service->pubtime) == "") { ?>
		<td>发布时间</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->pubtime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>发布时间</td><td style="width: 10px;"><?php if ($service->pubtime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->pubtime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->rootid->Visible) { // rootid ?>
	<?php if ($service->SortUrl($service->rootid) == "") { ?>
		<td>根类型</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->rootid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类型</td><td style="width: 10px;"><?php if ($service->rootid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->rootid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->catid->Visible) { // catid ?>
	<?php if ($service->SortUrl($service->catid) == "") { ?>
		<td>服务类型</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->catid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>服务类型</td><td style="width: 10px;"><?php if ($service->catid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->catid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->servicepic->Visible) { // servicepic ?>
	<?php if ($service->SortUrl($service->servicepic) == "") { ?>
		<td>服务图片</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->servicepic) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>服务图片</td><td style="width: 10px;"><?php if ($service->servicepic->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->servicepic->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="service_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($service_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($service->ExportAll && $service->Export <> "") {
	$service_list->lStopRec = $service_list->lTotalRecs;
} else {
	$service_list->lStopRec = $service_list->lStartRec + $service_list->lDisplayRecs - 1; // Set the last record to display
}
$service_list->lRecCount = $service_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$service->SelectLimit && $service_list->lStartRec > 1)
		$rs->Move($service_list->lStartRec - 1);
}
$service_list->lRowCnt = 0;
while (($service->CurrentAction == "gridadd" || !$rs->EOF) &&
	$service_list->lRecCount < $service_list->lStopRec) {
	$service_list->lRecCount++;
	if (intval($service_list->lRecCount) >= intval($service_list->lStartRec)) {
		$service_list->lRowCnt++;

	// Init row class and style
	$service->CssClass = "";
	$service->CssStyle = "";
	$service->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($service->CurrentAction == "gridadd") {
		$service_list->LoadDefaultValues(); // Load default values
	} else {
		$service_list->LoadRowValues($rs); // Load row values
	}
	$service->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$service_list->RenderRow();
?>
	<tr<?php echo $service->RowAttributes() ?>>
	<?php if ($service->id->Visible) { // id ?>
		<td<?php echo $service->id->CellAttributes() ?>>
<div<?php echo $service->id->ViewAttributes() ?>><?php echo $service->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->servicename->Visible) { // servicename ?>
		<td<?php echo $service->servicename->CellAttributes() ?>>
<div<?php echo $service->servicename->ViewAttributes() ?>><?php echo $service->servicename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->pubtime->Visible) { // pubtime ?>
		<td<?php echo $service->pubtime->CellAttributes() ?>>
<div<?php echo $service->pubtime->ViewAttributes() ?>><?php echo $service->pubtime->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->rootid->Visible) { // rootid ?>
		<td<?php echo $service->rootid->CellAttributes() ?>>
<div<?php echo $service->rootid->ViewAttributes() ?>><?php echo $service->rootid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->catid->Visible) { // catid ?>
		<td<?php echo $service->catid->CellAttributes() ?>>
<div<?php echo $service->catid->ViewAttributes() ?>><?php echo $service->catid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->servicepic->Visible) { // servicepic ?>
		<td<?php echo $service->servicepic->CellAttributes() ?>>
<?php if ($service->servicepic->HrefValue <> "") { ?>
<?php if (!is_null($service->servicepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $service->servicepic->Upload->DbValue ?>" border=0<?php echo $service->servicepic->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($service->servicepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $service->servicepic->Upload->DbValue ?>" border=0<?php echo $service->servicepic->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($service->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $service->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $service->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $service->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($service->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($service_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($service->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($service->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($service->CurrentAction <> "gridadd" && $service->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($service_list->Pager)) $service_list->Pager = new cPrevNextPager($service_list->lStartRec, $service_list->lDisplayRecs, $service_list->lTotalRecs) ?>
<?php if ($service_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($service_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($service_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $service_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($service_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($service_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $service_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $service_list->Pager->FromIndex ?> 到 <?php echo $service_list->Pager->ToIndex ?> 总共 <?php echo $service_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($service_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">请输入搜索关键字</span>
	<?php } else { ?>
	<span class="phpmaker">没有数据</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($service_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($service_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fservicelist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $service_list->sDeleteConfirmMsg ?>')) {document.fservicelist.action='servicedelete.php';document.fservicelist.encoding='application/x-www-form-urlencoded';document.fservicelist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($service->Export == "" && $service->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(service_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($service->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cservice_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'service';

	// Page Object Name
	var $PageObjName = 'service_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $service;
		if ($service->UseTokenInUrl) $PageUrl .= "t=" . $service->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $service;
		if ($service->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservice_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["service"] = new cservice();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'service', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $service;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$service->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $service->Export; // Get export parameter, used in header
	$gsExportFile = $service->TableVar; // Get export file, used in header
	if ($service->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($service->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($service->Export == "csv") {
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
	}

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $service;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause
		$this->sDeleteConfirmMsg = "你真的要删除这些记录吗?"; // Delete confirm message

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($service->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $service->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$service->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$service->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$service->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$service->setSessionWhere($sFilter);
		$service->CurrentFilter = "";

		// Export data only
		if (in_array($service->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $service;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $service->servicename->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $service->servicedesc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $service->servicepic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $service;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$service->setBasicSearchKeyword($sSearchKeyword);
			$service->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $service;
		$this->sSrchWhere = "";
		$service->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $service;
		$service->setBasicSearchKeyword("");
		$service->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $service;
		$this->sSrchWhere = $service->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $service;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$service->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$service->CurrentOrderType = @$_GET["ordertype"];
			$service->UpdateSort($service->id); // Field 
			$service->UpdateSort($service->servicename); // Field 
			$service->UpdateSort($service->pubtime); // Field 
			$service->UpdateSort($service->rootid); // Field 
			$service->UpdateSort($service->catid); // Field 
			$service->UpdateSort($service->servicepic); // Field 
			$service->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $service;
		$sOrderBy = $service->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($service->SqlOrderBy() <> "") {
				$sOrderBy = $service->SqlOrderBy();
				$service->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $service;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$service->setSessionOrderBy($sOrderBy);
				$service->id->setSort("");
				$service->servicename->setSort("");
				$service->pubtime->setSort("");
				$service->rootid->setSort("");
				$service->catid->setSort("");
				$service->servicepic->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$service->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $service;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$service->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$service->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $service->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$service->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $service;

		// Call Recordset Selecting event
		$service->Recordset_Selecting($service->CurrentFilter);

		// Load list page SQL
		$sSql = $service->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$service->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $service;
		$sFilter = $service->KeyFilter();

		// Call Row Selecting event
		$service->Row_Selecting($sFilter);

		// Load sql based on filter
		$service->CurrentFilter = $sFilter;
		$sSql = $service->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$service->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $service;
		$service->id->setDbValue($rs->fields('id'));
		$service->servicename->setDbValue($rs->fields('servicename'));
		$service->pubtime->setDbValue($rs->fields('pubtime'));
		$service->servicedesc->setDbValue($rs->fields('servicedesc'));
		$service->rootid->setDbValue($rs->fields('rootid'));
		$service->catid->setDbValue($rs->fields('catid'));
		$service->servicepic->Upload->DbValue = $rs->fields('servicepic');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $service;

		// Call Row_Rendering event
		$service->Row_Rendering();

		// Common render codes for all row types
		// id

		$service->id->CellCssStyle = "";
		$service->id->CellCssClass = "";

		// servicename
		$service->servicename->CellCssStyle = "";
		$service->servicename->CellCssClass = "";

		// pubtime
		$service->pubtime->CellCssStyle = "";
		$service->pubtime->CellCssClass = "";

		// rootid
		$service->rootid->CellCssStyle = "";
		$service->rootid->CellCssClass = "";

		// catid
		$service->catid->CellCssStyle = "";
		$service->catid->CellCssClass = "";

		// servicepic
		$service->servicepic->CellCssStyle = "";
		$service->servicepic->CellCssClass = "";
		if ($service->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$service->id->ViewValue = $service->id->CurrentValue;
			$service->id->CssStyle = "";
			$service->id->CssClass = "";
			$service->id->ViewCustomAttributes = "";

			// servicename
			$service->servicename->ViewValue = $service->servicename->CurrentValue;
			$service->servicename->CssStyle = "";
			$service->servicename->CssClass = "";
			$service->servicename->ViewCustomAttributes = "";

			// pubtime
			$service->pubtime->ViewValue = $service->pubtime->CurrentValue;
			$service->pubtime->ViewValue = ew_FormatDateTime($service->pubtime->ViewValue, 5);
			$service->pubtime->CssStyle = "";
			$service->pubtime->CssClass = "";
			$service->pubtime->ViewCustomAttributes = "";

			// rootid
			if (strval($service->rootid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `rootname` FROM `serviceroot` WHERE `id` = " . ew_AdjustSql($service->rootid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$service->rootid->ViewValue = $rswrk->fields('rootname');
					$rswrk->Close();
				} else {
					$service->rootid->ViewValue = $service->rootid->CurrentValue;
				}
			} else {
				$service->rootid->ViewValue = NULL;
			}
			$service->rootid->CssStyle = "";
			$service->rootid->CssClass = "";
			$service->rootid->ViewCustomAttributes = "";

			// catid
			if (strval($service->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `servicecat` WHERE `id` = " . ew_AdjustSql($service->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$service->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$service->catid->ViewValue = $service->catid->CurrentValue;
				}
			} else {
				$service->catid->ViewValue = NULL;
			}
			$service->catid->CssStyle = "";
			$service->catid->CssClass = "";
			$service->catid->ViewCustomAttributes = "";

			// servicepic
			if (!is_null($service->servicepic->Upload->DbValue)) {
				$service->servicepic->ViewValue = $service->servicepic->Upload->DbValue;
				$service->servicepic->ImageAlt = "";
			} else {
				$service->servicepic->ViewValue = "";
			}
			$service->servicepic->CssStyle = "";
			$service->servicepic->CssClass = "";
			$service->servicepic->ViewCustomAttributes = "";

			// id
			$service->id->HrefValue = "";

			// servicename
			$service->servicename->HrefValue = "";

			// pubtime
			$service->pubtime->HrefValue = "";

			// rootid
			$service->rootid->HrefValue = "";

			// catid
			$service->catid->HrefValue = "";

			// servicepic
			$service->servicepic->HrefValue = "";
		}

		// Call Row Rendered event
		$service->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $service;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($service->ExportAll) {
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export 1 page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($service->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($service->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $service->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $service->Export);
				ew_ExportAddValue($sExportStr, 'servicename', $service->Export);
				ew_ExportAddValue($sExportStr, 'pubtime', $service->Export);
				ew_ExportAddValue($sExportStr, 'rootid', $service->Export);
				ew_ExportAddValue($sExportStr, 'catid', $service->Export);
				ew_ExportAddValue($sExportStr, 'servicepic', $service->Export);
				echo ew_ExportLine($sExportStr, $service->Export);
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row for display
				$service->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($service->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $service->id->CurrentValue);
					$XmlDoc->AddField('servicename', $service->servicename->CurrentValue);
					$XmlDoc->AddField('pubtime', $service->pubtime->CurrentValue);
					$XmlDoc->AddField('rootid', $service->rootid->CurrentValue);
					$XmlDoc->AddField('catid', $service->catid->CurrentValue);
					$XmlDoc->AddField('servicepic', $service->servicepic->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $service->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $service->id->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						echo ew_ExportField('servicename', $service->servicename->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						echo ew_ExportField('pubtime', $service->pubtime->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						echo ew_ExportField('rootid', $service->rootid->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						echo ew_ExportField('catid', $service->catid->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						echo ew_ExportField('servicepic', $service->servicepic->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $service->id->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						ew_ExportAddValue($sExportStr, $service->servicename->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						ew_ExportAddValue($sExportStr, $service->pubtime->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						ew_ExportAddValue($sExportStr, $service->rootid->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						ew_ExportAddValue($sExportStr, $service->catid->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						ew_ExportAddValue($sExportStr, $service->servicepic->ExportValue($service->Export, $service->ExportOriginalValue), $service->Export);
						echo ew_ExportLine($sExportStr, $service->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($service->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($service->Export);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
