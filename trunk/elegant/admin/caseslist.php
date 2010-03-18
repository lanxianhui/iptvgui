<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesinfo.php" ?>
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
$cases_list = new ccases_list();
$Page =& $cases_list;

// Page init processing
$cases_list->Page_Init();

// Page main processing
$cases_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cases->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cases_list = new ew_Page("cases_list");

// page properties
cases_list.PageID = "list"; // page ID
var EW_PAGE_ID = cases_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cases_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cases_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cases_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($cases->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($cases->Export == "" && $cases->SelectLimit);
	if (!$bSelectLimit)
		$rs = $cases_list->LoadRecordset();
	$cases_list->lTotalRecs = ($bSelectLimit) ? $cases->SelectRecordCount() : $rs->RecordCount();
	$cases_list->lStartRec = 1;
	if ($cases_list->lDisplayRecs <= 0) // Display all records
		$cases_list->lDisplayRecs = $cases_list->lTotalRecs;
	if (!($cases->ExportAll && $cases->Export <> ""))
		$cases_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $cases_list->LoadRecordset($cases_list->lStartRec-1, $cases_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Cases
</span></p>
<?php if ($cases->Export == "" && $cases->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(cases_list);" style="text-decoration: none;"><img id="cases_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="cases_list_SearchPanel">
<form name="fcaseslistsrch" id="fcaseslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="cases">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($cases->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $cases_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($cases->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($cases->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($cases->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $cases_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fcaseslist" id="fcaseslist" class="ewForm" action="" method="post">
<?php if ($cases_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$cases_list->lOptionCnt = 0;
	$cases_list->lOptionCnt++; // view
	$cases_list->lOptionCnt++; // edit
	$cases_list->lOptionCnt++; // copy
	$cases_list->lOptionCnt++; // Delete
	$cases_list->lOptionCnt += count($cases_list->ListOptions->Items); // Custom list options
?>
<?php echo $cases->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($cases->id->Visible) { // id ?>
	<?php if ($cases->SortUrl($cases->id) == "") { ?>
		<td>案例ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cases->SortUrl($cases->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>案例ID</td><td style="width: 10px;"><?php if ($cases->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cases->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cases->casetitle->Visible) { // casetitle ?>
	<?php if ($cases->SortUrl($cases->casetitle) == "") { ?>
		<td>案例标题</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cases->SortUrl($cases->casetitle) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>案例标题&nbsp;(*)</td><td style="width: 10px;"><?php if ($cases->casetitle->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cases->casetitle->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cases->catid->Visible) { // catid ?>
	<?php if ($cases->SortUrl($cases->catid) == "") { ?>
		<td>案例类型</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cases->SortUrl($cases->catid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>案例类型</td><td style="width: 10px;"><?php if ($cases->catid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cases->catid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cases->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($cases_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($cases->ExportAll && $cases->Export <> "") {
	$cases_list->lStopRec = $cases_list->lTotalRecs;
} else {
	$cases_list->lStopRec = $cases_list->lStartRec + $cases_list->lDisplayRecs - 1; // Set the last record to display
}
$cases_list->lRecCount = $cases_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$cases->SelectLimit && $cases_list->lStartRec > 1)
		$rs->Move($cases_list->lStartRec - 1);
}
$cases_list->lRowCnt = 0;
while (($cases->CurrentAction == "gridadd" || !$rs->EOF) &&
	$cases_list->lRecCount < $cases_list->lStopRec) {
	$cases_list->lRecCount++;
	if (intval($cases_list->lRecCount) >= intval($cases_list->lStartRec)) {
		$cases_list->lRowCnt++;

	// Init row class and style
	$cases->CssClass = "";
	$cases->CssStyle = "";
	$cases->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($cases->CurrentAction == "gridadd") {
		$cases_list->LoadDefaultValues(); // Load default values
	} else {
		$cases_list->LoadRowValues($rs); // Load row values
	}
	$cases->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$cases_list->RenderRow();
?>
	<tr<?php echo $cases->RowAttributes() ?>>
	<?php if ($cases->id->Visible) { // id ?>
		<td<?php echo $cases->id->CellAttributes() ?>>
<div<?php echo $cases->id->ViewAttributes() ?>><?php echo $cases->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cases->casetitle->Visible) { // casetitle ?>
		<td<?php echo $cases->casetitle->CellAttributes() ?>>
<div<?php echo $cases->casetitle->ViewAttributes() ?>><?php echo $cases->casetitle->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cases->catid->Visible) { // catid ?>
		<td<?php echo $cases->catid->CellAttributes() ?>>
<div<?php echo $cases->catid->ViewAttributes() ?>><?php echo $cases->catid->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($cases->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cases->ViewUrl() ?>">查看</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cases->EditUrl() ?>">编辑</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cases->CopyUrl() ?>">复制</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cases->DeleteUrl() ?>">删除</a>
</span></td>
<?php

// Custom list options
foreach ($cases_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($cases->CurrentAction <> "gridadd")
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
<?php if ($cases->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($cases->CurrentAction <> "gridadd" && $cases->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($cases_list->Pager)) $cases_list->Pager = new cPrevNextPager($cases_list->lStartRec, $cases_list->lDisplayRecs, $cases_list->lTotalRecs) ?>
<?php if ($cases_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($cases_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $cases_list->PageUrl() ?>start=<?php echo $cases_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($cases_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $cases_list->PageUrl() ?>start=<?php echo $cases_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cases_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($cases_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $cases_list->PageUrl() ?>start=<?php echo $cases_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($cases_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $cases_list->PageUrl() ?>start=<?php echo $cases_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $cases_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $cases_list->Pager->FromIndex ?> 到 <?php echo $cases_list->Pager->ToIndex ?> 总共 <?php echo $cases_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($cases_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($cases_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $cases->AddUrl() ?>">添加</a>&nbsp;&nbsp;
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($cases->Export == "" && $cases->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(cases_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($cases->Export == "") { ?>
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
class ccases_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'cases';

	// Page Object Name
	var $PageObjName = 'cases_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cases;
		if ($cases->UseTokenInUrl) $PageUrl .= "t=" . $cases->TableVar . "&"; // add page token
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
		global $objForm, $cases;
		if ($cases->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cases->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cases->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccases_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["cases"] = new ccases();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cases', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cases;
	$cases->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $cases->Export; // Get export parameter, used in header
	$gsExportFile = $cases->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $cases;
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
		if ($cases->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $cases->getRecordsPerPage(); // Restore from Session
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
		$cases->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$cases->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$cases->setStartRecordNumber($this->lStartRec);
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
		$cases->setSessionWhere($sFilter);
		$cases->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $cases;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $cases->casetitle->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cases->casepic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cases->casedesc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $cases;
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
			$cases->setBasicSearchKeyword($sSearchKeyword);
			$cases->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $cases;
		$this->sSrchWhere = "";
		$cases->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $cases;
		$cases->setBasicSearchKeyword("");
		$cases->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $cases;
		$this->sSrchWhere = $cases->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $cases;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$cases->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$cases->CurrentOrderType = @$_GET["ordertype"];
			$cases->UpdateSort($cases->id); // Field 
			$cases->UpdateSort($cases->casetitle); // Field 
			$cases->UpdateSort($cases->catid); // Field 
			$cases->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $cases;
		$sOrderBy = $cases->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($cases->SqlOrderBy() <> "") {
				$sOrderBy = $cases->SqlOrderBy();
				$cases->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $cases;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$cases->setSessionOrderBy($sOrderBy);
				$cases->id->setSort("");
				$cases->casetitle->setSort("");
				$cases->catid->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$cases->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $cases;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$cases->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$cases->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $cases->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$cases->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$cases->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$cases->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cases;

		// Call Recordset Selecting event
		$cases->Recordset_Selecting($cases->CurrentFilter);

		// Load list page SQL
		$sSql = $cases->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cases->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cases;
		$sFilter = $cases->KeyFilter();

		// Call Row Selecting event
		$cases->Row_Selecting($sFilter);

		// Load sql based on filter
		$cases->CurrentFilter = $sFilter;
		$sSql = $cases->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cases->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cases;
		$cases->id->setDbValue($rs->fields('id'));
		$cases->casetitle->setDbValue($rs->fields('casetitle'));
		$cases->casepic->Upload->DbValue = $rs->fields('casepic');
		$cases->casedesc->setDbValue($rs->fields('casedesc'));
		$cases->catid->setDbValue($rs->fields('catid'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cases;

		// Call Row_Rendering event
		$cases->Row_Rendering();

		// Common render codes for all row types
		// id

		$cases->id->CellCssStyle = "";
		$cases->id->CellCssClass = "";

		// casetitle
		$cases->casetitle->CellCssStyle = "";
		$cases->casetitle->CellCssClass = "";

		// catid
		$cases->catid->CellCssStyle = "";
		$cases->catid->CellCssClass = "";
		if ($cases->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cases->id->ViewValue = $cases->id->CurrentValue;
			$cases->id->CssStyle = "";
			$cases->id->CssClass = "";
			$cases->id->ViewCustomAttributes = "";

			// casetitle
			$cases->casetitle->ViewValue = $cases->casetitle->CurrentValue;
			$cases->casetitle->CssStyle = "";
			$cases->casetitle->CssClass = "";
			$cases->casetitle->ViewCustomAttributes = "";

			// catid
			if (strval($cases->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `casescat` WHERE `id` = " . ew_AdjustSql($cases->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cases->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$cases->catid->ViewValue = $cases->catid->CurrentValue;
				}
			} else {
				$cases->catid->ViewValue = NULL;
			}
			$cases->catid->CssStyle = "";
			$cases->catid->CssClass = "";
			$cases->catid->ViewCustomAttributes = "";

			// id
			$cases->id->HrefValue = "";

			// casetitle
			$cases->casetitle->HrefValue = "";

			// catid
			$cases->catid->HrefValue = "";
		}

		// Call Row Rendered event
		$cases->Row_Rendered();
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
