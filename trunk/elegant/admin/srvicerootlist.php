<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "srvicerootinfo.php" ?>
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
$srviceroot_list = new csrviceroot_list();
$Page =& $srviceroot_list;

// Page init processing
$srviceroot_list->Page_Init();

// Page main processing
$srviceroot_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($srviceroot->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var srviceroot_list = new ew_Page("srviceroot_list");

// page properties
srviceroot_list.PageID = "list"; // page ID
var EW_PAGE_ID = srviceroot_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
srviceroot_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
srviceroot_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
srviceroot_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($srviceroot->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($srviceroot->Export == "" && $srviceroot->SelectLimit);
	if (!$bSelectLimit)
		$rs = $srviceroot_list->LoadRecordset();
	$srviceroot_list->lTotalRecs = ($bSelectLimit) ? $srviceroot->SelectRecordCount() : $rs->RecordCount();
	$srviceroot_list->lStartRec = 1;
	if ($srviceroot_list->lDisplayRecs <= 0) // Display all records
		$srviceroot_list->lDisplayRecs = $srviceroot_list->lTotalRecs;
	if (!($srviceroot->ExportAll && $srviceroot->Export <> ""))
		$srviceroot_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $srviceroot_list->LoadRecordset($srviceroot_list->lStartRec-1, $srviceroot_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Srviceroot
</span></p>
<?php if ($srviceroot->Export == "" && $srviceroot->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(srviceroot_list);" style="text-decoration: none;"><img id="srviceroot_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="srviceroot_list_SearchPanel">
<form name="fsrvicerootlistsrch" id="fsrvicerootlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="srviceroot">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($srviceroot->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $srviceroot_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($srviceroot->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($srviceroot->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($srviceroot->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $srviceroot_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fsrvicerootlist" id="fsrvicerootlist" class="ewForm" action="" method="post">
<?php if ($srviceroot_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$srviceroot_list->lOptionCnt = 0;
	$srviceroot_list->lOptionCnt++; // view
	$srviceroot_list->lOptionCnt++; // edit
	$srviceroot_list->lOptionCnt++; // copy
	$srviceroot_list->lOptionCnt++; // Delete
	$srviceroot_list->lOptionCnt += count($srviceroot_list->ListOptions->Items); // Custom list options
?>
<?php echo $srviceroot->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($srviceroot->id->Visible) { // id ?>
	<?php if ($srviceroot->SortUrl($srviceroot->id) == "") { ?>
		<td>根ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $srviceroot->SortUrl($srviceroot->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根ID</td><td style="width: 10px;"><?php if ($srviceroot->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($srviceroot->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($srviceroot->rootname->Visible) { // rootname ?>
	<?php if ($srviceroot->SortUrl($srviceroot->rootname) == "") { ?>
		<td>根类型名</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $srviceroot->SortUrl($srviceroot->rootname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类型名&nbsp;(*)</td><td style="width: 10px;"><?php if ($srviceroot->rootname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($srviceroot->rootname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($srviceroot->rootorder->Visible) { // rootorder ?>
	<?php if ($srviceroot->SortUrl($srviceroot->rootorder) == "") { ?>
		<td>根类型排序</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $srviceroot->SortUrl($srviceroot->rootorder) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类型排序</td><td style="width: 10px;"><?php if ($srviceroot->rootorder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($srviceroot->rootorder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($srviceroot->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($srviceroot_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($srviceroot->ExportAll && $srviceroot->Export <> "") {
	$srviceroot_list->lStopRec = $srviceroot_list->lTotalRecs;
} else {
	$srviceroot_list->lStopRec = $srviceroot_list->lStartRec + $srviceroot_list->lDisplayRecs - 1; // Set the last record to display
}
$srviceroot_list->lRecCount = $srviceroot_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$srviceroot->SelectLimit && $srviceroot_list->lStartRec > 1)
		$rs->Move($srviceroot_list->lStartRec - 1);
}
$srviceroot_list->lRowCnt = 0;
while (($srviceroot->CurrentAction == "gridadd" || !$rs->EOF) &&
	$srviceroot_list->lRecCount < $srviceroot_list->lStopRec) {
	$srviceroot_list->lRecCount++;
	if (intval($srviceroot_list->lRecCount) >= intval($srviceroot_list->lStartRec)) {
		$srviceroot_list->lRowCnt++;

	// Init row class and style
	$srviceroot->CssClass = "";
	$srviceroot->CssStyle = "";
	$srviceroot->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($srviceroot->CurrentAction == "gridadd") {
		$srviceroot_list->LoadDefaultValues(); // Load default values
	} else {
		$srviceroot_list->LoadRowValues($rs); // Load row values
	}
	$srviceroot->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$srviceroot_list->RenderRow();
?>
	<tr<?php echo $srviceroot->RowAttributes() ?>>
	<?php if ($srviceroot->id->Visible) { // id ?>
		<td<?php echo $srviceroot->id->CellAttributes() ?>>
<div<?php echo $srviceroot->id->ViewAttributes() ?>><?php echo $srviceroot->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($srviceroot->rootname->Visible) { // rootname ?>
		<td<?php echo $srviceroot->rootname->CellAttributes() ?>>
<div<?php echo $srviceroot->rootname->ViewAttributes() ?>><?php echo $srviceroot->rootname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($srviceroot->rootorder->Visible) { // rootorder ?>
		<td<?php echo $srviceroot->rootorder->CellAttributes() ?>>
<div<?php echo $srviceroot->rootorder->ViewAttributes() ?>><?php echo $srviceroot->rootorder->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($srviceroot->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $srviceroot->ViewUrl() ?>">查看</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $srviceroot->EditUrl() ?>">编辑</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $srviceroot->CopyUrl() ?>">复制</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $srviceroot->DeleteUrl() ?>">删除</a>
</span></td>
<?php

// Custom list options
foreach ($srviceroot_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($srviceroot->CurrentAction <> "gridadd")
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
<?php if ($srviceroot->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($srviceroot->CurrentAction <> "gridadd" && $srviceroot->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($srviceroot_list->Pager)) $srviceroot_list->Pager = new cPrevNextPager($srviceroot_list->lStartRec, $srviceroot_list->lDisplayRecs, $srviceroot_list->lTotalRecs) ?>
<?php if ($srviceroot_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($srviceroot_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $srviceroot_list->PageUrl() ?>start=<?php echo $srviceroot_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($srviceroot_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $srviceroot_list->PageUrl() ?>start=<?php echo $srviceroot_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $srviceroot_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($srviceroot_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $srviceroot_list->PageUrl() ?>start=<?php echo $srviceroot_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($srviceroot_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $srviceroot_list->PageUrl() ?>start=<?php echo $srviceroot_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $srviceroot_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $srviceroot_list->Pager->FromIndex ?> 到 <?php echo $srviceroot_list->Pager->ToIndex ?> 总共 <?php echo $srviceroot_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($srviceroot_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($srviceroot_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $srviceroot->AddUrl() ?>">添加</a>&nbsp;&nbsp;
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($srviceroot->Export == "" && $srviceroot->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(srviceroot_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($srviceroot->Export == "") { ?>
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
class csrviceroot_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'srviceroot';

	// Page Object Name
	var $PageObjName = 'srviceroot_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $srviceroot;
		if ($srviceroot->UseTokenInUrl) $PageUrl .= "t=" . $srviceroot->TableVar . "&"; // add page token
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
		global $objForm, $srviceroot;
		if ($srviceroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($srviceroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($srviceroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function csrviceroot_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["srviceroot"] = new csrviceroot();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'srviceroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $srviceroot;
	$srviceroot->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $srviceroot->Export; // Get export parameter, used in header
	$gsExportFile = $srviceroot->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $srviceroot;
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
		if ($srviceroot->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $srviceroot->getRecordsPerPage(); // Restore from Session
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
		$srviceroot->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$srviceroot->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$srviceroot->setStartRecordNumber($this->lStartRec);
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
		$srviceroot->setSessionWhere($sFilter);
		$srviceroot->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $srviceroot;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $srviceroot->rootname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $srviceroot;
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
			$srviceroot->setBasicSearchKeyword($sSearchKeyword);
			$srviceroot->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $srviceroot;
		$this->sSrchWhere = "";
		$srviceroot->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $srviceroot;
		$srviceroot->setBasicSearchKeyword("");
		$srviceroot->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $srviceroot;
		$this->sSrchWhere = $srviceroot->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $srviceroot;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$srviceroot->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$srviceroot->CurrentOrderType = @$_GET["ordertype"];
			$srviceroot->UpdateSort($srviceroot->id); // Field 
			$srviceroot->UpdateSort($srviceroot->rootname); // Field 
			$srviceroot->UpdateSort($srviceroot->rootorder); // Field 
			$srviceroot->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $srviceroot;
		$sOrderBy = $srviceroot->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($srviceroot->SqlOrderBy() <> "") {
				$sOrderBy = $srviceroot->SqlOrderBy();
				$srviceroot->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $srviceroot;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$srviceroot->setSessionOrderBy($sOrderBy);
				$srviceroot->id->setSort("");
				$srviceroot->rootname->setSort("");
				$srviceroot->rootorder->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$srviceroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $srviceroot;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$srviceroot->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$srviceroot->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $srviceroot->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$srviceroot->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$srviceroot->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$srviceroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $srviceroot;

		// Call Recordset Selecting event
		$srviceroot->Recordset_Selecting($srviceroot->CurrentFilter);

		// Load list page SQL
		$sSql = $srviceroot->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$srviceroot->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $srviceroot;
		$sFilter = $srviceroot->KeyFilter();

		// Call Row Selecting event
		$srviceroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$srviceroot->CurrentFilter = $sFilter;
		$sSql = $srviceroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$srviceroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $srviceroot;
		$srviceroot->id->setDbValue($rs->fields('id'));
		$srviceroot->rootname->setDbValue($rs->fields('rootname'));
		$srviceroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $srviceroot;

		// Call Row_Rendering event
		$srviceroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$srviceroot->id->CellCssStyle = "";
		$srviceroot->id->CellCssClass = "";

		// rootname
		$srviceroot->rootname->CellCssStyle = "";
		$srviceroot->rootname->CellCssClass = "";

		// rootorder
		$srviceroot->rootorder->CellCssStyle = "";
		$srviceroot->rootorder->CellCssClass = "";
		if ($srviceroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$srviceroot->id->ViewValue = $srviceroot->id->CurrentValue;
			$srviceroot->id->CssStyle = "";
			$srviceroot->id->CssClass = "";
			$srviceroot->id->ViewCustomAttributes = "";

			// rootname
			$srviceroot->rootname->ViewValue = $srviceroot->rootname->CurrentValue;
			$srviceroot->rootname->CssStyle = "";
			$srviceroot->rootname->CssClass = "";
			$srviceroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$srviceroot->rootorder->ViewValue = $srviceroot->rootorder->CurrentValue;
			$srviceroot->rootorder->CssStyle = "";
			$srviceroot->rootorder->CssClass = "";
			$srviceroot->rootorder->ViewCustomAttributes = "";

			// id
			$srviceroot->id->HrefValue = "";

			// rootname
			$srviceroot->rootname->HrefValue = "";

			// rootorder
			$srviceroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$srviceroot->Row_Rendered();
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
