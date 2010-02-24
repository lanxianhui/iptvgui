<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "expertinfo.php" ?>
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
$expert_list = new cexpert_list();
$Page =& $expert_list;

// Page init processing
$expert_list->Page_Init();

// Page main processing
$expert_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($expert->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expert_list = new ew_Page("expert_list");

// page properties
expert_list.PageID = "list"; // page ID
var EW_PAGE_ID = expert_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expert_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expert_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expert_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expert_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($expert->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($expert->Export == "" && $expert->SelectLimit);
	if (!$bSelectLimit)
		$rs = $expert_list->LoadRecordset();
	$expert_list->lTotalRecs = ($bSelectLimit) ? $expert->SelectRecordCount() : $rs->RecordCount();
	$expert_list->lStartRec = 1;
	if ($expert_list->lDisplayRecs <= 0) // Display all records
		$expert_list->lDisplayRecs = $expert_list->lTotalRecs;
	if (!($expert->ExportAll && $expert->Export <> ""))
		$expert_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $expert_list->LoadRecordset($expert_list->lStartRec-1, $expert_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Expert
<?php if ($expert->Export == "" && $expert->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $expert_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $expert_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $expert_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($expert->Export == "" && $expert->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(expert_list);" style="text-decoration: none;"><img id="expert_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="expert_list_SearchPanel">
<form name="fexpertlistsrch" id="fexpertlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="expert">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($expert->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $expert_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($expert->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($expert->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($expert->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $expert_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fexpertlist" id="fexpertlist" class="ewForm" action="" method="post">
<?php if ($expert_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$expert_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$expert_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$expert_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$expert_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$expert_list->lOptionCnt++; // Multi-select
}
	$expert_list->lOptionCnt += count($expert_list->ListOptions->Items); // Custom list options
?>
<?php echo $expert->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($expert->id->Visible) { // id ?>
	<?php if ($expert->SortUrl($expert->id) == "") { ?>
		<td>专家ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expert->SortUrl($expert->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>专家ID</td><td style="width: 10px;"><?php if ($expert->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expert->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($expert->username->Visible) { // username ?>
	<?php if ($expert->SortUrl($expert->username) == "") { ?>
		<td>专家姓名</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expert->SortUrl($expert->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>专家姓名&nbsp;(*)</td><td style="width: 10px;"><?php if ($expert->username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expert->username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($expert->title->Visible) { // title ?>
	<?php if ($expert->SortUrl($expert->title) == "") { ?>
		<td>专家头衔</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expert->SortUrl($expert->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>专家头衔&nbsp;(*)</td><td style="width: 10px;"><?php if ($expert->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expert->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($expert->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="expert_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($expert_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($expert->ExportAll && $expert->Export <> "") {
	$expert_list->lStopRec = $expert_list->lTotalRecs;
} else {
	$expert_list->lStopRec = $expert_list->lStartRec + $expert_list->lDisplayRecs - 1; // Set the last record to display
}
$expert_list->lRecCount = $expert_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$expert->SelectLimit && $expert_list->lStartRec > 1)
		$rs->Move($expert_list->lStartRec - 1);
}
$expert_list->lRowCnt = 0;
while (($expert->CurrentAction == "gridadd" || !$rs->EOF) &&
	$expert_list->lRecCount < $expert_list->lStopRec) {
	$expert_list->lRecCount++;
	if (intval($expert_list->lRecCount) >= intval($expert_list->lStartRec)) {
		$expert_list->lRowCnt++;

	// Init row class and style
	$expert->CssClass = "";
	$expert->CssStyle = "";
	$expert->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($expert->CurrentAction == "gridadd") {
		$expert_list->LoadDefaultValues(); // Load default values
	} else {
		$expert_list->LoadRowValues($rs); // Load row values
	}
	$expert->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$expert_list->RenderRow();
?>
	<tr<?php echo $expert->RowAttributes() ?>>
	<?php if ($expert->id->Visible) { // id ?>
		<td<?php echo $expert->id->CellAttributes() ?>>
<div<?php echo $expert->id->ViewAttributes() ?>><?php echo $expert->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expert->username->Visible) { // username ?>
		<td<?php echo $expert->username->CellAttributes() ?>>
<div<?php echo $expert->username->ViewAttributes() ?>><?php echo $expert->username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expert->title->Visible) { // title ?>
		<td<?php echo $expert->title->CellAttributes() ?>>
<div<?php echo $expert->title->ViewAttributes() ?>><?php echo $expert->title->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($expert->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $expert->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $expert->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $expert->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($expert->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($expert_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($expert->CurrentAction <> "gridadd")
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
<?php if ($expert->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($expert->CurrentAction <> "gridadd" && $expert->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expert_list->Pager)) $expert_list->Pager = new cPrevNextPager($expert_list->lStartRec, $expert_list->lDisplayRecs, $expert_list->lTotalRecs) ?>
<?php if ($expert_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($expert_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expert_list->PageUrl() ?>start=<?php echo $expert_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expert_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expert_list->PageUrl() ?>start=<?php echo $expert_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expert_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expert_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expert_list->PageUrl() ?>start=<?php echo $expert_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expert_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expert_list->PageUrl() ?>start=<?php echo $expert_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $expert_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $expert_list->Pager->FromIndex ?> 到 <?php echo $expert_list->Pager->ToIndex ?> 总共 <?php echo $expert_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($expert_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($expert_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $expert->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expert_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fexpertlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $expert_list->sDeleteConfirmMsg ?>')) {document.fexpertlist.action='expertdelete.php';document.fexpertlist.encoding='application/x-www-form-urlencoded';document.fexpertlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($expert->Export == "" && $expert->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(expert_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($expert->Export == "") { ?>
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
class cexpert_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'expert';

	// Page Object Name
	var $PageObjName = 'expert_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expert;
		if ($expert->UseTokenInUrl) $PageUrl .= "t=" . $expert->TableVar . "&"; // add page token
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
		global $objForm, $expert;
		if ($expert->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($expert->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expert->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cexpert_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["expert"] = new cexpert();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expert', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $expert;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$expert->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $expert->Export; // Get export parameter, used in header
	$gsExportFile = $expert->TableVar; // Get export file, used in header
	if ($expert->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($expert->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($expert->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $expert;
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
		if ($expert->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $expert->getRecordsPerPage(); // Restore from Session
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
		$expert->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$expert->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$expert->setStartRecordNumber($this->lStartRec);
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
		$expert->setSessionWhere($sFilter);
		$expert->CurrentFilter = "";

		// Export data only
		if (in_array($expert->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $expert;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $expert->username->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $expert->title->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $expert->userpic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $expert->userdesc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $expert;
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
			$expert->setBasicSearchKeyword($sSearchKeyword);
			$expert->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $expert;
		$this->sSrchWhere = "";
		$expert->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $expert;
		$expert->setBasicSearchKeyword("");
		$expert->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $expert;
		$this->sSrchWhere = $expert->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $expert;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$expert->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expert->CurrentOrderType = @$_GET["ordertype"];
			$expert->UpdateSort($expert->id); // Field 
			$expert->UpdateSort($expert->username); // Field 
			$expert->UpdateSort($expert->title); // Field 
			$expert->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $expert;
		$sOrderBy = $expert->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($expert->SqlOrderBy() <> "") {
				$sOrderBy = $expert->SqlOrderBy();
				$expert->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $expert;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expert->setSessionOrderBy($sOrderBy);
				$expert->id->setSort("");
				$expert->username->setSort("");
				$expert->title->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$expert->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $expert;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$expert->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$expert->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $expert->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$expert->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$expert->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$expert->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expert;

		// Call Recordset Selecting event
		$expert->Recordset_Selecting($expert->CurrentFilter);

		// Load list page SQL
		$sSql = $expert->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$expert->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expert;
		$sFilter = $expert->KeyFilter();

		// Call Row Selecting event
		$expert->Row_Selecting($sFilter);

		// Load sql based on filter
		$expert->CurrentFilter = $sFilter;
		$sSql = $expert->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$expert->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $expert;
		$expert->id->setDbValue($rs->fields('id'));
		$expert->username->setDbValue($rs->fields('username'));
		$expert->title->setDbValue($rs->fields('title'));
		$expert->userpic->Upload->DbValue = $rs->fields('userpic');
		$expert->userdesc->setDbValue($rs->fields('userdesc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $expert;

		// Call Row_Rendering event
		$expert->Row_Rendering();

		// Common render codes for all row types
		// id

		$expert->id->CellCssStyle = "";
		$expert->id->CellCssClass = "";

		// username
		$expert->username->CellCssStyle = "";
		$expert->username->CellCssClass = "";

		// title
		$expert->title->CellCssStyle = "";
		$expert->title->CellCssClass = "";
		if ($expert->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expert->id->ViewValue = $expert->id->CurrentValue;
			$expert->id->CssStyle = "";
			$expert->id->CssClass = "";
			$expert->id->ViewCustomAttributes = "";

			// username
			$expert->username->ViewValue = $expert->username->CurrentValue;
			$expert->username->CssStyle = "";
			$expert->username->CssClass = "";
			$expert->username->ViewCustomAttributes = "";

			// title
			$expert->title->ViewValue = $expert->title->CurrentValue;
			$expert->title->CssStyle = "";
			$expert->title->CssClass = "";
			$expert->title->ViewCustomAttributes = "";

			// id
			$expert->id->HrefValue = "";

			// username
			$expert->username->HrefValue = "";

			// title
			$expert->title->HrefValue = "";
		}

		// Call Row Rendered event
		$expert->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $expert;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($expert->ExportAll) {
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
		if ($expert->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($expert->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $expert->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $expert->Export);
				ew_ExportAddValue($sExportStr, 'username', $expert->Export);
				ew_ExportAddValue($sExportStr, 'title', $expert->Export);
				echo ew_ExportLine($sExportStr, $expert->Export);
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
				$expert->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($expert->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $expert->id->CurrentValue);
					$XmlDoc->AddField('username', $expert->username->CurrentValue);
					$XmlDoc->AddField('title', $expert->title->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $expert->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $expert->id->ExportValue($expert->Export, $expert->ExportOriginalValue), $expert->Export);
						echo ew_ExportField('username', $expert->username->ExportValue($expert->Export, $expert->ExportOriginalValue), $expert->Export);
						echo ew_ExportField('title', $expert->title->ExportValue($expert->Export, $expert->ExportOriginalValue), $expert->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $expert->id->ExportValue($expert->Export, $expert->ExportOriginalValue), $expert->Export);
						ew_ExportAddValue($sExportStr, $expert->username->ExportValue($expert->Export, $expert->ExportOriginalValue), $expert->Export);
						ew_ExportAddValue($sExportStr, $expert->title->ExportValue($expert->Export, $expert->ExportOriginalValue), $expert->Export);
						echo ew_ExportLine($sExportStr, $expert->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($expert->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($expert->Export);
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
