<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newscatinfo.php" ?>
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
$newscat_list = new cnewscat_list();
$Page =& $newscat_list;

// Page init processing
$newscat_list->Page_Init();

// Page main processing
$newscat_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($newscat->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var newscat_list = new ew_Page("newscat_list");

// page properties
newscat_list.PageID = "list"; // page ID
var EW_PAGE_ID = newscat_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
newscat_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
newscat_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
newscat_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
newscat_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($newscat->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($newscat->Export == "" && $newscat->SelectLimit);
	if (!$bSelectLimit)
		$rs = $newscat_list->LoadRecordset();
	$newscat_list->lTotalRecs = ($bSelectLimit) ? $newscat->SelectRecordCount() : $rs->RecordCount();
	$newscat_list->lStartRec = 1;
	if ($newscat_list->lDisplayRecs <= 0) // Display all records
		$newscat_list->lDisplayRecs = $newscat_list->lTotalRecs;
	if (!($newscat->ExportAll && $newscat->Export <> ""))
		$newscat_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $newscat_list->LoadRecordset($newscat_list->lStartRec-1, $newscat_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Newscat
<?php if ($newscat->Export == "" && $newscat->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $newscat_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $newscat_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $newscat_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($newscat->Export == "" && $newscat->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(newscat_list);" style="text-decoration: none;"><img id="newscat_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="newscat_list_SearchPanel">
<form name="fnewscatlistsrch" id="fnewscatlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="newscat">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($newscat->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $newscat_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($newscat->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($newscat->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($newscat->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $newscat_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fnewscatlist" id="fnewscatlist" class="ewForm" action="" method="post">
<?php if ($newscat_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$newscat_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$newscat_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$newscat_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$newscat_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$newscat_list->lOptionCnt++; // Multi-select
}
	$newscat_list->lOptionCnt += count($newscat_list->ListOptions->Items); // Custom list options
?>
<?php echo $newscat->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($newscat->id->Visible) { // id ?>
	<?php if ($newscat->SortUrl($newscat->id) == "") { ?>
		<td>类型ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $newscat->SortUrl($newscat->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>类型ID</td><td style="width: 10px;"><?php if ($newscat->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($newscat->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($newscat->catname->Visible) { // catname ?>
	<?php if ($newscat->SortUrl($newscat->catname) == "") { ?>
		<td>类型名称</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $newscat->SortUrl($newscat->catname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>类型名称&nbsp;(*)</td><td style="width: 10px;"><?php if ($newscat->catname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($newscat->catname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($newscat->catorder->Visible) { // catorder ?>
	<?php if ($newscat->SortUrl($newscat->catorder) == "") { ?>
		<td>类型排序</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $newscat->SortUrl($newscat->catorder) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>类型排序</td><td style="width: 10px;"><?php if ($newscat->catorder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($newscat->catorder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($newscat->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="newscat_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($newscat_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($newscat->ExportAll && $newscat->Export <> "") {
	$newscat_list->lStopRec = $newscat_list->lTotalRecs;
} else {
	$newscat_list->lStopRec = $newscat_list->lStartRec + $newscat_list->lDisplayRecs - 1; // Set the last record to display
}
$newscat_list->lRecCount = $newscat_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$newscat->SelectLimit && $newscat_list->lStartRec > 1)
		$rs->Move($newscat_list->lStartRec - 1);
}
$newscat_list->lRowCnt = 0;
while (($newscat->CurrentAction == "gridadd" || !$rs->EOF) &&
	$newscat_list->lRecCount < $newscat_list->lStopRec) {
	$newscat_list->lRecCount++;
	if (intval($newscat_list->lRecCount) >= intval($newscat_list->lStartRec)) {
		$newscat_list->lRowCnt++;

	// Init row class and style
	$newscat->CssClass = "";
	$newscat->CssStyle = "";
	$newscat->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($newscat->CurrentAction == "gridadd") {
		$newscat_list->LoadDefaultValues(); // Load default values
	} else {
		$newscat_list->LoadRowValues($rs); // Load row values
	}
	$newscat->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$newscat_list->RenderRow();
?>
	<tr<?php echo $newscat->RowAttributes() ?>>
	<?php if ($newscat->id->Visible) { // id ?>
		<td<?php echo $newscat->id->CellAttributes() ?>>
<div<?php echo $newscat->id->ViewAttributes() ?>><?php echo $newscat->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($newscat->catname->Visible) { // catname ?>
		<td<?php echo $newscat->catname->CellAttributes() ?>>
<div<?php echo $newscat->catname->ViewAttributes() ?>><?php echo $newscat->catname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($newscat->catorder->Visible) { // catorder ?>
		<td<?php echo $newscat->catorder->CellAttributes() ?>>
<div<?php echo $newscat->catorder->ViewAttributes() ?>><?php echo $newscat->catorder->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($newscat->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $newscat->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $newscat->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $newscat->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($newscat->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($newscat_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($newscat->CurrentAction <> "gridadd")
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
<?php if ($newscat->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($newscat->CurrentAction <> "gridadd" && $newscat->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($newscat_list->Pager)) $newscat_list->Pager = new cPrevNextPager($newscat_list->lStartRec, $newscat_list->lDisplayRecs, $newscat_list->lTotalRecs) ?>
<?php if ($newscat_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($newscat_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $newscat_list->PageUrl() ?>start=<?php echo $newscat_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($newscat_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $newscat_list->PageUrl() ?>start=<?php echo $newscat_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $newscat_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($newscat_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $newscat_list->PageUrl() ?>start=<?php echo $newscat_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($newscat_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $newscat_list->PageUrl() ?>start=<?php echo $newscat_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $newscat_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $newscat_list->Pager->FromIndex ?> 到 <?php echo $newscat_list->Pager->ToIndex ?> 总共 <?php echo $newscat_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($newscat_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($newscat_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $newscat->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($newscat_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fnewscatlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $newscat_list->sDeleteConfirmMsg ?>')) {document.fnewscatlist.action='newscatdelete.php';document.fnewscatlist.encoding='application/x-www-form-urlencoded';document.fnewscatlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($newscat->Export == "" && $newscat->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(newscat_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($newscat->Export == "") { ?>
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
class cnewscat_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'newscat';

	// Page Object Name
	var $PageObjName = 'newscat_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $newscat;
		if ($newscat->UseTokenInUrl) $PageUrl .= "t=" . $newscat->TableVar . "&"; // add page token
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
		global $objForm, $newscat;
		if ($newscat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($newscat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($newscat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnewscat_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["newscat"] = new cnewscat();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'newscat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $newscat;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$newscat->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $newscat->Export; // Get export parameter, used in header
	$gsExportFile = $newscat->TableVar; // Get export file, used in header
	if ($newscat->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($newscat->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($newscat->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $newscat;
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
		if ($newscat->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $newscat->getRecordsPerPage(); // Restore from Session
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
		$newscat->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$newscat->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$newscat->setStartRecordNumber($this->lStartRec);
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
		$newscat->setSessionWhere($sFilter);
		$newscat->CurrentFilter = "";

		// Export data only
		if (in_array($newscat->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $newscat;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $newscat->catname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $newscat;
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
			$newscat->setBasicSearchKeyword($sSearchKeyword);
			$newscat->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $newscat;
		$this->sSrchWhere = "";
		$newscat->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $newscat;
		$newscat->setBasicSearchKeyword("");
		$newscat->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $newscat;
		$this->sSrchWhere = $newscat->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $newscat;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$newscat->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$newscat->CurrentOrderType = @$_GET["ordertype"];
			$newscat->UpdateSort($newscat->id); // Field 
			$newscat->UpdateSort($newscat->catname); // Field 
			$newscat->UpdateSort($newscat->catorder); // Field 
			$newscat->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $newscat;
		$sOrderBy = $newscat->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($newscat->SqlOrderBy() <> "") {
				$sOrderBy = $newscat->SqlOrderBy();
				$newscat->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $newscat;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$newscat->setSessionOrderBy($sOrderBy);
				$newscat->id->setSort("");
				$newscat->catname->setSort("");
				$newscat->catorder->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$newscat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $newscat;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$newscat->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$newscat->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $newscat->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$newscat->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$newscat->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$newscat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $newscat;

		// Call Recordset Selecting event
		$newscat->Recordset_Selecting($newscat->CurrentFilter);

		// Load list page SQL
		$sSql = $newscat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$newscat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $newscat;
		$sFilter = $newscat->KeyFilter();

		// Call Row Selecting event
		$newscat->Row_Selecting($sFilter);

		// Load sql based on filter
		$newscat->CurrentFilter = $sFilter;
		$sSql = $newscat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$newscat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $newscat;
		$newscat->id->setDbValue($rs->fields('id'));
		$newscat->catname->setDbValue($rs->fields('catname'));
		$newscat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $newscat;

		// Call Row_Rendering event
		$newscat->Row_Rendering();

		// Common render codes for all row types
		// id

		$newscat->id->CellCssStyle = "";
		$newscat->id->CellCssClass = "";

		// catname
		$newscat->catname->CellCssStyle = "";
		$newscat->catname->CellCssClass = "";

		// catorder
		$newscat->catorder->CellCssStyle = "";
		$newscat->catorder->CellCssClass = "";
		if ($newscat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$newscat->id->ViewValue = $newscat->id->CurrentValue;
			$newscat->id->CssStyle = "";
			$newscat->id->CssClass = "";
			$newscat->id->ViewCustomAttributes = "";

			// catname
			$newscat->catname->ViewValue = $newscat->catname->CurrentValue;
			$newscat->catname->CssStyle = "";
			$newscat->catname->CssClass = "";
			$newscat->catname->ViewCustomAttributes = "";

			// catorder
			$newscat->catorder->ViewValue = $newscat->catorder->CurrentValue;
			$newscat->catorder->CssStyle = "";
			$newscat->catorder->CssClass = "";
			$newscat->catorder->ViewCustomAttributes = "";

			// id
			$newscat->id->HrefValue = "";

			// catname
			$newscat->catname->HrefValue = "";

			// catorder
			$newscat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$newscat->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $newscat;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($newscat->ExportAll) {
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
		if ($newscat->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($newscat->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $newscat->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $newscat->Export);
				ew_ExportAddValue($sExportStr, 'catname', $newscat->Export);
				ew_ExportAddValue($sExportStr, 'catorder', $newscat->Export);
				echo ew_ExportLine($sExportStr, $newscat->Export);
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
				$newscat->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($newscat->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $newscat->id->CurrentValue);
					$XmlDoc->AddField('catname', $newscat->catname->CurrentValue);
					$XmlDoc->AddField('catorder', $newscat->catorder->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $newscat->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $newscat->id->ExportValue($newscat->Export, $newscat->ExportOriginalValue), $newscat->Export);
						echo ew_ExportField('catname', $newscat->catname->ExportValue($newscat->Export, $newscat->ExportOriginalValue), $newscat->Export);
						echo ew_ExportField('catorder', $newscat->catorder->ExportValue($newscat->Export, $newscat->ExportOriginalValue), $newscat->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $newscat->id->ExportValue($newscat->Export, $newscat->ExportOriginalValue), $newscat->Export);
						ew_ExportAddValue($sExportStr, $newscat->catname->ExportValue($newscat->Export, $newscat->ExportOriginalValue), $newscat->Export);
						ew_ExportAddValue($sExportStr, $newscat->catorder->ExportValue($newscat->Export, $newscat->ExportOriginalValue), $newscat->Export);
						echo ew_ExportLine($sExportStr, $newscat->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($newscat->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($newscat->Export);
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
