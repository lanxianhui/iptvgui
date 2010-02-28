<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "signinfo.php" ?>
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
$sign_list = new csign_list();
$Page =& $sign_list;

// Page init processing
$sign_list->Page_Init();

// Page main processing
$sign_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($sign->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sign_list = new ew_Page("sign_list");

// page properties
sign_list.PageID = "list"; // page ID
var EW_PAGE_ID = sign_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
sign_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
sign_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
sign_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sign_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($sign->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($sign->Export == "" && $sign->SelectLimit);
	if (!$bSelectLimit)
		$rs = $sign_list->LoadRecordset();
	$sign_list->lTotalRecs = ($bSelectLimit) ? $sign->SelectRecordCount() : $rs->RecordCount();
	$sign_list->lStartRec = 1;
	if ($sign_list->lDisplayRecs <= 0) // Display all records
		$sign_list->lDisplayRecs = $sign_list->lTotalRecs;
	if (!($sign->ExportAll && $sign->Export <> ""))
		$sign_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $sign_list->LoadRecordset($sign_list->lStartRec-1, $sign_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Sign
<?php if ($sign->Export == "" && $sign->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $sign_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $sign_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $sign_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($sign->Export == "" && $sign->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(sign_list);" style="text-decoration: none;"><img id="sign_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="sign_list_SearchPanel">
<form name="fsignlistsrch" id="fsignlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="sign">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($sign->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $sign_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($sign->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($sign->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($sign->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $sign_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fsignlist" id="fsignlist" class="ewForm" action="" method="post">
<?php if ($sign_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$sign_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$sign_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$sign_list->lOptionCnt++; // Multi-select
}
	$sign_list->lOptionCnt += count($sign_list->ListOptions->Items); // Custom list options
?>
<?php echo $sign->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($sign->id->Visible) { // id ?>
	<?php if ($sign->SortUrl($sign->id) == "") { ?>
		<td>报名ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sign->SortUrl($sign->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>报名ID</td><td style="width: 10px;"><?php if ($sign->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sign->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($sign->username->Visible) { // username ?>
	<?php if ($sign->SortUrl($sign->username) == "") { ?>
		<td>报名人姓名</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sign->SortUrl($sign->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>报名人姓名&nbsp;(*)</td><td style="width: 10px;"><?php if ($sign->username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sign->username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($sign->email->Visible) { // email ?>
	<?php if ($sign->SortUrl($sign->email) == "") { ?>
		<td>报名Email</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sign->SortUrl($sign->email) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>报名Email&nbsp;(*)</td><td style="width: 10px;"><?php if ($sign->email->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sign->email->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($sign->company->Visible) { // company ?>
	<?php if ($sign->SortUrl($sign->company) == "") { ?>
		<td>报名单位</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sign->SortUrl($sign->company) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>报名单位&nbsp;(*)</td><td style="width: 10px;"><?php if ($sign->company->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sign->company->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($sign->mobile->Visible) { // mobile ?>
	<?php if ($sign->SortUrl($sign->mobile) == "") { ?>
		<td>手机号码</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sign->SortUrl($sign->mobile) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>手机号码&nbsp;(*)</td><td style="width: 10px;"><?php if ($sign->mobile->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sign->mobile->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($sign->phone->Visible) { // phone ?>
	<?php if ($sign->SortUrl($sign->phone) == "") { ?>
		<td>固定电话</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sign->SortUrl($sign->phone) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>固定电话&nbsp;(*)</td><td style="width: 10px;"><?php if ($sign->phone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sign->phone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($sign->address->Visible) { // address ?>
	<?php if ($sign->SortUrl($sign->address) == "") { ?>
		<td>所在地址</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sign->SortUrl($sign->address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>所在地址&nbsp;(*)</td><td style="width: 10px;"><?php if ($sign->address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sign->address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($sign->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="sign_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($sign_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($sign->ExportAll && $sign->Export <> "") {
	$sign_list->lStopRec = $sign_list->lTotalRecs;
} else {
	$sign_list->lStopRec = $sign_list->lStartRec + $sign_list->lDisplayRecs - 1; // Set the last record to display
}
$sign_list->lRecCount = $sign_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$sign->SelectLimit && $sign_list->lStartRec > 1)
		$rs->Move($sign_list->lStartRec - 1);
}
$sign_list->lRowCnt = 0;
while (($sign->CurrentAction == "gridadd" || !$rs->EOF) &&
	$sign_list->lRecCount < $sign_list->lStopRec) {
	$sign_list->lRecCount++;
	if (intval($sign_list->lRecCount) >= intval($sign_list->lStartRec)) {
		$sign_list->lRowCnt++;

	// Init row class and style
	$sign->CssClass = "";
	$sign->CssStyle = "";
	$sign->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($sign->CurrentAction == "gridadd") {
		$sign_list->LoadDefaultValues(); // Load default values
	} else {
		$sign_list->LoadRowValues($rs); // Load row values
	}
	$sign->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$sign_list->RenderRow();
?>
	<tr<?php echo $sign->RowAttributes() ?>>
	<?php if ($sign->id->Visible) { // id ?>
		<td<?php echo $sign->id->CellAttributes() ?>>
<div<?php echo $sign->id->ViewAttributes() ?>><?php echo $sign->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sign->username->Visible) { // username ?>
		<td<?php echo $sign->username->CellAttributes() ?>>
<div<?php echo $sign->username->ViewAttributes() ?>><?php echo $sign->username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sign->email->Visible) { // email ?>
		<td<?php echo $sign->email->CellAttributes() ?>>
<div<?php echo $sign->email->ViewAttributes() ?>><?php echo $sign->email->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sign->company->Visible) { // company ?>
		<td<?php echo $sign->company->CellAttributes() ?>>
<div<?php echo $sign->company->ViewAttributes() ?>><?php echo $sign->company->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sign->mobile->Visible) { // mobile ?>
		<td<?php echo $sign->mobile->CellAttributes() ?>>
<div<?php echo $sign->mobile->ViewAttributes() ?>><?php echo $sign->mobile->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sign->phone->Visible) { // phone ?>
		<td<?php echo $sign->phone->CellAttributes() ?>>
<div<?php echo $sign->phone->ViewAttributes() ?>><?php echo $sign->phone->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sign->address->Visible) { // address ?>
		<td<?php echo $sign->address->CellAttributes() ?>>
<div<?php echo $sign->address->ViewAttributes() ?>><?php echo $sign->address->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($sign->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $sign->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($sign->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($sign_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($sign->CurrentAction <> "gridadd")
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
<?php if ($sign->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($sign->CurrentAction <> "gridadd" && $sign->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($sign_list->Pager)) $sign_list->Pager = new cPrevNextPager($sign_list->lStartRec, $sign_list->lDisplayRecs, $sign_list->lTotalRecs) ?>
<?php if ($sign_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($sign_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $sign_list->PageUrl() ?>start=<?php echo $sign_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($sign_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $sign_list->PageUrl() ?>start=<?php echo $sign_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $sign_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($sign_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $sign_list->PageUrl() ?>start=<?php echo $sign_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($sign_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $sign_list->PageUrl() ?>start=<?php echo $sign_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $sign_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $sign_list->Pager->FromIndex ?> 到 <?php echo $sign_list->Pager->ToIndex ?> 总共 <?php echo $sign_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($sign_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($sign_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($sign_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsignlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $sign_list->sDeleteConfirmMsg ?>')) {document.fsignlist.action='signdelete.php';document.fsignlist.encoding='application/x-www-form-urlencoded';document.fsignlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($sign->Export == "" && $sign->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(sign_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($sign->Export == "") { ?>
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
class csign_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'sign';

	// Page Object Name
	var $PageObjName = 'sign_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sign;
		if ($sign->UseTokenInUrl) $PageUrl .= "t=" . $sign->TableVar . "&"; // add page token
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
		global $objForm, $sign;
		if ($sign->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($sign->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sign->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function csign_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["sign"] = new csign();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sign', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $sign;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$sign->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $sign->Export; // Get export parameter, used in header
	$gsExportFile = $sign->TableVar; // Get export file, used in header
	if ($sign->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($sign->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($sign->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $sign;
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
		if ($sign->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $sign->getRecordsPerPage(); // Restore from Session
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
		$sign->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$sign->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$sign->setStartRecordNumber($this->lStartRec);
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
		$sign->setSessionWhere($sFilter);
		$sign->CurrentFilter = "";

		// Export data only
		if (in_array($sign->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $sign;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $sign->username->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $sign->email->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $sign->company->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $sign->contact->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $sign->mobile->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $sign->phone->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $sign->address->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $sign;
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
			$sign->setBasicSearchKeyword($sSearchKeyword);
			$sign->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $sign;
		$this->sSrchWhere = "";
		$sign->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $sign;
		$sign->setBasicSearchKeyword("");
		$sign->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $sign;
		$this->sSrchWhere = $sign->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $sign;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$sign->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$sign->CurrentOrderType = @$_GET["ordertype"];
			$sign->UpdateSort($sign->id); // Field 
			$sign->UpdateSort($sign->username); // Field 
			$sign->UpdateSort($sign->email); // Field 
			$sign->UpdateSort($sign->company); // Field 
			$sign->UpdateSort($sign->mobile); // Field 
			$sign->UpdateSort($sign->phone); // Field 
			$sign->UpdateSort($sign->address); // Field 
			$sign->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $sign;
		$sOrderBy = $sign->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($sign->SqlOrderBy() <> "") {
				$sOrderBy = $sign->SqlOrderBy();
				$sign->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $sign;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$sign->setSessionOrderBy($sOrderBy);
				$sign->id->setSort("");
				$sign->username->setSort("");
				$sign->email->setSort("");
				$sign->company->setSort("");
				$sign->mobile->setSort("");
				$sign->phone->setSort("");
				$sign->address->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$sign->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $sign;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$sign->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$sign->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $sign->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$sign->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$sign->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$sign->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $sign;

		// Call Recordset Selecting event
		$sign->Recordset_Selecting($sign->CurrentFilter);

		// Load list page SQL
		$sSql = $sign->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$sign->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sign;
		$sFilter = $sign->KeyFilter();

		// Call Row Selecting event
		$sign->Row_Selecting($sFilter);

		// Load sql based on filter
		$sign->CurrentFilter = $sFilter;
		$sSql = $sign->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$sign->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $sign;
		$sign->id->setDbValue($rs->fields('id'));
		$sign->username->setDbValue($rs->fields('username'));
		$sign->email->setDbValue($rs->fields('email'));
		$sign->company->setDbValue($rs->fields('company'));
		$sign->contact->setDbValue($rs->fields('contact'));
		$sign->mobile->setDbValue($rs->fields('mobile'));
		$sign->phone->setDbValue($rs->fields('phone'));
		$sign->address->setDbValue($rs->fields('address'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $sign;

		// Call Row_Rendering event
		$sign->Row_Rendering();

		// Common render codes for all row types
		// id

		$sign->id->CellCssStyle = "";
		$sign->id->CellCssClass = "";

		// username
		$sign->username->CellCssStyle = "";
		$sign->username->CellCssClass = "";

		// email
		$sign->email->CellCssStyle = "";
		$sign->email->CellCssClass = "";

		// company
		$sign->company->CellCssStyle = "";
		$sign->company->CellCssClass = "";

		// mobile
		$sign->mobile->CellCssStyle = "";
		$sign->mobile->CellCssClass = "";

		// phone
		$sign->phone->CellCssStyle = "";
		$sign->phone->CellCssClass = "";

		// address
		$sign->address->CellCssStyle = "";
		$sign->address->CellCssClass = "";
		if ($sign->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$sign->id->ViewValue = $sign->id->CurrentValue;
			$sign->id->CssStyle = "";
			$sign->id->CssClass = "";
			$sign->id->ViewCustomAttributes = "";

			// username
			$sign->username->ViewValue = $sign->username->CurrentValue;
			$sign->username->CssStyle = "";
			$sign->username->CssClass = "";
			$sign->username->ViewCustomAttributes = "";

			// email
			$sign->email->ViewValue = $sign->email->CurrentValue;
			$sign->email->CssStyle = "";
			$sign->email->CssClass = "";
			$sign->email->ViewCustomAttributes = "";

			// company
			$sign->company->ViewValue = $sign->company->CurrentValue;
			$sign->company->CssStyle = "";
			$sign->company->CssClass = "";
			$sign->company->ViewCustomAttributes = "";

			// mobile
			$sign->mobile->ViewValue = $sign->mobile->CurrentValue;
			$sign->mobile->CssStyle = "";
			$sign->mobile->CssClass = "";
			$sign->mobile->ViewCustomAttributes = "";

			// phone
			$sign->phone->ViewValue = $sign->phone->CurrentValue;
			$sign->phone->CssStyle = "";
			$sign->phone->CssClass = "";
			$sign->phone->ViewCustomAttributes = "";

			// address
			$sign->address->ViewValue = $sign->address->CurrentValue;
			$sign->address->CssStyle = "";
			$sign->address->CssClass = "";
			$sign->address->ViewCustomAttributes = "";

			// id
			$sign->id->HrefValue = "";

			// username
			$sign->username->HrefValue = "";

			// email
			$sign->email->HrefValue = "";

			// company
			$sign->company->HrefValue = "";

			// mobile
			$sign->mobile->HrefValue = "";

			// phone
			$sign->phone->HrefValue = "";

			// address
			$sign->address->HrefValue = "";
		}

		// Call Row Rendered event
		$sign->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $sign;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($sign->ExportAll) {
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
		if ($sign->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($sign->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $sign->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $sign->Export);
				ew_ExportAddValue($sExportStr, 'username', $sign->Export);
				ew_ExportAddValue($sExportStr, 'email', $sign->Export);
				ew_ExportAddValue($sExportStr, 'company', $sign->Export);
				ew_ExportAddValue($sExportStr, 'mobile', $sign->Export);
				ew_ExportAddValue($sExportStr, 'phone', $sign->Export);
				ew_ExportAddValue($sExportStr, 'address', $sign->Export);
				echo ew_ExportLine($sExportStr, $sign->Export);
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
				$sign->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($sign->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $sign->id->CurrentValue);
					$XmlDoc->AddField('username', $sign->username->CurrentValue);
					$XmlDoc->AddField('email', $sign->email->CurrentValue);
					$XmlDoc->AddField('company', $sign->company->CurrentValue);
					$XmlDoc->AddField('mobile', $sign->mobile->CurrentValue);
					$XmlDoc->AddField('phone', $sign->phone->CurrentValue);
					$XmlDoc->AddField('address', $sign->address->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $sign->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $sign->id->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						echo ew_ExportField('username', $sign->username->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						echo ew_ExportField('email', $sign->email->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						echo ew_ExportField('company', $sign->company->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						echo ew_ExportField('mobile', $sign->mobile->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						echo ew_ExportField('phone', $sign->phone->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						echo ew_ExportField('address', $sign->address->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $sign->id->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						ew_ExportAddValue($sExportStr, $sign->username->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						ew_ExportAddValue($sExportStr, $sign->email->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						ew_ExportAddValue($sExportStr, $sign->company->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						ew_ExportAddValue($sExportStr, $sign->mobile->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						ew_ExportAddValue($sExportStr, $sign->phone->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						ew_ExportAddValue($sExportStr, $sign->address->ExportValue($sign->Export, $sign->ExportOriginalValue), $sign->Export);
						echo ew_ExportLine($sExportStr, $sign->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($sign->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($sign->Export);
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
