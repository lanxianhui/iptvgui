<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "partnerinfo.php" ?>
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
$partner_list = new cpartner_list();
$Page =& $partner_list;

// Page init processing
$partner_list->Page_Init();

// Page main processing
$partner_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($partner->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var partner_list = new ew_Page("partner_list");

// page properties
partner_list.PageID = "list"; // page ID
var EW_PAGE_ID = partner_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
partner_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
partner_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
partner_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
partner_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($partner->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($partner->Export == "" && $partner->SelectLimit);
	if (!$bSelectLimit)
		$rs = $partner_list->LoadRecordset();
	$partner_list->lTotalRecs = ($bSelectLimit) ? $partner->SelectRecordCount() : $rs->RecordCount();
	$partner_list->lStartRec = 1;
	if ($partner_list->lDisplayRecs <= 0) // Display all records
		$partner_list->lDisplayRecs = $partner_list->lTotalRecs;
	if (!($partner->ExportAll && $partner->Export <> ""))
		$partner_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $partner_list->LoadRecordset($partner_list->lStartRec-1, $partner_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Partner
<?php if ($partner->Export == "" && $partner->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $partner_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $partner_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $partner_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($partner->Export == "" && $partner->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(partner_list);" style="text-decoration: none;"><img id="partner_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="partner_list_SearchPanel">
<form name="fpartnerlistsrch" id="fpartnerlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="partner">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($partner->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $partner_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($partner->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($partner->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($partner->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $partner_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fpartnerlist" id="fpartnerlist" class="ewForm" action="" method="post">
<?php if ($partner_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$partner_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$partner_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$partner_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$partner_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$partner_list->lOptionCnt++; // Multi-select
}
	$partner_list->lOptionCnt += count($partner_list->ListOptions->Items); // Custom list options
?>
<?php echo $partner->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($partner->id->Visible) { // id ?>
	<?php if ($partner->SortUrl($partner->id) == "") { ?>
		<td>合作伙伴ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $partner->SortUrl($partner->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>合作伙伴ID</td><td style="width: 10px;"><?php if ($partner->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($partner->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($partner->pname->Visible) { // pname ?>
	<?php if ($partner->SortUrl($partner->pname) == "") { ?>
		<td>合作伙伴名</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $partner->SortUrl($partner->pname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>合作伙伴名&nbsp;(*)</td><td style="width: 10px;"><?php if ($partner->pname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($partner->pname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($partner->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="partner_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($partner_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($partner->ExportAll && $partner->Export <> "") {
	$partner_list->lStopRec = $partner_list->lTotalRecs;
} else {
	$partner_list->lStopRec = $partner_list->lStartRec + $partner_list->lDisplayRecs - 1; // Set the last record to display
}
$partner_list->lRecCount = $partner_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$partner->SelectLimit && $partner_list->lStartRec > 1)
		$rs->Move($partner_list->lStartRec - 1);
}
$partner_list->lRowCnt = 0;
while (($partner->CurrentAction == "gridadd" || !$rs->EOF) &&
	$partner_list->lRecCount < $partner_list->lStopRec) {
	$partner_list->lRecCount++;
	if (intval($partner_list->lRecCount) >= intval($partner_list->lStartRec)) {
		$partner_list->lRowCnt++;

	// Init row class and style
	$partner->CssClass = "";
	$partner->CssStyle = "";
	$partner->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($partner->CurrentAction == "gridadd") {
		$partner_list->LoadDefaultValues(); // Load default values
	} else {
		$partner_list->LoadRowValues($rs); // Load row values
	}
	$partner->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$partner_list->RenderRow();
?>
	<tr<?php echo $partner->RowAttributes() ?>>
	<?php if ($partner->id->Visible) { // id ?>
		<td<?php echo $partner->id->CellAttributes() ?>>
<div<?php echo $partner->id->ViewAttributes() ?>><?php echo $partner->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($partner->pname->Visible) { // pname ?>
		<td<?php echo $partner->pname->CellAttributes() ?>>
<div<?php echo $partner->pname->ViewAttributes() ?>><?php echo $partner->pname->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($partner->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $partner->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $partner->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $partner->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($partner->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($partner_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($partner->CurrentAction <> "gridadd")
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
<?php if ($partner->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($partner->CurrentAction <> "gridadd" && $partner->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($partner_list->Pager)) $partner_list->Pager = new cPrevNextPager($partner_list->lStartRec, $partner_list->lDisplayRecs, $partner_list->lTotalRecs) ?>
<?php if ($partner_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($partner_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $partner_list->PageUrl() ?>start=<?php echo $partner_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($partner_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $partner_list->PageUrl() ?>start=<?php echo $partner_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $partner_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($partner_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $partner_list->PageUrl() ?>start=<?php echo $partner_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($partner_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $partner_list->PageUrl() ?>start=<?php echo $partner_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $partner_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $partner_list->Pager->FromIndex ?> 到 <?php echo $partner_list->Pager->ToIndex ?> 总共 <?php echo $partner_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($partner_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($partner_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $partner->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($partner_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fpartnerlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $partner_list->sDeleteConfirmMsg ?>')) {document.fpartnerlist.action='partnerdelete.php';document.fpartnerlist.encoding='application/x-www-form-urlencoded';document.fpartnerlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($partner->Export == "" && $partner->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(partner_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($partner->Export == "") { ?>
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
class cpartner_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'partner';

	// Page Object Name
	var $PageObjName = 'partner_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $partner;
		if ($partner->UseTokenInUrl) $PageUrl .= "t=" . $partner->TableVar . "&"; // add page token
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
		global $objForm, $partner;
		if ($partner->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($partner->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($partner->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cpartner_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["partner"] = new cpartner();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'partner', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $partner;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$partner->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $partner->Export; // Get export parameter, used in header
	$gsExportFile = $partner->TableVar; // Get export file, used in header
	if ($partner->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($partner->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($partner->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $partner;
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
		if ($partner->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $partner->getRecordsPerPage(); // Restore from Session
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
		$partner->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$partner->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$partner->setStartRecordNumber($this->lStartRec);
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
		$partner->setSessionWhere($sFilter);
		$partner->CurrentFilter = "";

		// Export data only
		if (in_array($partner->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $partner;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $partner->pname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $partner->paddress->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $partner->pimage->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $partner;
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
			$partner->setBasicSearchKeyword($sSearchKeyword);
			$partner->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $partner;
		$this->sSrchWhere = "";
		$partner->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $partner;
		$partner->setBasicSearchKeyword("");
		$partner->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $partner;
		$this->sSrchWhere = $partner->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $partner;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$partner->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$partner->CurrentOrderType = @$_GET["ordertype"];
			$partner->UpdateSort($partner->id); // Field 
			$partner->UpdateSort($partner->pname); // Field 
			$partner->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $partner;
		$sOrderBy = $partner->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($partner->SqlOrderBy() <> "") {
				$sOrderBy = $partner->SqlOrderBy();
				$partner->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $partner;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$partner->setSessionOrderBy($sOrderBy);
				$partner->id->setSort("");
				$partner->pname->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$partner->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $partner;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$partner->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$partner->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $partner->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$partner->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$partner->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$partner->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $partner;

		// Call Recordset Selecting event
		$partner->Recordset_Selecting($partner->CurrentFilter);

		// Load list page SQL
		$sSql = $partner->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$partner->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $partner;
		$sFilter = $partner->KeyFilter();

		// Call Row Selecting event
		$partner->Row_Selecting($sFilter);

		// Load sql based on filter
		$partner->CurrentFilter = $sFilter;
		$sSql = $partner->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$partner->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $partner;
		$partner->id->setDbValue($rs->fields('id'));
		$partner->pname->setDbValue($rs->fields('pname'));
		$partner->paddress->setDbValue($rs->fields('paddress'));
		$partner->pimage->Upload->DbValue = $rs->fields('pimage');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $partner;

		// Call Row_Rendering event
		$partner->Row_Rendering();

		// Common render codes for all row types
		// id

		$partner->id->CellCssStyle = "";
		$partner->id->CellCssClass = "";

		// pname
		$partner->pname->CellCssStyle = "";
		$partner->pname->CellCssClass = "";
		if ($partner->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$partner->id->ViewValue = $partner->id->CurrentValue;
			$partner->id->CssStyle = "";
			$partner->id->CssClass = "";
			$partner->id->ViewCustomAttributes = "";

			// pname
			$partner->pname->ViewValue = $partner->pname->CurrentValue;
			$partner->pname->CssStyle = "";
			$partner->pname->CssClass = "";
			$partner->pname->ViewCustomAttributes = "";

			// id
			$partner->id->HrefValue = "";

			// pname
			$partner->pname->HrefValue = "";
		}

		// Call Row Rendered event
		$partner->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $partner;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($partner->ExportAll) {
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
		if ($partner->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($partner->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $partner->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $partner->Export);
				ew_ExportAddValue($sExportStr, 'pname', $partner->Export);
				echo ew_ExportLine($sExportStr, $partner->Export);
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
				$partner->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($partner->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $partner->id->CurrentValue);
					$XmlDoc->AddField('pname', $partner->pname->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $partner->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $partner->id->ExportValue($partner->Export, $partner->ExportOriginalValue), $partner->Export);
						echo ew_ExportField('pname', $partner->pname->ExportValue($partner->Export, $partner->ExportOriginalValue), $partner->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $partner->id->ExportValue($partner->Export, $partner->ExportOriginalValue), $partner->Export);
						ew_ExportAddValue($sExportStr, $partner->pname->ExportValue($partner->Export, $partner->ExportOriginalValue), $partner->Export);
						echo ew_ExportLine($sExportStr, $partner->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($partner->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($partner->Export);
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
