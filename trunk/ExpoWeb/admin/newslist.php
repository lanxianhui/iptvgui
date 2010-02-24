<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newsinfo.php" ?>
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
$news_list = new cnews_list();
$Page =& $news_list;

// Page init processing
$news_list->Page_Init();

// Page main processing
$news_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($news->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var news_list = new ew_Page("news_list");

// page properties
news_list.PageID = "list"; // page ID
var EW_PAGE_ID = news_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
news_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
news_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
news_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
news_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($news->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($news->Export == "" && $news->SelectLimit);
	if (!$bSelectLimit)
		$rs = $news_list->LoadRecordset();
	$news_list->lTotalRecs = ($bSelectLimit) ? $news->SelectRecordCount() : $rs->RecordCount();
	$news_list->lStartRec = 1;
	if ($news_list->lDisplayRecs <= 0) // Display all records
		$news_list->lDisplayRecs = $news_list->lTotalRecs;
	if (!($news->ExportAll && $news->Export <> ""))
		$news_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $news_list->LoadRecordset($news_list->lStartRec-1, $news_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: News
<?php if ($news->Export == "" && $news->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $news_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $news_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $news_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($news->Export == "" && $news->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(news_list);" style="text-decoration: none;"><img id="news_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="news_list_SearchPanel">
<form name="fnewslistsrch" id="fnewslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="news">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($news->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $news_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($news->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($news->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($news->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $news_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fnewslist" id="fnewslist" class="ewForm" action="" method="post">
<?php if ($news_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$news_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$news_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$news_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$news_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$news_list->lOptionCnt++; // Multi-select
}
	$news_list->lOptionCnt += count($news_list->ListOptions->Items); // Custom list options
?>
<?php echo $news->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($news->id->Visible) { // id ?>
	<?php if ($news->SortUrl($news->id) == "") { ?>
		<td>新闻ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>新闻ID</td><td style="width: 10px;"><?php if ($news->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->catid->Visible) { // catid ?>
	<?php if ($news->SortUrl($news->catid) == "") { ?>
		<td>新闻类型</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->catid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>新闻类型</td><td style="width: 10px;"><?php if ($news->catid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->catid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->newstitle->Visible) { // newstitle ?>
	<?php if ($news->SortUrl($news->newstitle) == "") { ?>
		<td>新闻标题</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->newstitle) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>新闻标题&nbsp;(*)</td><td style="width: 10px;"><?php if ($news->newstitle->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->newstitle->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->pubtime->Visible) { // pubtime ?>
	<?php if ($news->SortUrl($news->pubtime) == "") { ?>
		<td>发布时间</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->pubtime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>发布时间</td><td style="width: 10px;"><?php if ($news->pubtime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->pubtime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="news_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($news_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($news->ExportAll && $news->Export <> "") {
	$news_list->lStopRec = $news_list->lTotalRecs;
} else {
	$news_list->lStopRec = $news_list->lStartRec + $news_list->lDisplayRecs - 1; // Set the last record to display
}
$news_list->lRecCount = $news_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$news->SelectLimit && $news_list->lStartRec > 1)
		$rs->Move($news_list->lStartRec - 1);
}
$news_list->lRowCnt = 0;
while (($news->CurrentAction == "gridadd" || !$rs->EOF) &&
	$news_list->lRecCount < $news_list->lStopRec) {
	$news_list->lRecCount++;
	if (intval($news_list->lRecCount) >= intval($news_list->lStartRec)) {
		$news_list->lRowCnt++;

	// Init row class and style
	$news->CssClass = "";
	$news->CssStyle = "";
	$news->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($news->CurrentAction == "gridadd") {
		$news_list->LoadDefaultValues(); // Load default values
	} else {
		$news_list->LoadRowValues($rs); // Load row values
	}
	$news->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$news_list->RenderRow();
?>
	<tr<?php echo $news->RowAttributes() ?>>
	<?php if ($news->id->Visible) { // id ?>
		<td<?php echo $news->id->CellAttributes() ?>>
<div<?php echo $news->id->ViewAttributes() ?>><?php echo $news->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($news->catid->Visible) { // catid ?>
		<td<?php echo $news->catid->CellAttributes() ?>>
<div<?php echo $news->catid->ViewAttributes() ?>><?php echo $news->catid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($news->newstitle->Visible) { // newstitle ?>
		<td<?php echo $news->newstitle->CellAttributes() ?>>
<div<?php echo $news->newstitle->ViewAttributes() ?>><?php echo $news->newstitle->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($news->pubtime->Visible) { // pubtime ?>
		<td<?php echo $news->pubtime->CellAttributes() ?>>
<div<?php echo $news->pubtime->ViewAttributes() ?>><?php echo $news->pubtime->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($news->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $news->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $news->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $news->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($news->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($news_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($news->CurrentAction <> "gridadd")
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
<?php if ($news->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($news->CurrentAction <> "gridadd" && $news->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($news_list->Pager)) $news_list->Pager = new cPrevNextPager($news_list->lStartRec, $news_list->lDisplayRecs, $news_list->lTotalRecs) ?>
<?php if ($news_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($news_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($news_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $news_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($news_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($news_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $news_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $news_list->Pager->FromIndex ?> 到 <?php echo $news_list->Pager->ToIndex ?> 总共 <?php echo $news_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($news_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($news_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $news->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($news_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fnewslist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $news_list->sDeleteConfirmMsg ?>')) {document.fnewslist.action='newsdelete.php';document.fnewslist.encoding='application/x-www-form-urlencoded';document.fnewslist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($news->Export == "" && $news->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(news_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($news->Export == "") { ?>
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
class cnews_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'news';

	// Page Object Name
	var $PageObjName = 'news_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $news;
		if ($news->UseTokenInUrl) $PageUrl .= "t=" . $news->TableVar . "&"; // add page token
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
		global $objForm, $news;
		if ($news->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($news->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($news->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnews_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["news"] = new cnews();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'news', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $news;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$news->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $news->Export; // Get export parameter, used in header
	$gsExportFile = $news->TableVar; // Get export file, used in header
	if ($news->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($news->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($news->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $news;
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
		if ($news->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $news->getRecordsPerPage(); // Restore from Session
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
		$news->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$news->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$news->setStartRecordNumber($this->lStartRec);
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
		$news->setSessionWhere($sFilter);
		$news->CurrentFilter = "";

		// Export data only
		if (in_array($news->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $news;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $news->newstitle->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $news->newsdesc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $news->newsimg->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $news;
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
			$news->setBasicSearchKeyword($sSearchKeyword);
			$news->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $news;
		$this->sSrchWhere = "";
		$news->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $news;
		$news->setBasicSearchKeyword("");
		$news->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $news;
		$this->sSrchWhere = $news->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $news;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$news->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$news->CurrentOrderType = @$_GET["ordertype"];
			$news->UpdateSort($news->id); // Field 
			$news->UpdateSort($news->catid); // Field 
			$news->UpdateSort($news->newstitle); // Field 
			$news->UpdateSort($news->pubtime); // Field 
			$news->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $news;
		$sOrderBy = $news->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($news->SqlOrderBy() <> "") {
				$sOrderBy = $news->SqlOrderBy();
				$news->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $news;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$news->setSessionOrderBy($sOrderBy);
				$news->id->setSort("");
				$news->catid->setSort("");
				$news->newstitle->setSort("");
				$news->pubtime->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$news->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $news;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$news->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$news->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $news->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$news->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $news;

		// Call Recordset Selecting event
		$news->Recordset_Selecting($news->CurrentFilter);

		// Load list page SQL
		$sSql = $news->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$news->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $news;
		$sFilter = $news->KeyFilter();

		// Call Row Selecting event
		$news->Row_Selecting($sFilter);

		// Load sql based on filter
		$news->CurrentFilter = $sFilter;
		$sSql = $news->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$news->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $news;
		$news->id->setDbValue($rs->fields('id'));
		$news->catid->setDbValue($rs->fields('catid'));
		$news->newstitle->setDbValue($rs->fields('newstitle'));
		$news->newsdesc->setDbValue($rs->fields('newsdesc'));
		$news->pubtime->setDbValue($rs->fields('pubtime'));
		$news->newsimg->Upload->DbValue = $rs->fields('newsimg');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $news;

		// Call Row_Rendering event
		$news->Row_Rendering();

		// Common render codes for all row types
		// id

		$news->id->CellCssStyle = "";
		$news->id->CellCssClass = "";

		// catid
		$news->catid->CellCssStyle = "";
		$news->catid->CellCssClass = "";

		// newstitle
		$news->newstitle->CellCssStyle = "";
		$news->newstitle->CellCssClass = "";

		// pubtime
		$news->pubtime->CellCssStyle = "";
		$news->pubtime->CellCssClass = "";
		if ($news->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$news->id->ViewValue = $news->id->CurrentValue;
			$news->id->CssStyle = "";
			$news->id->CssClass = "";
			$news->id->ViewCustomAttributes = "";

			// catid
			if (strval($news->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `newscat` WHERE `id` = " . ew_AdjustSql($news->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$news->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$news->catid->ViewValue = $news->catid->CurrentValue;
				}
			} else {
				$news->catid->ViewValue = NULL;
			}
			$news->catid->CssStyle = "";
			$news->catid->CssClass = "";
			$news->catid->ViewCustomAttributes = "";

			// newstitle
			$news->newstitle->ViewValue = $news->newstitle->CurrentValue;
			$news->newstitle->CssStyle = "";
			$news->newstitle->CssClass = "";
			$news->newstitle->ViewCustomAttributes = "";

			// pubtime
			$news->pubtime->ViewValue = $news->pubtime->CurrentValue;
			$news->pubtime->ViewValue = ew_FormatDateTime($news->pubtime->ViewValue, 5);
			$news->pubtime->CssStyle = "";
			$news->pubtime->CssClass = "";
			$news->pubtime->ViewCustomAttributes = "";

			// id
			$news->id->HrefValue = "";

			// catid
			$news->catid->HrefValue = "";

			// newstitle
			$news->newstitle->HrefValue = "";

			// pubtime
			$news->pubtime->HrefValue = "";
		}

		// Call Row Rendered event
		$news->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $news;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($news->ExportAll) {
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
		if ($news->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($news->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $news->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $news->Export);
				ew_ExportAddValue($sExportStr, 'catid', $news->Export);
				ew_ExportAddValue($sExportStr, 'newstitle', $news->Export);
				ew_ExportAddValue($sExportStr, 'pubtime', $news->Export);
				echo ew_ExportLine($sExportStr, $news->Export);
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
				$news->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($news->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $news->id->CurrentValue);
					$XmlDoc->AddField('catid', $news->catid->CurrentValue);
					$XmlDoc->AddField('newstitle', $news->newstitle->CurrentValue);
					$XmlDoc->AddField('pubtime', $news->pubtime->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $news->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $news->id->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
						echo ew_ExportField('catid', $news->catid->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
						echo ew_ExportField('newstitle', $news->newstitle->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
						echo ew_ExportField('pubtime', $news->pubtime->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $news->id->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
						ew_ExportAddValue($sExportStr, $news->catid->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
						ew_ExportAddValue($sExportStr, $news->newstitle->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
						ew_ExportAddValue($sExportStr, $news->pubtime->ExportValue($news->Export, $news->ExportOriginalValue), $news->Export);
						echo ew_ExportLine($sExportStr, $news->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($news->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($news->Export);
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
