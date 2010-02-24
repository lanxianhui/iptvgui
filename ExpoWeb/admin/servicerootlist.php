<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicerootinfo.php" ?>
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
$serviceroot_list = new cserviceroot_list();
$Page =& $serviceroot_list;

// Page init processing
$serviceroot_list->Page_Init();

// Page main processing
$serviceroot_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($serviceroot->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var serviceroot_list = new ew_Page("serviceroot_list");

// page properties
serviceroot_list.PageID = "list"; // page ID
var EW_PAGE_ID = serviceroot_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
serviceroot_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
serviceroot_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
serviceroot_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
serviceroot_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

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
<?php if ($serviceroot->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($serviceroot->Export == "" && $serviceroot->SelectLimit);
	if (!$bSelectLimit)
		$rs = $serviceroot_list->LoadRecordset();
	$serviceroot_list->lTotalRecs = ($bSelectLimit) ? $serviceroot->SelectRecordCount() : $rs->RecordCount();
	$serviceroot_list->lStartRec = 1;
	if ($serviceroot_list->lDisplayRecs <= 0) // Display all records
		$serviceroot_list->lDisplayRecs = $serviceroot_list->lTotalRecs;
	if (!($serviceroot->ExportAll && $serviceroot->Export <> ""))
		$serviceroot_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $serviceroot_list->LoadRecordset($serviceroot_list->lStartRec-1, $serviceroot_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">表: Serviceroot
<?php if ($serviceroot->Export == "" && $serviceroot->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $serviceroot_list->PageUrl() ?>export=excel">导出到 Excel</a>
&nbsp;&nbsp;<a href="<?php echo $serviceroot_list->PageUrl() ?>export=xml">导出到 XML</a>
&nbsp;&nbsp;<a href="<?php echo $serviceroot_list->PageUrl() ?>export=csv">导出到 CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($serviceroot->Export == "" && $serviceroot->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(serviceroot_list);" style="text-decoration: none;"><img id="serviceroot_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;搜索</span><br>
<div id="serviceroot_list_SearchPanel">
<form name="fservicerootlistsrch" id="fservicerootlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="serviceroot">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($serviceroot->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="  搜索 (*)  ">&nbsp;
			<a href="<?php echo $serviceroot_list->PageUrl() ?>cmd=reset">显示所有</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($serviceroot->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>完全匹配</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($serviceroot->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>全部字符</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($serviceroot->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>任意字符</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $serviceroot_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fservicerootlist" id="fservicerootlist" class="ewForm" action="" method="post">
<?php if ($serviceroot_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$serviceroot_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$serviceroot_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$serviceroot_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$serviceroot_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$serviceroot_list->lOptionCnt++; // Multi-select
}
	$serviceroot_list->lOptionCnt += count($serviceroot_list->ListOptions->Items); // Custom list options
?>
<?php echo $serviceroot->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($serviceroot->id->Visible) { // id ?>
	<?php if ($serviceroot->SortUrl($serviceroot->id) == "") { ?>
		<td>根类型ID</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $serviceroot->SortUrl($serviceroot->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类型ID</td><td style="width: 10px;"><?php if ($serviceroot->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($serviceroot->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($serviceroot->rootname->Visible) { // rootname ?>
	<?php if ($serviceroot->SortUrl($serviceroot->rootname) == "") { ?>
		<td>根类型名</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $serviceroot->SortUrl($serviceroot->rootname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类型名&nbsp;(*)</td><td style="width: 10px;"><?php if ($serviceroot->rootname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($serviceroot->rootname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($serviceroot->rootorder->Visible) { // rootorder ?>
	<?php if ($serviceroot->SortUrl($serviceroot->rootorder) == "") { ?>
		<td>根类型排序</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $serviceroot->SortUrl($serviceroot->rootorder) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>根类型排序</td><td style="width: 10px;"><?php if ($serviceroot->rootorder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($serviceroot->rootorder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($serviceroot->Export == "") { ?>
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
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="serviceroot_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($serviceroot_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($serviceroot->ExportAll && $serviceroot->Export <> "") {
	$serviceroot_list->lStopRec = $serviceroot_list->lTotalRecs;
} else {
	$serviceroot_list->lStopRec = $serviceroot_list->lStartRec + $serviceroot_list->lDisplayRecs - 1; // Set the last record to display
}
$serviceroot_list->lRecCount = $serviceroot_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$serviceroot->SelectLimit && $serviceroot_list->lStartRec > 1)
		$rs->Move($serviceroot_list->lStartRec - 1);
}
$serviceroot_list->lRowCnt = 0;
while (($serviceroot->CurrentAction == "gridadd" || !$rs->EOF) &&
	$serviceroot_list->lRecCount < $serviceroot_list->lStopRec) {
	$serviceroot_list->lRecCount++;
	if (intval($serviceroot_list->lRecCount) >= intval($serviceroot_list->lStartRec)) {
		$serviceroot_list->lRowCnt++;

	// Init row class and style
	$serviceroot->CssClass = "";
	$serviceroot->CssStyle = "";
	$serviceroot->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($serviceroot->CurrentAction == "gridadd") {
		$serviceroot_list->LoadDefaultValues(); // Load default values
	} else {
		$serviceroot_list->LoadRowValues($rs); // Load row values
	}
	$serviceroot->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$serviceroot_list->RenderRow();
?>
	<tr<?php echo $serviceroot->RowAttributes() ?>>
	<?php if ($serviceroot->id->Visible) { // id ?>
		<td<?php echo $serviceroot->id->CellAttributes() ?>>
<div<?php echo $serviceroot->id->ViewAttributes() ?>><?php echo $serviceroot->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($serviceroot->rootname->Visible) { // rootname ?>
		<td<?php echo $serviceroot->rootname->CellAttributes() ?>>
<div<?php echo $serviceroot->rootname->ViewAttributes() ?>><?php echo $serviceroot->rootname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($serviceroot->rootorder->Visible) { // rootorder ?>
		<td<?php echo $serviceroot->rootorder->CellAttributes() ?>>
<div<?php echo $serviceroot->rootorder->ViewAttributes() ?>><?php echo $serviceroot->rootorder->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($serviceroot->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $serviceroot->ViewUrl() ?>">查看</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $serviceroot->EditUrl() ?>">编辑</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $serviceroot->CopyUrl() ?>">复制</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($serviceroot->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($serviceroot_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($serviceroot->CurrentAction <> "gridadd")
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
<?php if ($serviceroot->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($serviceroot->CurrentAction <> "gridadd" && $serviceroot->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($serviceroot_list->Pager)) $serviceroot_list->Pager = new cPrevNextPager($serviceroot_list->lStartRec, $serviceroot_list->lDisplayRecs, $serviceroot_list->lTotalRecs) ?>
<?php if ($serviceroot_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($serviceroot_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_list->PageUrl() ?>start=<?php echo $serviceroot_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($serviceroot_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_list->PageUrl() ?>start=<?php echo $serviceroot_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $serviceroot_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($serviceroot_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_list->PageUrl() ?>start=<?php echo $serviceroot_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($serviceroot_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_list->PageUrl() ?>start=<?php echo $serviceroot_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $serviceroot_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">记录 <?php echo $serviceroot_list->Pager->FromIndex ?> 到 <?php echo $serviceroot_list->Pager->ToIndex ?> 总共 <?php echo $serviceroot_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($serviceroot_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($serviceroot_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $serviceroot->AddUrl() ?>">添加</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($serviceroot_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fservicerootlist)) alert('请至少选择一条记录'); else if (ew_Confirm('<?php echo $serviceroot_list->sDeleteConfirmMsg ?>')) {document.fservicerootlist.action='servicerootdelete.php';document.fservicerootlist.encoding='application/x-www-form-urlencoded';document.fservicerootlist.submit();};return false;">删除选中</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($serviceroot->Export == "" && $serviceroot->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(serviceroot_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($serviceroot->Export == "") { ?>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
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
class cserviceroot_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'serviceroot';

	// Page Object Name
	var $PageObjName = 'serviceroot_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $serviceroot;
		if ($serviceroot->UseTokenInUrl) $PageUrl .= "t=" . $serviceroot->TableVar . "&"; // add page token
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
		global $objForm, $serviceroot;
		if ($serviceroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($serviceroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($serviceroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cserviceroot_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["serviceroot"] = new cserviceroot();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'serviceroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $serviceroot;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$serviceroot->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $serviceroot->Export; // Get export parameter, used in header
	$gsExportFile = $serviceroot->TableVar; // Get export file, used in header
	if ($serviceroot->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($serviceroot->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($serviceroot->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $serviceroot;
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
		if ($serviceroot->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $serviceroot->getRecordsPerPage(); // Restore from Session
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
		$serviceroot->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$serviceroot->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$serviceroot->setStartRecordNumber($this->lStartRec);
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
		$serviceroot->setSessionWhere($sFilter);
		$serviceroot->CurrentFilter = "";

		// Export data only
		if (in_array($serviceroot->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $serviceroot;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $serviceroot->rootname->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $serviceroot;
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
			$serviceroot->setBasicSearchKeyword($sSearchKeyword);
			$serviceroot->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $serviceroot;
		$this->sSrchWhere = "";
		$serviceroot->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $serviceroot;
		$serviceroot->setBasicSearchKeyword("");
		$serviceroot->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $serviceroot;
		$this->sSrchWhere = $serviceroot->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $serviceroot;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$serviceroot->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$serviceroot->CurrentOrderType = @$_GET["ordertype"];
			$serviceroot->UpdateSort($serviceroot->id); // Field 
			$serviceroot->UpdateSort($serviceroot->rootname); // Field 
			$serviceroot->UpdateSort($serviceroot->rootorder); // Field 
			$serviceroot->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $serviceroot;
		$sOrderBy = $serviceroot->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($serviceroot->SqlOrderBy() <> "") {
				$sOrderBy = $serviceroot->SqlOrderBy();
				$serviceroot->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $serviceroot;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$serviceroot->setSessionOrderBy($sOrderBy);
				$serviceroot->id->setSort("");
				$serviceroot->rootname->setSort("");
				$serviceroot->rootorder->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$serviceroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $serviceroot;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$serviceroot->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$serviceroot->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $serviceroot->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$serviceroot->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$serviceroot->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$serviceroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $serviceroot;

		// Call Recordset Selecting event
		$serviceroot->Recordset_Selecting($serviceroot->CurrentFilter);

		// Load list page SQL
		$sSql = $serviceroot->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$serviceroot->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $serviceroot;
		$sFilter = $serviceroot->KeyFilter();

		// Call Row Selecting event
		$serviceroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$serviceroot->CurrentFilter = $sFilter;
		$sSql = $serviceroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$serviceroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $serviceroot;
		$serviceroot->id->setDbValue($rs->fields('id'));
		$serviceroot->rootname->setDbValue($rs->fields('rootname'));
		$serviceroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $serviceroot;

		// Call Row_Rendering event
		$serviceroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$serviceroot->id->CellCssStyle = "";
		$serviceroot->id->CellCssClass = "";

		// rootname
		$serviceroot->rootname->CellCssStyle = "";
		$serviceroot->rootname->CellCssClass = "";

		// rootorder
		$serviceroot->rootorder->CellCssStyle = "";
		$serviceroot->rootorder->CellCssClass = "";
		if ($serviceroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$serviceroot->id->ViewValue = $serviceroot->id->CurrentValue;
			$serviceroot->id->CssStyle = "";
			$serviceroot->id->CssClass = "";
			$serviceroot->id->ViewCustomAttributes = "";

			// rootname
			$serviceroot->rootname->ViewValue = $serviceroot->rootname->CurrentValue;
			$serviceroot->rootname->CssStyle = "";
			$serviceroot->rootname->CssClass = "";
			$serviceroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$serviceroot->rootorder->ViewValue = $serviceroot->rootorder->CurrentValue;
			$serviceroot->rootorder->CssStyle = "";
			$serviceroot->rootorder->CssClass = "";
			$serviceroot->rootorder->ViewCustomAttributes = "";

			// id
			$serviceroot->id->HrefValue = "";

			// rootname
			$serviceroot->rootname->HrefValue = "";

			// rootorder
			$serviceroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$serviceroot->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $serviceroot;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($serviceroot->ExportAll) {
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
		if ($serviceroot->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($serviceroot->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $serviceroot->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $serviceroot->Export);
				ew_ExportAddValue($sExportStr, 'rootname', $serviceroot->Export);
				ew_ExportAddValue($sExportStr, 'rootorder', $serviceroot->Export);
				echo ew_ExportLine($sExportStr, $serviceroot->Export);
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
				$serviceroot->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($serviceroot->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $serviceroot->id->CurrentValue);
					$XmlDoc->AddField('rootname', $serviceroot->rootname->CurrentValue);
					$XmlDoc->AddField('rootorder', $serviceroot->rootorder->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $serviceroot->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $serviceroot->id->ExportValue($serviceroot->Export, $serviceroot->ExportOriginalValue), $serviceroot->Export);
						echo ew_ExportField('rootname', $serviceroot->rootname->ExportValue($serviceroot->Export, $serviceroot->ExportOriginalValue), $serviceroot->Export);
						echo ew_ExportField('rootorder', $serviceroot->rootorder->ExportValue($serviceroot->Export, $serviceroot->ExportOriginalValue), $serviceroot->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $serviceroot->id->ExportValue($serviceroot->Export, $serviceroot->ExportOriginalValue), $serviceroot->Export);
						ew_ExportAddValue($sExportStr, $serviceroot->rootname->ExportValue($serviceroot->Export, $serviceroot->ExportOriginalValue), $serviceroot->Export);
						ew_ExportAddValue($sExportStr, $serviceroot->rootorder->ExportValue($serviceroot->Export, $serviceroot->ExportOriginalValue), $serviceroot->Export);
						echo ew_ExportLine($sExportStr, $serviceroot->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($serviceroot->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($serviceroot->Export);
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
