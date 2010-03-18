<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "friendlinkinfo.php" ?>
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
$friendlink_list = new cfriendlink_list();
$Page =& $friendlink_list;

// Page init processing
$friendlink_list->Page_Init();

// Page main processing
$friendlink_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($friendlink->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var friendlink_list = new ew_Page("friendlink_list");

// page properties
friendlink_list.PageID = "list"; // page ID
var EW_PAGE_ID = friendlink_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
friendlink_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
friendlink_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
friendlink_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($friendlink->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($friendlink->Export == "" && $friendlink->SelectLimit);
	if (!$bSelectLimit)
		$rs = $friendlink_list->LoadRecordset();
	$friendlink_list->lTotalRecs = ($bSelectLimit) ? $friendlink->SelectRecordCount() : $rs->RecordCount();
	$friendlink_list->lStartRec = 1;
	if ($friendlink_list->lDisplayRecs <= 0) // Display all records
		$friendlink_list->lDisplayRecs = $friendlink_list->lTotalRecs;
	if (!($friendlink->ExportAll && $friendlink->Export <> ""))
		$friendlink_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $friendlink_list->LoadRecordset($friendlink_list->lStartRec-1, $friendlink_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Friendlink
</span></p>
<?php if ($friendlink->Export == "" && $friendlink->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(friendlink_list);" style="text-decoration: none;"><img id="friendlink_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="friendlink_list_SearchPanel">
<form name="ffriendlinklistsrch" id="ffriendlinklistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="friendlink">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($friendlink->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $friendlink_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($friendlink->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($friendlink->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($friendlink->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $friendlink_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="ffriendlinklist" id="ffriendlinklist" class="ewForm" action="" method="post">
<?php if ($friendlink_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$friendlink_list->lOptionCnt = 0;
	$friendlink_list->lOptionCnt++; // view
	$friendlink_list->lOptionCnt++; // edit
	$friendlink_list->lOptionCnt++; // copy
	$friendlink_list->lOptionCnt++; // Delete
	$friendlink_list->lOptionCnt += count($friendlink_list->ListOptions->Items); // Custom list options
?>
<?php echo $friendlink->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($friendlink->id->Visible) { // id ?>
	<?php if ($friendlink->SortUrl($friendlink->id) == "") { ?>
		<td>链接ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $friendlink->SortUrl($friendlink->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>链接ID</td><td style="width: 10px;"><?php if ($friendlink->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($friendlink->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($friendlink->linkname->Visible) { // linkname ?>
	<?php if ($friendlink->SortUrl($friendlink->linkname) == "") { ?>
		<td>链接名</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $friendlink->SortUrl($friendlink->linkname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>链接名&nbsp;(*)</td><td style="width: 10px;"><?php if ($friendlink->linkname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($friendlink->linkname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($friendlink->linkorder->Visible) { // linkorder ?>
	<?php if ($friendlink->SortUrl($friendlink->linkorder) == "") { ?>
		<td>连接排序</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $friendlink->SortUrl($friendlink->linkorder) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>连接排序</td><td style="width: 10px;"><?php if ($friendlink->linkorder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($friendlink->linkorder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($friendlink->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($friendlink_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($friendlink->ExportAll && $friendlink->Export <> "") {
	$friendlink_list->lStopRec = $friendlink_list->lTotalRecs;
} else {
	$friendlink_list->lStopRec = $friendlink_list->lStartRec + $friendlink_list->lDisplayRecs - 1; // Set the last record to display
}
$friendlink_list->lRecCount = $friendlink_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$friendlink->SelectLimit && $friendlink_list->lStartRec > 1)
		$rs->Move($friendlink_list->lStartRec - 1);
}
$friendlink_list->lRowCnt = 0;
while (($friendlink->CurrentAction == "gridadd" || !$rs->EOF) &&
	$friendlink_list->lRecCount < $friendlink_list->lStopRec) {
	$friendlink_list->lRecCount++;
	if (intval($friendlink_list->lRecCount) >= intval($friendlink_list->lStartRec)) {
		$friendlink_list->lRowCnt++;

	// Init row class and style
	$friendlink->CssClass = "";
	$friendlink->CssStyle = "";
	$friendlink->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($friendlink->CurrentAction == "gridadd") {
		$friendlink_list->LoadDefaultValues(); // Load default values
	} else {
		$friendlink_list->LoadRowValues($rs); // Load row values
	}
	$friendlink->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$friendlink_list->RenderRow();
?>
	<tr<?php echo $friendlink->RowAttributes() ?>>
	<?php if ($friendlink->id->Visible) { // id ?>
		<td<?php echo $friendlink->id->CellAttributes() ?>>
<div<?php echo $friendlink->id->ViewAttributes() ?>><?php echo $friendlink->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($friendlink->linkname->Visible) { // linkname ?>
		<td<?php echo $friendlink->linkname->CellAttributes() ?>>
<div<?php echo $friendlink->linkname->ViewAttributes() ?>><?php echo $friendlink->linkname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($friendlink->linkorder->Visible) { // linkorder ?>
		<td<?php echo $friendlink->linkorder->CellAttributes() ?>>
<div<?php echo $friendlink->linkorder->ViewAttributes() ?>><?php echo $friendlink->linkorder->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($friendlink->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $friendlink->ViewUrl() ?>">查看</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $friendlink->EditUrl() ?>">编辑</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $friendlink->CopyUrl() ?>">复制</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $friendlink->DeleteUrl() ?>">删除</a>
</span></td>
<?php

// Custom list options
foreach ($friendlink_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($friendlink->CurrentAction <> "gridadd")
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
<?php if ($friendlink->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($friendlink->CurrentAction <> "gridadd" && $friendlink->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($friendlink_list->Pager)) $friendlink_list->Pager = new cPrevNextPager($friendlink_list->lStartRec, $friendlink_list->lDisplayRecs, $friendlink_list->lTotalRecs) ?>
<?php if ($friendlink_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($friendlink_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_list->PageUrl() ?>start=<?php echo $friendlink_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($friendlink_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_list->PageUrl() ?>start=<?php echo $friendlink_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $friendlink_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($friendlink_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_list->PageUrl() ?>start=<?php echo $friendlink_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($friendlink_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_list->PageUrl() ?>start=<?php echo $friendlink_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $friendlink_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $friendlink_list->Pager->FromIndex ?> 到 <?php echo $friendlink_list->Pager->ToIndex ?> 总共 <?php echo $friendlink_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($friendlink_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($friendlink_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $friendlink->AddUrl() ?>">添加</a>&nbsp;&nbsp;
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($friendlink->Export == "" && $friendlink->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(friendlink_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($friendlink->Export == "") { ?>
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
class cfriendlink_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'friendlink';

	// Page Object Name
	var $PageObjName = 'friendlink_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $friendlink;
		if ($friendlink->UseTokenInUrl) $PageUrl .= "t=" . $friendlink->TableVar . "&"; // add page token
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
		global $objForm, $friendlink;
		if ($friendlink->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($friendlink->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($friendlink->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cfriendlink_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["friendlink"] = new cfriendlink();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'friendlink', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $friendlink;
	$friendlink->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $friendlink->Export; // Get export parameter, used in header
	$gsExportFile = $friendlink->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $friendlink;
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
		if ($friendlink->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $friendlink->getRecordsPerPage(); // Restore from Session
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
		$friendlink->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$friendlink->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$friendlink->setStartRecordNumber($this->lStartRec);
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
		$friendlink->setSessionWhere($sFilter);
		$friendlink->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $friendlink;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $friendlink->linkname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $friendlink->linkaddress->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $friendlink;
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
			$friendlink->setBasicSearchKeyword($sSearchKeyword);
			$friendlink->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $friendlink;
		$this->sSrchWhere = "";
		$friendlink->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $friendlink;
		$friendlink->setBasicSearchKeyword("");
		$friendlink->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $friendlink;
		$this->sSrchWhere = $friendlink->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $friendlink;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$friendlink->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$friendlink->CurrentOrderType = @$_GET["ordertype"];
			$friendlink->UpdateSort($friendlink->id); // Field 
			$friendlink->UpdateSort($friendlink->linkname); // Field 
			$friendlink->UpdateSort($friendlink->linkorder); // Field 
			$friendlink->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $friendlink;
		$sOrderBy = $friendlink->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($friendlink->SqlOrderBy() <> "") {
				$sOrderBy = $friendlink->SqlOrderBy();
				$friendlink->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $friendlink;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$friendlink->setSessionOrderBy($sOrderBy);
				$friendlink->id->setSort("");
				$friendlink->linkname->setSort("");
				$friendlink->linkorder->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$friendlink->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $friendlink;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$friendlink->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$friendlink->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $friendlink->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$friendlink->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$friendlink->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$friendlink->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $friendlink;

		// Call Recordset Selecting event
		$friendlink->Recordset_Selecting($friendlink->CurrentFilter);

		// Load list page SQL
		$sSql = $friendlink->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$friendlink->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $friendlink;
		$sFilter = $friendlink->KeyFilter();

		// Call Row Selecting event
		$friendlink->Row_Selecting($sFilter);

		// Load sql based on filter
		$friendlink->CurrentFilter = $sFilter;
		$sSql = $friendlink->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$friendlink->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $friendlink;
		$friendlink->id->setDbValue($rs->fields('id'));
		$friendlink->linkname->setDbValue($rs->fields('linkname'));
		$friendlink->linkaddress->setDbValue($rs->fields('linkaddress'));
		$friendlink->linkorder->setDbValue($rs->fields('linkorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $friendlink;

		// Call Row_Rendering event
		$friendlink->Row_Rendering();

		// Common render codes for all row types
		// id

		$friendlink->id->CellCssStyle = "";
		$friendlink->id->CellCssClass = "";

		// linkname
		$friendlink->linkname->CellCssStyle = "";
		$friendlink->linkname->CellCssClass = "";

		// linkorder
		$friendlink->linkorder->CellCssStyle = "";
		$friendlink->linkorder->CellCssClass = "";
		if ($friendlink->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$friendlink->id->ViewValue = $friendlink->id->CurrentValue;
			$friendlink->id->CssStyle = "";
			$friendlink->id->CssClass = "";
			$friendlink->id->ViewCustomAttributes = "";

			// linkname
			$friendlink->linkname->ViewValue = $friendlink->linkname->CurrentValue;
			$friendlink->linkname->CssStyle = "";
			$friendlink->linkname->CssClass = "";
			$friendlink->linkname->ViewCustomAttributes = "";

			// linkorder
			$friendlink->linkorder->ViewValue = $friendlink->linkorder->CurrentValue;
			$friendlink->linkorder->CssStyle = "";
			$friendlink->linkorder->CssClass = "";
			$friendlink->linkorder->ViewCustomAttributes = "";

			// id
			$friendlink->id->HrefValue = "";

			// linkname
			$friendlink->linkname->HrefValue = "";

			// linkorder
			$friendlink->linkorder->HrefValue = "";
		}

		// Call Row Rendered event
		$friendlink->Row_Rendered();
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
