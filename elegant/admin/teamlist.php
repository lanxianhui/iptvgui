<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "teaminfo.php" ?>
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
$team_list = new cteam_list();
$Page =& $team_list;

// Page init processing
$team_list->Page_Init();

// Page main processing
$team_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($team->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var team_list = new ew_Page("team_list");

// page properties
team_list.PageID = "list"; // page ID
var EW_PAGE_ID = team_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
team_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
team_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
team_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
team_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($team->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($team->Export == "" && $team->SelectLimit);
	if (!$bSelectLimit)
		$rs = $team_list->LoadRecordset();
	$team_list->lTotalRecs = ($bSelectLimit) ? $team->SelectRecordCount() : $rs->RecordCount();
	$team_list->lStartRec = 1;
	if ($team_list->lDisplayRecs <= 0) // Display all records
		$team_list->lDisplayRecs = $team_list->lTotalRecs;
	if (!($team->ExportAll && $team->Export <> ""))
		$team_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $team_list->LoadRecordset($team_list->lStartRec-1, $team_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Team
<?php if ($team->Export == "" && $team->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $team_list->PageUrl() ?>export=html">导出到 HTML</a>
&nbsp;&nbsp;<a href="<?php echo $team_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $team_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($team->Export == "" && $team->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(team_list);" style="text-decoration: none;"><img id="team_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="team_list_SearchPanel">
<form name="fteamlistsrch" id="fteamlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="team">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($team->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $team_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($team->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($team->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($team->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $team_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fteamlist" id="fteamlist" class="ewForm" action="" method="post">
<?php if ($team_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$team_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$team_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$team_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$team_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$team_list->lOptionCnt++; // Multi-select
}
	$team_list->lOptionCnt += count($team_list->ListOptions->Items); // Custom list options
?>
<?php echo $team->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($team->id->Visible) { // id ?>
	<?php if ($team->SortUrl($team->id) == "") { ?>
		<td>成员ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $team->SortUrl($team->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>成员ID</td><td style="width: 10px;"><?php if ($team->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($team->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($team->teamname->Visible) { // teamname ?>
	<?php if ($team->SortUrl($team->teamname) == "") { ?>
		<td>成员名称</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $team->SortUrl($team->teamname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>成员名称&nbsp;(*)</td><td style="width: 10px;"><?php if ($team->teamname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($team->teamname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($team->teamjobs->Visible) { // teamjobs ?>
	<?php if ($team->SortUrl($team->teamjobs) == "") { ?>
		<td>成员职位</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $team->SortUrl($team->teamjobs) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>成员职位&nbsp;(*)</td><td style="width: 10px;"><?php if ($team->teamjobs->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($team->teamjobs->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($team->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="team_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($team_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($team->ExportAll && $team->Export <> "") {
	$team_list->lStopRec = $team_list->lTotalRecs;
} else {
	$team_list->lStopRec = $team_list->lStartRec + $team_list->lDisplayRecs - 1; // Set the last record to display
}
$team_list->lRecCount = $team_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$team->SelectLimit && $team_list->lStartRec > 1)
		$rs->Move($team_list->lStartRec - 1);
}
$team_list->lRowCnt = 0;
while (($team->CurrentAction == "gridadd" || !$rs->EOF) &&
	$team_list->lRecCount < $team_list->lStopRec) {
	$team_list->lRecCount++;
	if (intval($team_list->lRecCount) >= intval($team_list->lStartRec)) {
		$team_list->lRowCnt++;

	// Init row class and style
	$team->CssClass = "";
	$team->CssStyle = "";
	$team->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($team->CurrentAction == "gridadd") {
		$team_list->LoadDefaultValues(); // Load default values
	} else {
		$team_list->LoadRowValues($rs); // Load row values
	}
	$team->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$team_list->RenderRow();
?>
	<tr<?php echo $team->RowAttributes() ?>>
	<?php if ($team->id->Visible) { // id ?>
		<td<?php echo $team->id->CellAttributes() ?>>
<div<?php echo $team->id->ViewAttributes() ?>><?php echo $team->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($team->teamname->Visible) { // teamname ?>
		<td<?php echo $team->teamname->CellAttributes() ?>>
<div<?php echo $team->teamname->ViewAttributes() ?>><?php echo $team->teamname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($team->teamjobs->Visible) { // teamjobs ?>
		<td<?php echo $team->teamjobs->CellAttributes() ?>>
<div<?php echo $team->teamjobs->ViewAttributes() ?>><?php echo $team->teamjobs->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($team->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $team->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $team->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $team->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($team->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($team_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($team->CurrentAction <> "gridadd")
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
<?php if ($team->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($team->CurrentAction <> "gridadd" && $team->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($team_list->Pager)) $team_list->Pager = new cPrevNextPager($team_list->lStartRec, $team_list->lDisplayRecs, $team_list->lTotalRecs) ?>
<?php if ($team_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($team_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $team_list->PageUrl() ?>start=<?php echo $team_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($team_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $team_list->PageUrl() ?>start=<?php echo $team_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $team_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($team_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $team_list->PageUrl() ?>start=<?php echo $team_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($team_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $team_list->PageUrl() ?>start=<?php echo $team_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $team_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $team_list->Pager->FromIndex ?> 到 <?php echo $team_list->Pager->ToIndex ?> 总共 <?php echo $team_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($team_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($team_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $team->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($team_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fteamlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $team_list->sDeleteConfirmMsg ?>')) {document.fteamlist.action='teamdelete.php';document.fteamlist.encoding='application/x-www-form-urlencoded';document.fteamlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($team->Export == "" && $team->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(team_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($team->Export == "") { ?>
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
class cteam_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'team';

	// Page Object Name
	var $PageObjName = 'team_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $team;
		if ($team->UseTokenInUrl) $PageUrl .= "t=" . $team->TableVar . "&"; // add page token
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
		global $objForm, $team;
		if ($team->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($team->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($team->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cteam_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["team"] = new cteam();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'team', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $team;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$team->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $team->Export; // Get export parameter, used in header
	$gsExportFile = $team->TableVar; // Get export file, used in header
	if ($team->Export == "print" || $team->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($team->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($team->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $team;
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
		if ($team->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $team->getRecordsPerPage(); // Restore from Session
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
		$team->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$team->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$team->setStartRecordNumber($this->lStartRec);
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
		$team->setSessionWhere($sFilter);
		$team->CurrentFilter = "";

		// Export data only
		if (in_array($team->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $team;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $team->teamname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $team->teampic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $team->teamjobs->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $team->teamdesc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $team;
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
			$team->setBasicSearchKeyword($sSearchKeyword);
			$team->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $team;
		$this->sSrchWhere = "";
		$team->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $team;
		$team->setBasicSearchKeyword("");
		$team->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $team;
		$this->sSrchWhere = $team->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $team;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$team->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$team->CurrentOrderType = @$_GET["ordertype"];
			$team->UpdateSort($team->id); // Field 
			$team->UpdateSort($team->teamname); // Field 
			$team->UpdateSort($team->teamjobs); // Field 
			$team->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $team;
		$sOrderBy = $team->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($team->SqlOrderBy() <> "") {
				$sOrderBy = $team->SqlOrderBy();
				$team->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $team;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$team->setSessionOrderBy($sOrderBy);
				$team->id->setSort("");
				$team->teamname->setSort("");
				$team->teamjobs->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$team->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $team;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$team->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$team->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $team->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$team->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$team->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$team->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $team;

		// Call Recordset Selecting event
		$team->Recordset_Selecting($team->CurrentFilter);

		// Load list page SQL
		$sSql = $team->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$team->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $team;
		$sFilter = $team->KeyFilter();

		// Call Row Selecting event
		$team->Row_Selecting($sFilter);

		// Load sql based on filter
		$team->CurrentFilter = $sFilter;
		$sSql = $team->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$team->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $team;
		$team->id->setDbValue($rs->fields('id'));
		$team->teamname->setDbValue($rs->fields('teamname'));
		$team->teampic->Upload->DbValue = $rs->fields('teampic');
		$team->teamjobs->setDbValue($rs->fields('teamjobs'));
		$team->teamdesc->setDbValue($rs->fields('teamdesc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $team;

		// Call Row_Rendering event
		$team->Row_Rendering();

		// Common render codes for all row types
		// id

		$team->id->CellCssStyle = "";
		$team->id->CellCssClass = "";

		// teamname
		$team->teamname->CellCssStyle = "";
		$team->teamname->CellCssClass = "";

		// teamjobs
		$team->teamjobs->CellCssStyle = "";
		$team->teamjobs->CellCssClass = "";
		if ($team->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$team->id->ViewValue = $team->id->CurrentValue;
			$team->id->CssStyle = "";
			$team->id->CssClass = "";
			$team->id->ViewCustomAttributes = "";

			// teamname
			$team->teamname->ViewValue = $team->teamname->CurrentValue;
			$team->teamname->CssStyle = "";
			$team->teamname->CssClass = "";
			$team->teamname->ViewCustomAttributes = "";

			// teamjobs
			$team->teamjobs->ViewValue = $team->teamjobs->CurrentValue;
			$team->teamjobs->CssStyle = "";
			$team->teamjobs->CssClass = "";
			$team->teamjobs->ViewCustomAttributes = "";

			// id
			$team->id->HrefValue = "";

			// teamname
			$team->teamname->HrefValue = "";

			// teamjobs
			$team->teamjobs->HrefValue = "";
		}

		// Call Row Rendered event
		$team->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $team;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($team->ExportAll) {
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
		if ($team->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($team->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $team->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $team->Export);
				ew_ExportAddValue($sExportStr, 'teamname', $team->Export);
				ew_ExportAddValue($sExportStr, 'teamjobs', $team->Export);
				echo ew_ExportLine($sExportStr, $team->Export);
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
				$team->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($team->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $team->id->CurrentValue);
					$XmlDoc->AddField('teamname', $team->teamname->CurrentValue);
					$XmlDoc->AddField('teamjobs', $team->teamjobs->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $team->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $team->id->ExportValue($team->Export, $team->ExportOriginalValue), $team->Export);
						echo ew_ExportField('teamname', $team->teamname->ExportValue($team->Export, $team->ExportOriginalValue), $team->Export);
						echo ew_ExportField('teamjobs', $team->teamjobs->ExportValue($team->Export, $team->ExportOriginalValue), $team->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $team->id->ExportValue($team->Export, $team->ExportOriginalValue), $team->Export);
						ew_ExportAddValue($sExportStr, $team->teamname->ExportValue($team->Export, $team->ExportOriginalValue), $team->Export);
						ew_ExportAddValue($sExportStr, $team->teamjobs->ExportValue($team->Export, $team->ExportOriginalValue), $team->Export);
						echo ew_ExportLine($sExportStr, $team->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($team->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($team->Export);
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
