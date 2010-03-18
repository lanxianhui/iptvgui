<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$admin_list = new cadmin_list();
$Page =& $admin_list;

// Page init processing
$admin_list->Page_Init();

// Page main processing
$admin_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($admin->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var admin_list = new ew_Page("admin_list");

// page properties
admin_list.PageID = "list"; // page ID
var EW_PAGE_ID = admin_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
admin_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($admin->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($admin->Export == "" && $admin->SelectLimit);
	if (!$bSelectLimit)
		$rs = $admin_list->LoadRecordset();
	$admin_list->lTotalRecs = ($bSelectLimit) ? $admin->SelectRecordCount() : $rs->RecordCount();
	$admin_list->lStartRec = 1;
	if ($admin_list->lDisplayRecs <= 0) // Display all records
		$admin_list->lDisplayRecs = $admin_list->lTotalRecs;
	if (!($admin->ExportAll && $admin->Export <> ""))
		$admin_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $admin_list->LoadRecordset($admin_list->lStartRec-1, $admin_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Admin
</span></p>
<?php if ($admin->Export == "" && $admin->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(admin_list);" style="text-decoration: none;"><img id="admin_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="admin_list_SearchPanel">
<form name="fadminlistsrch" id="fadminlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="admin">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($admin->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $admin_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($admin->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($admin->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($admin->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $admin_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fadminlist" id="fadminlist" class="ewForm" action="" method="post">
<?php if ($admin_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$admin_list->lOptionCnt = 0;
	$admin_list->lOptionCnt++; // view
	$admin_list->lOptionCnt++; // edit
	$admin_list->lOptionCnt++; // copy
	$admin_list->lOptionCnt++; // Delete
	$admin_list->lOptionCnt += count($admin_list->ListOptions->Items); // Custom list options
?>
<?php echo $admin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($admin->id->Visible) { // id ?>
	<?php if ($admin->SortUrl($admin->id) == "") { ?>
		<td>账号ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>账号ID</td><td style="width: 10px;"><?php if ($admin->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($admin->usename->Visible) { // usename ?>
	<?php if ($admin->SortUrl($admin->usename) == "") { ?>
		<td>账号名称</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->usename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>账号名称&nbsp;(*)</td><td style="width: 10px;"><?php if ($admin->usename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->usename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($admin->usepass->Visible) { // usepass ?>
	<?php if ($admin->SortUrl($admin->usepass) == "") { ?>
		<td>账号密码</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->usepass) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>账号密码</td><td style="width: 10px;"><?php if ($admin->usepass->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->usepass->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($admin->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($admin_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($admin->ExportAll && $admin->Export <> "") {
	$admin_list->lStopRec = $admin_list->lTotalRecs;
} else {
	$admin_list->lStopRec = $admin_list->lStartRec + $admin_list->lDisplayRecs - 1; // Set the last record to display
}
$admin_list->lRecCount = $admin_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$admin->SelectLimit && $admin_list->lStartRec > 1)
		$rs->Move($admin_list->lStartRec - 1);
}
$admin_list->lRowCnt = 0;
while (($admin->CurrentAction == "gridadd" || !$rs->EOF) &&
	$admin_list->lRecCount < $admin_list->lStopRec) {
	$admin_list->lRecCount++;
	if (intval($admin_list->lRecCount) >= intval($admin_list->lStartRec)) {
		$admin_list->lRowCnt++;

	// Init row class and style
	$admin->CssClass = "";
	$admin->CssStyle = "";
	$admin->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($admin->CurrentAction == "gridadd") {
		$admin_list->LoadDefaultValues(); // Load default values
	} else {
		$admin_list->LoadRowValues($rs); // Load row values
	}
	$admin->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$admin_list->RenderRow();
?>
	<tr<?php echo $admin->RowAttributes() ?>>
	<?php if ($admin->id->Visible) { // id ?>
		<td<?php echo $admin->id->CellAttributes() ?>>
<div<?php echo $admin->id->ViewAttributes() ?>><?php echo $admin->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($admin->usename->Visible) { // usename ?>
		<td<?php echo $admin->usename->CellAttributes() ?>>
<div<?php echo $admin->usename->ViewAttributes() ?>><?php echo $admin->usename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($admin->usepass->Visible) { // usepass ?>
		<td<?php echo $admin->usepass->CellAttributes() ?>>
<div<?php echo $admin->usepass->ViewAttributes() ?>><?php echo $admin->usepass->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($admin->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $admin->ViewUrl() ?>">查看</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $admin->EditUrl() ?>">编辑</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $admin->CopyUrl() ?>">复制</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $admin->DeleteUrl() ?>">删除</a>
</span></td>
<?php

// Custom list options
foreach ($admin_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($admin->CurrentAction <> "gridadd")
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
<?php if ($admin->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($admin->CurrentAction <> "gridadd" && $admin->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($admin_list->Pager)) $admin_list->Pager = new cPrevNextPager($admin_list->lStartRec, $admin_list->lDisplayRecs, $admin_list->lTotalRecs) ?>
<?php if ($admin_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($admin_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($admin_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $admin_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($admin_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($admin_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $admin_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $admin_list->Pager->FromIndex ?> 到 <?php echo $admin_list->Pager->ToIndex ?> 总共 <?php echo $admin_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($admin_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($admin_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $admin->AddUrl() ?>">添加</a>&nbsp;&nbsp;
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($admin->Export == "" && $admin->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(admin_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($admin->Export == "") { ?>
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
class cadmin_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'admin';

	// Page Object Name
	var $PageObjName = 'admin_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $admin;
		if ($admin->UseTokenInUrl) $PageUrl .= "t=" . $admin->TableVar . "&"; // add page token
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
		global $objForm, $admin;
		if ($admin->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($admin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($admin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cadmin_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["admin"] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'admin', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $admin;
	$admin->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $admin->Export; // Get export parameter, used in header
	$gsExportFile = $admin->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $admin;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause

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
		if ($admin->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $admin->getRecordsPerPage(); // Restore from Session
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
		$admin->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$admin->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$admin->setStartRecordNumber($this->lStartRec);
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
		$admin->setSessionWhere($sFilter);
		$admin->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $admin;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $admin->usename->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $admin->usepass->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $admin;
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
			$admin->setBasicSearchKeyword($sSearchKeyword);
			$admin->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $admin;
		$this->sSrchWhere = "";
		$admin->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $admin;
		$admin->setBasicSearchKeyword("");
		$admin->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $admin;
		$this->sSrchWhere = $admin->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $admin;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$admin->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$admin->CurrentOrderType = @$_GET["ordertype"];
			$admin->UpdateSort($admin->id); // Field 
			$admin->UpdateSort($admin->usename); // Field 
			$admin->UpdateSort($admin->usepass); // Field 
			$admin->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $admin;
		$sOrderBy = $admin->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($admin->SqlOrderBy() <> "") {
				$sOrderBy = $admin->SqlOrderBy();
				$admin->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $admin;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$admin->setSessionOrderBy($sOrderBy);
				$admin->id->setSort("");
				$admin->usename->setSort("");
				$admin->usepass->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$admin->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $admin;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$admin->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$admin->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $admin->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$admin->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $admin;

		// Call Recordset Selecting event
		$admin->Recordset_Selecting($admin->CurrentFilter);

		// Load list page SQL
		$sSql = $admin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$admin->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $admin;
		$sFilter = $admin->KeyFilter();

		// Call Row Selecting event
		$admin->Row_Selecting($sFilter);

		// Load sql based on filter
		$admin->CurrentFilter = $sFilter;
		$sSql = $admin->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$admin->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $admin;
		$admin->id->setDbValue($rs->fields('id'));
		$admin->usename->setDbValue($rs->fields('usename'));
		$admin->usepass->setDbValue($rs->fields('usepass'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $admin;

		// Call Row_Rendering event
		$admin->Row_Rendering();

		// Common render codes for all row types
		// id

		$admin->id->CellCssStyle = "";
		$admin->id->CellCssClass = "";

		// usename
		$admin->usename->CellCssStyle = "";
		$admin->usename->CellCssClass = "";

		// usepass
		$admin->usepass->CellCssStyle = "";
		$admin->usepass->CellCssClass = "";
		if ($admin->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$admin->id->ViewValue = $admin->id->CurrentValue;
			$admin->id->CssStyle = "";
			$admin->id->CssClass = "";
			$admin->id->ViewCustomAttributes = "";

			// usename
			$admin->usename->ViewValue = $admin->usename->CurrentValue;
			$admin->usename->CssStyle = "";
			$admin->usename->CssClass = "";
			$admin->usename->ViewCustomAttributes = "";

			// usepass
			$admin->usepass->ViewValue = "********";
			$admin->usepass->CssStyle = "";
			$admin->usepass->CssClass = "";
			$admin->usepass->ViewCustomAttributes = "";

			// id
			$admin->id->HrefValue = "";

			// usename
			$admin->usename->HrefValue = "";

			// usepass
			$admin->usepass->HrefValue = "";
		}

		// Call Row Rendered event
		$admin->Row_Rendered();
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
