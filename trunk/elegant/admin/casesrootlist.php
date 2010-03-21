<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesrootinfo.php" ?>
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
$casesroot_list = new ccasesroot_list();
$Page =& $casesroot_list;

// Page init processing
$casesroot_list->Page_Init();

// Page main processing
$casesroot_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($casesroot->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var casesroot_list = new ew_Page("casesroot_list");

// page properties
casesroot_list.PageID = "list"; // page ID
var EW_PAGE_ID = casesroot_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
casesroot_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
casesroot_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
casesroot_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casesroot_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($casesroot->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($casesroot->Export == "" && $casesroot->SelectLimit);
	if (!$bSelectLimit)
		$rs = $casesroot_list->LoadRecordset();
	$casesroot_list->lTotalRecs = ($bSelectLimit) ? $casesroot->SelectRecordCount() : $rs->RecordCount();
	$casesroot_list->lStartRec = 1;
	if ($casesroot_list->lDisplayRecs <= 0) // Display all records
		$casesroot_list->lDisplayRecs = $casesroot_list->lTotalRecs;
	if (!($casesroot->ExportAll && $casesroot->Export <> ""))
		$casesroot_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $casesroot_list->LoadRecordset($casesroot_list->lStartRec-1, $casesroot_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Casesroot
<?php if ($casesroot->Export == "" && $casesroot->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $casesroot_list->PageUrl() ?>export=html">导出到 HTML</a>
&nbsp;&nbsp;<a href="<?php echo $casesroot_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $casesroot_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($casesroot->Export == "" && $casesroot->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(casesroot_list);" style="text-decoration: none;"><img id="casesroot_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="casesroot_list_SearchPanel">
<form name="fcasesrootlistsrch" id="fcasesrootlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="casesroot">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($casesroot->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $casesroot_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($casesroot->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($casesroot->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($casesroot->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $casesroot_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fcasesrootlist" id="fcasesrootlist" class="ewForm" action="" method="post">
<?php if ($casesroot_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$casesroot_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$casesroot_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$casesroot_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$casesroot_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$casesroot_list->lOptionCnt++; // Multi-select
}
	$casesroot_list->lOptionCnt += count($casesroot_list->ListOptions->Items); // Custom list options
?>
<?php echo $casesroot->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($casesroot->id->Visible) { // id ?>
	<?php if ($casesroot->SortUrl($casesroot->id) == "") { ?>
		<td>案例根类ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $casesroot->SortUrl($casesroot->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>案例根类ID</td><td style="width: 10px;"><?php if ($casesroot->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($casesroot->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($casesroot->rootname->Visible) { // rootname ?>
	<?php if ($casesroot->SortUrl($casesroot->rootname) == "") { ?>
		<td>根类型名</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $casesroot->SortUrl($casesroot->rootname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类型名&nbsp;(*)</td><td style="width: 10px;"><?php if ($casesroot->rootname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($casesroot->rootname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($casesroot->rootorder->Visible) { // rootorder ?>
	<?php if ($casesroot->SortUrl($casesroot->rootorder) == "") { ?>
		<td>根类排序</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $casesroot->SortUrl($casesroot->rootorder) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类排序</td><td style="width: 10px;"><?php if ($casesroot->rootorder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($casesroot->rootorder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($casesroot->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="casesroot_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($casesroot_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($casesroot->ExportAll && $casesroot->Export <> "") {
	$casesroot_list->lStopRec = $casesroot_list->lTotalRecs;
} else {
	$casesroot_list->lStopRec = $casesroot_list->lStartRec + $casesroot_list->lDisplayRecs - 1; // Set the last record to display
}
$casesroot_list->lRecCount = $casesroot_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$casesroot->SelectLimit && $casesroot_list->lStartRec > 1)
		$rs->Move($casesroot_list->lStartRec - 1);
}
$casesroot_list->lRowCnt = 0;
while (($casesroot->CurrentAction == "gridadd" || !$rs->EOF) &&
	$casesroot_list->lRecCount < $casesroot_list->lStopRec) {
	$casesroot_list->lRecCount++;
	if (intval($casesroot_list->lRecCount) >= intval($casesroot_list->lStartRec)) {
		$casesroot_list->lRowCnt++;

	// Init row class and style
	$casesroot->CssClass = "";
	$casesroot->CssStyle = "";
	$casesroot->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($casesroot->CurrentAction == "gridadd") {
		$casesroot_list->LoadDefaultValues(); // Load default values
	} else {
		$casesroot_list->LoadRowValues($rs); // Load row values
	}
	$casesroot->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$casesroot_list->RenderRow();
?>
	<tr<?php echo $casesroot->RowAttributes() ?>>
	<?php if ($casesroot->id->Visible) { // id ?>
		<td<?php echo $casesroot->id->CellAttributes() ?>>
<div<?php echo $casesroot->id->ViewAttributes() ?>><?php echo $casesroot->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($casesroot->rootname->Visible) { // rootname ?>
		<td<?php echo $casesroot->rootname->CellAttributes() ?>>
<div<?php echo $casesroot->rootname->ViewAttributes() ?>><?php echo $casesroot->rootname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($casesroot->rootorder->Visible) { // rootorder ?>
		<td<?php echo $casesroot->rootorder->CellAttributes() ?>>
<div<?php echo $casesroot->rootorder->ViewAttributes() ?>><?php echo $casesroot->rootorder->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($casesroot->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $casesroot->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $casesroot->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $casesroot->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($casesroot->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($casesroot_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($casesroot->CurrentAction <> "gridadd")
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
<?php if ($casesroot->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($casesroot->CurrentAction <> "gridadd" && $casesroot->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($casesroot_list->Pager)) $casesroot_list->Pager = new cPrevNextPager($casesroot_list->lStartRec, $casesroot_list->lDisplayRecs, $casesroot_list->lTotalRecs) ?>
<?php if ($casesroot_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($casesroot_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_list->PageUrl() ?>start=<?php echo $casesroot_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($casesroot_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_list->PageUrl() ?>start=<?php echo $casesroot_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $casesroot_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($casesroot_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_list->PageUrl() ?>start=<?php echo $casesroot_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($casesroot_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_list->PageUrl() ?>start=<?php echo $casesroot_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $casesroot_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $casesroot_list->Pager->FromIndex ?> 到 <?php echo $casesroot_list->Pager->ToIndex ?> 总共 <?php echo $casesroot_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($casesroot_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($casesroot_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $casesroot->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($casesroot_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcasesrootlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $casesroot_list->sDeleteConfirmMsg ?>')) {document.fcasesrootlist.action='casesrootdelete.php';document.fcasesrootlist.encoding='application/x-www-form-urlencoded';document.fcasesrootlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($casesroot->Export == "" && $casesroot->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(casesroot_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($casesroot->Export == "") { ?>
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
class ccasesroot_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'casesroot';

	// Page Object Name
	var $PageObjName = 'casesroot_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $casesroot;
		if ($casesroot->UseTokenInUrl) $PageUrl .= "t=" . $casesroot->TableVar . "&"; // add page token
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
		global $objForm, $casesroot;
		if ($casesroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($casesroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($casesroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccasesroot_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["casesroot"] = new ccasesroot();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'casesroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $casesroot;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$casesroot->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $casesroot->Export; // Get export parameter, used in header
	$gsExportFile = $casesroot->TableVar; // Get export file, used in header
	if ($casesroot->Export == "print" || $casesroot->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($casesroot->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($casesroot->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $casesroot;
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
		if ($casesroot->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $casesroot->getRecordsPerPage(); // Restore from Session
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
		$casesroot->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$casesroot->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$casesroot->setStartRecordNumber($this->lStartRec);
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
		$casesroot->setSessionWhere($sFilter);
		$casesroot->CurrentFilter = "";

		// Export data only
		if (in_array($casesroot->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $casesroot;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $casesroot->rootname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $casesroot;
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
			$casesroot->setBasicSearchKeyword($sSearchKeyword);
			$casesroot->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $casesroot;
		$this->sSrchWhere = "";
		$casesroot->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $casesroot;
		$casesroot->setBasicSearchKeyword("");
		$casesroot->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $casesroot;
		$this->sSrchWhere = $casesroot->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $casesroot;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$casesroot->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$casesroot->CurrentOrderType = @$_GET["ordertype"];
			$casesroot->UpdateSort($casesroot->id); // Field 
			$casesroot->UpdateSort($casesroot->rootname); // Field 
			$casesroot->UpdateSort($casesroot->rootorder); // Field 
			$casesroot->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $casesroot;
		$sOrderBy = $casesroot->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($casesroot->SqlOrderBy() <> "") {
				$sOrderBy = $casesroot->SqlOrderBy();
				$casesroot->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $casesroot;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$casesroot->setSessionOrderBy($sOrderBy);
				$casesroot->id->setSort("");
				$casesroot->rootname->setSort("");
				$casesroot->rootorder->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$casesroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $casesroot;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$casesroot->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$casesroot->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $casesroot->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$casesroot->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$casesroot->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$casesroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $casesroot;

		// Call Recordset Selecting event
		$casesroot->Recordset_Selecting($casesroot->CurrentFilter);

		// Load list page SQL
		$sSql = $casesroot->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$casesroot->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $casesroot;
		$sFilter = $casesroot->KeyFilter();

		// Call Row Selecting event
		$casesroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$casesroot->CurrentFilter = $sFilter;
		$sSql = $casesroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$casesroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $casesroot;
		$casesroot->id->setDbValue($rs->fields('id'));
		$casesroot->rootname->setDbValue($rs->fields('rootname'));
		$casesroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $casesroot;

		// Call Row_Rendering event
		$casesroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$casesroot->id->CellCssStyle = "";
		$casesroot->id->CellCssClass = "";

		// rootname
		$casesroot->rootname->CellCssStyle = "";
		$casesroot->rootname->CellCssClass = "";

		// rootorder
		$casesroot->rootorder->CellCssStyle = "";
		$casesroot->rootorder->CellCssClass = "";
		if ($casesroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$casesroot->id->ViewValue = $casesroot->id->CurrentValue;
			$casesroot->id->CssStyle = "";
			$casesroot->id->CssClass = "";
			$casesroot->id->ViewCustomAttributes = "";

			// rootname
			$casesroot->rootname->ViewValue = $casesroot->rootname->CurrentValue;
			$casesroot->rootname->CssStyle = "";
			$casesroot->rootname->CssClass = "";
			$casesroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$casesroot->rootorder->ViewValue = $casesroot->rootorder->CurrentValue;
			$casesroot->rootorder->CssStyle = "";
			$casesroot->rootorder->CssClass = "";
			$casesroot->rootorder->ViewCustomAttributes = "";

			// id
			$casesroot->id->HrefValue = "";

			// rootname
			$casesroot->rootname->HrefValue = "";

			// rootorder
			$casesroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$casesroot->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $casesroot;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($casesroot->ExportAll) {
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
		if ($casesroot->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($casesroot->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $casesroot->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $casesroot->Export);
				ew_ExportAddValue($sExportStr, 'rootname', $casesroot->Export);
				ew_ExportAddValue($sExportStr, 'rootorder', $casesroot->Export);
				echo ew_ExportLine($sExportStr, $casesroot->Export);
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
				$casesroot->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($casesroot->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $casesroot->id->CurrentValue);
					$XmlDoc->AddField('rootname', $casesroot->rootname->CurrentValue);
					$XmlDoc->AddField('rootorder', $casesroot->rootorder->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $casesroot->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $casesroot->id->ExportValue($casesroot->Export, $casesroot->ExportOriginalValue), $casesroot->Export);
						echo ew_ExportField('rootname', $casesroot->rootname->ExportValue($casesroot->Export, $casesroot->ExportOriginalValue), $casesroot->Export);
						echo ew_ExportField('rootorder', $casesroot->rootorder->ExportValue($casesroot->Export, $casesroot->ExportOriginalValue), $casesroot->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $casesroot->id->ExportValue($casesroot->Export, $casesroot->ExportOriginalValue), $casesroot->Export);
						ew_ExportAddValue($sExportStr, $casesroot->rootname->ExportValue($casesroot->Export, $casesroot->ExportOriginalValue), $casesroot->Export);
						ew_ExportAddValue($sExportStr, $casesroot->rootorder->ExportValue($casesroot->Export, $casesroot->ExportOriginalValue), $casesroot->Export);
						echo ew_ExportLine($sExportStr, $casesroot->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($casesroot->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($casesroot->Export);
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
