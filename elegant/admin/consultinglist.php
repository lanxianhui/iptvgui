<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "consultinginfo.php" ?>
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
$consulting_list = new cconsulting_list();
$Page =& $consulting_list;

// Page init processing
$consulting_list->Page_Init();

// Page main processing
$consulting_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($consulting->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var consulting_list = new ew_Page("consulting_list");

// page properties
consulting_list.PageID = "list"; // page ID
var EW_PAGE_ID = consulting_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
consulting_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
consulting_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consulting_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($consulting->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($consulting->Export == "" && $consulting->SelectLimit);
	if (!$bSelectLimit)
		$rs = $consulting_list->LoadRecordset();
	$consulting_list->lTotalRecs = ($bSelectLimit) ? $consulting->SelectRecordCount() : $rs->RecordCount();
	$consulting_list->lStartRec = 1;
	if ($consulting_list->lDisplayRecs <= 0) // Display all records
		$consulting_list->lDisplayRecs = $consulting_list->lTotalRecs;
	if (!($consulting->ExportAll && $consulting->Export <> ""))
		$consulting_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $consulting_list->LoadRecordset($consulting_list->lStartRec-1, $consulting_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Consulting
</span></p>
<?php if ($consulting->Export == "" && $consulting->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(consulting_list);" style="text-decoration: none;"><img id="consulting_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="consulting_list_SearchPanel">
<form name="fconsultinglistsrch" id="fconsultinglistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="consulting">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($consulting->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $consulting_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($consulting->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($consulting->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($consulting->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $consulting_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fconsultinglist" id="fconsultinglist" class="ewForm" action="" method="post">
<?php if ($consulting_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$consulting_list->lOptionCnt = 0;
	$consulting_list->lOptionCnt++; // view
	$consulting_list->lOptionCnt++; // edit
	$consulting_list->lOptionCnt++; // copy
	$consulting_list->lOptionCnt++; // Delete
	$consulting_list->lOptionCnt += count($consulting_list->ListOptions->Items); // Custom list options
?>
<?php echo $consulting->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($consulting->id->Visible) { // id ?>
	<?php if ($consulting->SortUrl($consulting->id) == "") { ?>
		<td>咨询ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consulting->SortUrl($consulting->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>咨询ID</td><td style="width: 10px;"><?php if ($consulting->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consulting->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($consulting->title->Visible) { // title ?>
	<?php if ($consulting->SortUrl($consulting->title) == "") { ?>
		<td>称呼</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consulting->SortUrl($consulting->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>称呼&nbsp;(*)</td><td style="width: 10px;"><?php if ($consulting->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consulting->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($consulting->company->Visible) { // company ?>
	<?php if ($consulting->SortUrl($consulting->company) == "") { ?>
		<td>公司</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consulting->SortUrl($consulting->company) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>公司&nbsp;(*)</td><td style="width: 10px;"><?php if ($consulting->company->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consulting->company->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($consulting->phone->Visible) { // phone ?>
	<?php if ($consulting->SortUrl($consulting->phone) == "") { ?>
		<td>电话</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consulting->SortUrl($consulting->phone) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>电话&nbsp;(*)</td><td style="width: 10px;"><?php if ($consulting->phone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consulting->phone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($consulting->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($consulting_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($consulting->ExportAll && $consulting->Export <> "") {
	$consulting_list->lStopRec = $consulting_list->lTotalRecs;
} else {
	$consulting_list->lStopRec = $consulting_list->lStartRec + $consulting_list->lDisplayRecs - 1; // Set the last record to display
}
$consulting_list->lRecCount = $consulting_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$consulting->SelectLimit && $consulting_list->lStartRec > 1)
		$rs->Move($consulting_list->lStartRec - 1);
}
$consulting_list->lRowCnt = 0;
while (($consulting->CurrentAction == "gridadd" || !$rs->EOF) &&
	$consulting_list->lRecCount < $consulting_list->lStopRec) {
	$consulting_list->lRecCount++;
	if (intval($consulting_list->lRecCount) >= intval($consulting_list->lStartRec)) {
		$consulting_list->lRowCnt++;

	// Init row class and style
	$consulting->CssClass = "";
	$consulting->CssStyle = "";
	$consulting->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($consulting->CurrentAction == "gridadd") {
		$consulting_list->LoadDefaultValues(); // Load default values
	} else {
		$consulting_list->LoadRowValues($rs); // Load row values
	}
	$consulting->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$consulting_list->RenderRow();
?>
	<tr<?php echo $consulting->RowAttributes() ?>>
	<?php if ($consulting->id->Visible) { // id ?>
		<td<?php echo $consulting->id->CellAttributes() ?>>
<div<?php echo $consulting->id->ViewAttributes() ?>><?php echo $consulting->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consulting->title->Visible) { // title ?>
		<td<?php echo $consulting->title->CellAttributes() ?>>
<div<?php echo $consulting->title->ViewAttributes() ?>><?php echo $consulting->title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consulting->company->Visible) { // company ?>
		<td<?php echo $consulting->company->CellAttributes() ?>>
<div<?php echo $consulting->company->ViewAttributes() ?>><?php echo $consulting->company->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consulting->phone->Visible) { // phone ?>
		<td<?php echo $consulting->phone->CellAttributes() ?>>
<div<?php echo $consulting->phone->ViewAttributes() ?>><?php echo $consulting->phone->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($consulting->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $consulting->ViewUrl() ?>">查看</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $consulting->EditUrl() ?>">编辑</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $consulting->CopyUrl() ?>">复制</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $consulting->DeleteUrl() ?>">删除</a>
</span></td>
<?php

// Custom list options
foreach ($consulting_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($consulting->CurrentAction <> "gridadd")
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
<?php if ($consulting->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($consulting->CurrentAction <> "gridadd" && $consulting->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($consulting_list->Pager)) $consulting_list->Pager = new cPrevNextPager($consulting_list->lStartRec, $consulting_list->lDisplayRecs, $consulting_list->lTotalRecs) ?>
<?php if ($consulting_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($consulting_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_list->PageUrl() ?>start=<?php echo $consulting_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($consulting_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_list->PageUrl() ?>start=<?php echo $consulting_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $consulting_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($consulting_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_list->PageUrl() ?>start=<?php echo $consulting_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($consulting_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_list->PageUrl() ?>start=<?php echo $consulting_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $consulting_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $consulting_list->Pager->FromIndex ?> 到 <?php echo $consulting_list->Pager->ToIndex ?> 总共 <?php echo $consulting_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($consulting_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($consulting_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $consulting->AddUrl() ?>">添加</a>&nbsp;&nbsp;
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($consulting->Export == "" && $consulting->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(consulting_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($consulting->Export == "") { ?>
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
class cconsulting_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'consulting';

	// Page Object Name
	var $PageObjName = 'consulting_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consulting;
		if ($consulting->UseTokenInUrl) $PageUrl .= "t=" . $consulting->TableVar . "&"; // add page token
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
		global $objForm, $consulting;
		if ($consulting->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($consulting->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consulting->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cconsulting_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["consulting"] = new cconsulting();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consulting', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $consulting;
	$consulting->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $consulting->Export; // Get export parameter, used in header
	$gsExportFile = $consulting->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $consulting;
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
		if ($consulting->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $consulting->getRecordsPerPage(); // Restore from Session
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
		$consulting->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$consulting->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$consulting->setStartRecordNumber($this->lStartRec);
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
		$consulting->setSessionWhere($sFilter);
		$consulting->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $consulting;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $consulting->title->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $consulting->company->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $consulting->phone->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $consulting->content->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $consulting;
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
			$consulting->setBasicSearchKeyword($sSearchKeyword);
			$consulting->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $consulting;
		$this->sSrchWhere = "";
		$consulting->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $consulting;
		$consulting->setBasicSearchKeyword("");
		$consulting->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $consulting;
		$this->sSrchWhere = $consulting->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $consulting;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$consulting->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$consulting->CurrentOrderType = @$_GET["ordertype"];
			$consulting->UpdateSort($consulting->id); // Field 
			$consulting->UpdateSort($consulting->title); // Field 
			$consulting->UpdateSort($consulting->company); // Field 
			$consulting->UpdateSort($consulting->phone); // Field 
			$consulting->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $consulting;
		$sOrderBy = $consulting->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($consulting->SqlOrderBy() <> "") {
				$sOrderBy = $consulting->SqlOrderBy();
				$consulting->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $consulting;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$consulting->setSessionOrderBy($sOrderBy);
				$consulting->id->setSort("");
				$consulting->title->setSort("");
				$consulting->company->setSort("");
				$consulting->phone->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$consulting->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $consulting;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$consulting->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$consulting->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $consulting->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$consulting->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$consulting->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$consulting->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $consulting;

		// Call Recordset Selecting event
		$consulting->Recordset_Selecting($consulting->CurrentFilter);

		// Load list page SQL
		$sSql = $consulting->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$consulting->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $consulting;
		$sFilter = $consulting->KeyFilter();

		// Call Row Selecting event
		$consulting->Row_Selecting($sFilter);

		// Load sql based on filter
		$consulting->CurrentFilter = $sFilter;
		$sSql = $consulting->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$consulting->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $consulting;
		$consulting->id->setDbValue($rs->fields('id'));
		$consulting->title->setDbValue($rs->fields('title'));
		$consulting->company->setDbValue($rs->fields('company'));
		$consulting->phone->setDbValue($rs->fields('phone'));
		$consulting->content->setDbValue($rs->fields('content'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $consulting;

		// Call Row_Rendering event
		$consulting->Row_Rendering();

		// Common render codes for all row types
		// id

		$consulting->id->CellCssStyle = "";
		$consulting->id->CellCssClass = "";

		// title
		$consulting->title->CellCssStyle = "";
		$consulting->title->CellCssClass = "";

		// company
		$consulting->company->CellCssStyle = "";
		$consulting->company->CellCssClass = "";

		// phone
		$consulting->phone->CellCssStyle = "";
		$consulting->phone->CellCssClass = "";
		if ($consulting->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consulting->id->ViewValue = $consulting->id->CurrentValue;
			$consulting->id->CssStyle = "";
			$consulting->id->CssClass = "";
			$consulting->id->ViewCustomAttributes = "";

			// title
			$consulting->title->ViewValue = $consulting->title->CurrentValue;
			$consulting->title->CssStyle = "";
			$consulting->title->CssClass = "";
			$consulting->title->ViewCustomAttributes = "";

			// company
			$consulting->company->ViewValue = $consulting->company->CurrentValue;
			$consulting->company->CssStyle = "";
			$consulting->company->CssClass = "";
			$consulting->company->ViewCustomAttributes = "";

			// phone
			$consulting->phone->ViewValue = $consulting->phone->CurrentValue;
			$consulting->phone->CssStyle = "";
			$consulting->phone->CssClass = "";
			$consulting->phone->ViewCustomAttributes = "";

			// id
			$consulting->id->HrefValue = "";

			// title
			$consulting->title->HrefValue = "";

			// company
			$consulting->company->HrefValue = "";

			// phone
			$consulting->phone->HrefValue = "";
		}

		// Call Row Rendered event
		$consulting->Row_Rendered();
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
