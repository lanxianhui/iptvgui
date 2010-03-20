<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicecatinfo.php" ?>
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
$servicecat_list = new cservicecat_list();
$Page =& $servicecat_list;

// Page init processing
$servicecat_list->Page_Init();

// Page main processing
$servicecat_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($servicecat->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var servicecat_list = new ew_Page("servicecat_list");

// page properties
servicecat_list.PageID = "list"; // page ID
var EW_PAGE_ID = servicecat_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
servicecat_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
servicecat_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
servicecat_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
servicecat_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($servicecat->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($servicecat->Export == "" && $servicecat->SelectLimit);
	if (!$bSelectLimit)
		$rs = $servicecat_list->LoadRecordset();
	$servicecat_list->lTotalRecs = ($bSelectLimit) ? $servicecat->SelectRecordCount() : $rs->RecordCount();
	$servicecat_list->lStartRec = 1;
	if ($servicecat_list->lDisplayRecs <= 0) // Display all records
		$servicecat_list->lDisplayRecs = $servicecat_list->lTotalRecs;
	if (!($servicecat->ExportAll && $servicecat->Export <> ""))
		$servicecat_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $servicecat_list->LoadRecordset($servicecat_list->lStartRec-1, $servicecat_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Servicecat
<?php if ($servicecat->Export == "" && $servicecat->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $servicecat_list->PageUrl() ?>export=html">导出到 HTML</a>
&nbsp;&nbsp;<a href="<?php echo $servicecat_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $servicecat_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($servicecat->Export == "" && $servicecat->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(servicecat_list);" style="text-decoration: none;"><img id="servicecat_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="servicecat_list_SearchPanel">
<form name="fservicecatlistsrch" id="fservicecatlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="servicecat">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($servicecat->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $servicecat_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($servicecat->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($servicecat->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($servicecat->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $servicecat_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($servicecat->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($servicecat->CurrentAction <> "gridadd" && $servicecat->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($servicecat_list->Pager)) $servicecat_list->Pager = new cPrevNextPager($servicecat_list->lStartRec, $servicecat_list->lDisplayRecs, $servicecat_list->lTotalRecs) ?>
<?php if ($servicecat_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($servicecat_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $servicecat_list->PageUrl() ?>start=<?php echo $servicecat_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($servicecat_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $servicecat_list->PageUrl() ?>start=<?php echo $servicecat_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $servicecat_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($servicecat_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $servicecat_list->PageUrl() ?>start=<?php echo $servicecat_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($servicecat_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $servicecat_list->PageUrl() ?>start=<?php echo $servicecat_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $servicecat_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $servicecat_list->Pager->FromIndex ?> 到 <?php echo $servicecat_list->Pager->ToIndex ?> 总共 <?php echo $servicecat_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($servicecat_list->sSrchWhere == "0=101") { ?>
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
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $servicecat->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($servicecat_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fservicecatlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $servicecat_list->sDeleteConfirmMsg ?>')) {document.fservicecatlist.action='servicecatdelete.php';document.fservicecatlist.encoding='application/x-www-form-urlencoded';document.fservicecatlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fservicecatlist" id="fservicecatlist" class="ewForm" action="" method="post">
<?php if ($servicecat_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$servicecat_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$servicecat_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$servicecat_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$servicecat_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$servicecat_list->lOptionCnt++; // Multi-select
}
	$servicecat_list->lOptionCnt += count($servicecat_list->ListOptions->Items); // Custom list options
?>
<?php echo $servicecat->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($servicecat->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="servicecat_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($servicecat_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($servicecat->id->Visible) { // id ?>
	<?php if ($servicecat->SortUrl($servicecat->id) == "") { ?>
		<td>类型ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $servicecat->SortUrl($servicecat->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>类型ID</td><td style="width: 10px;"><?php if ($servicecat->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($servicecat->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($servicecat->catname->Visible) { // catname ?>
	<?php if ($servicecat->SortUrl($servicecat->catname) == "") { ?>
		<td>类型名字</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $servicecat->SortUrl($servicecat->catname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>类型名字&nbsp;(*)</td><td style="width: 10px;"><?php if ($servicecat->catname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($servicecat->catname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($servicecat->rootid->Visible) { // rootid ?>
	<?php if ($servicecat->SortUrl($servicecat->rootid) == "") { ?>
		<td>所属根类型</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $servicecat->SortUrl($servicecat->rootid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>所属根类型</td><td style="width: 10px;"><?php if ($servicecat->rootid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($servicecat->rootid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($servicecat->catorder->Visible) { // catorder ?>
	<?php if ($servicecat->SortUrl($servicecat->catorder) == "") { ?>
		<td>类型排序</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $servicecat->SortUrl($servicecat->catorder) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>类型排序</td><td style="width: 10px;"><?php if ($servicecat->catorder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($servicecat->catorder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($servicecat->ExportAll && $servicecat->Export <> "") {
	$servicecat_list->lStopRec = $servicecat_list->lTotalRecs;
} else {
	$servicecat_list->lStopRec = $servicecat_list->lStartRec + $servicecat_list->lDisplayRecs - 1; // Set the last record to display
}
$servicecat_list->lRecCount = $servicecat_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$servicecat->SelectLimit && $servicecat_list->lStartRec > 1)
		$rs->Move($servicecat_list->lStartRec - 1);
}
$servicecat_list->lRowCnt = 0;
while (($servicecat->CurrentAction == "gridadd" || !$rs->EOF) &&
	$servicecat_list->lRecCount < $servicecat_list->lStopRec) {
	$servicecat_list->lRecCount++;
	if (intval($servicecat_list->lRecCount) >= intval($servicecat_list->lStartRec)) {
		$servicecat_list->lRowCnt++;

	// Init row class and style
	$servicecat->CssClass = "";
	$servicecat->CssStyle = "";
	$servicecat->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($servicecat->CurrentAction == "gridadd") {
		$servicecat_list->LoadDefaultValues(); // Load default values
	} else {
		$servicecat_list->LoadRowValues($rs); // Load row values
	}
	$servicecat->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$servicecat_list->RenderRow();
?>
	<tr<?php echo $servicecat->RowAttributes() ?>>
<?php if ($servicecat->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $servicecat->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $servicecat->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $servicecat->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($servicecat->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($servicecat_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($servicecat->id->Visible) { // id ?>
		<td<?php echo $servicecat->id->CellAttributes() ?>>
<div<?php echo $servicecat->id->ViewAttributes() ?>><?php echo $servicecat->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($servicecat->catname->Visible) { // catname ?>
		<td<?php echo $servicecat->catname->CellAttributes() ?>>
<div<?php echo $servicecat->catname->ViewAttributes() ?>><?php echo $servicecat->catname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($servicecat->rootid->Visible) { // rootid ?>
		<td<?php echo $servicecat->rootid->CellAttributes() ?>>
<div<?php echo $servicecat->rootid->ViewAttributes() ?>><?php echo $servicecat->rootid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($servicecat->catorder->Visible) { // catorder ?>
		<td<?php echo $servicecat->catorder->CellAttributes() ?>>
<div<?php echo $servicecat->catorder->ViewAttributes() ?>><?php echo $servicecat->catorder->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($servicecat->CurrentAction <> "gridadd")
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
</td></tr></table>
<?php if ($servicecat->Export == "" && $servicecat->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(servicecat_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($servicecat->Export == "") { ?>
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
class cservicecat_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'servicecat';

	// Page Object Name
	var $PageObjName = 'servicecat_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $servicecat;
		if ($servicecat->UseTokenInUrl) $PageUrl .= "t=" . $servicecat->TableVar . "&"; // add page token
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
		global $objForm, $servicecat;
		if ($servicecat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($servicecat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($servicecat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservicecat_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["servicecat"] = new cservicecat();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'servicecat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $servicecat;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$servicecat->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $servicecat->Export; // Get export parameter, used in header
	$gsExportFile = $servicecat->TableVar; // Get export file, used in header
	if ($servicecat->Export == "print" || $servicecat->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($servicecat->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($servicecat->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $servicecat;
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
		if ($servicecat->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $servicecat->getRecordsPerPage(); // Restore from Session
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
		$servicecat->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$servicecat->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$servicecat->setStartRecordNumber($this->lStartRec);
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
		$servicecat->setSessionWhere($sFilter);
		$servicecat->CurrentFilter = "";

		// Export data only
		if (in_array($servicecat->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $servicecat;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $servicecat->catname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $servicecat->catdesc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $servicecat;
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
			$servicecat->setBasicSearchKeyword($sSearchKeyword);
			$servicecat->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $servicecat;
		$this->sSrchWhere = "";
		$servicecat->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $servicecat;
		$servicecat->setBasicSearchKeyword("");
		$servicecat->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $servicecat;
		$this->sSrchWhere = $servicecat->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $servicecat;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$servicecat->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$servicecat->CurrentOrderType = @$_GET["ordertype"];
			$servicecat->UpdateSort($servicecat->id); // Field 
			$servicecat->UpdateSort($servicecat->catname); // Field 
			$servicecat->UpdateSort($servicecat->rootid); // Field 
			$servicecat->UpdateSort($servicecat->catorder); // Field 
			$servicecat->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $servicecat;
		$sOrderBy = $servicecat->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($servicecat->SqlOrderBy() <> "") {
				$sOrderBy = $servicecat->SqlOrderBy();
				$servicecat->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $servicecat;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$servicecat->setSessionOrderBy($sOrderBy);
				$servicecat->id->setSort("");
				$servicecat->catname->setSort("");
				$servicecat->rootid->setSort("");
				$servicecat->catorder->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$servicecat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $servicecat;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$servicecat->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$servicecat->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $servicecat->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$servicecat->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$servicecat->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$servicecat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $servicecat;

		// Call Recordset Selecting event
		$servicecat->Recordset_Selecting($servicecat->CurrentFilter);

		// Load list page SQL
		$sSql = $servicecat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$servicecat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $servicecat;
		$sFilter = $servicecat->KeyFilter();

		// Call Row Selecting event
		$servicecat->Row_Selecting($sFilter);

		// Load sql based on filter
		$servicecat->CurrentFilter = $sFilter;
		$sSql = $servicecat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$servicecat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $servicecat;
		$servicecat->id->setDbValue($rs->fields('id'));
		$servicecat->catname->setDbValue($rs->fields('catname'));
		$servicecat->rootid->setDbValue($rs->fields('rootid'));
		$servicecat->catdesc->setDbValue($rs->fields('catdesc'));
		$servicecat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $servicecat;

		// Call Row_Rendering event
		$servicecat->Row_Rendering();

		// Common render codes for all row types
		// id

		$servicecat->id->CellCssStyle = "";
		$servicecat->id->CellCssClass = "";

		// catname
		$servicecat->catname->CellCssStyle = "";
		$servicecat->catname->CellCssClass = "";

		// rootid
		$servicecat->rootid->CellCssStyle = "";
		$servicecat->rootid->CellCssClass = "";

		// catorder
		$servicecat->catorder->CellCssStyle = "";
		$servicecat->catorder->CellCssClass = "";
		if ($servicecat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$servicecat->id->ViewValue = $servicecat->id->CurrentValue;
			$servicecat->id->CssStyle = "";
			$servicecat->id->CssClass = "";
			$servicecat->id->ViewCustomAttributes = "";

			// catname
			$servicecat->catname->ViewValue = $servicecat->catname->CurrentValue;
			$servicecat->catname->CssStyle = "";
			$servicecat->catname->CssClass = "";
			$servicecat->catname->ViewCustomAttributes = "";

			// rootid
			$servicecat->rootid->ViewValue = $servicecat->rootid->CurrentValue;
			$servicecat->rootid->CssStyle = "";
			$servicecat->rootid->CssClass = "";
			$servicecat->rootid->ViewCustomAttributes = "";

			// catorder
			$servicecat->catorder->ViewValue = $servicecat->catorder->CurrentValue;
			$servicecat->catorder->CssStyle = "";
			$servicecat->catorder->CssClass = "";
			$servicecat->catorder->ViewCustomAttributes = "";

			// id
			$servicecat->id->HrefValue = "";

			// catname
			$servicecat->catname->HrefValue = "";

			// rootid
			$servicecat->rootid->HrefValue = "";

			// catorder
			$servicecat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$servicecat->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $servicecat;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($servicecat->ExportAll) {
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
		if ($servicecat->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($servicecat->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $servicecat->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $servicecat->Export);
				ew_ExportAddValue($sExportStr, 'catname', $servicecat->Export);
				ew_ExportAddValue($sExportStr, 'rootid', $servicecat->Export);
				ew_ExportAddValue($sExportStr, 'catorder', $servicecat->Export);
				echo ew_ExportLine($sExportStr, $servicecat->Export);
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
				$servicecat->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($servicecat->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $servicecat->id->CurrentValue);
					$XmlDoc->AddField('catname', $servicecat->catname->CurrentValue);
					$XmlDoc->AddField('rootid', $servicecat->rootid->CurrentValue);
					$XmlDoc->AddField('catorder', $servicecat->catorder->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $servicecat->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $servicecat->id->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
						echo ew_ExportField('catname', $servicecat->catname->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
						echo ew_ExportField('rootid', $servicecat->rootid->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
						echo ew_ExportField('catorder', $servicecat->catorder->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $servicecat->id->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
						ew_ExportAddValue($sExportStr, $servicecat->catname->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
						ew_ExportAddValue($sExportStr, $servicecat->rootid->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
						ew_ExportAddValue($sExportStr, $servicecat->catorder->ExportValue($servicecat->Export, $servicecat->ExportOriginalValue), $servicecat->Export);
						echo ew_ExportLine($sExportStr, $servicecat->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($servicecat->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($servicecat->Export);
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
