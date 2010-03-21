<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "consultinginfo.php" ?>
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
$consulting_view = new cconsulting_view();
$Page =& $consulting_view;

// Page init processing
$consulting_view->Page_Init();

// Page main processing
$consulting_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($consulting->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var consulting_view = new ew_Page("consulting_view");

// page properties
consulting_view.PageID = "view"; // page ID
var EW_PAGE_ID = consulting_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
consulting_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
consulting_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
consulting_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consulting_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<p><span class="phpmaker">查看 表: Consulting
<br><br>
<?php if ($consulting->Export == "") { ?>
<a href="consultinglist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $consulting->AddUrl() ?>">添加</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $consulting->EditUrl() ?>">编辑</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $consulting->CopyUrl() ?>">复制</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $consulting->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $consulting_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($consulting->id->Visible) { // id ?>
	<tr<?php echo $consulting->id->RowAttributes ?>>
		<td class="ewTableHeader">咨询ID</td>
		<td<?php echo $consulting->id->CellAttributes() ?>>
<div<?php echo $consulting->id->ViewAttributes() ?>><?php echo $consulting->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consulting->title->Visible) { // title ?>
	<tr<?php echo $consulting->title->RowAttributes ?>>
		<td class="ewTableHeader">称呼</td>
		<td<?php echo $consulting->title->CellAttributes() ?>>
<div<?php echo $consulting->title->ViewAttributes() ?>><?php echo $consulting->title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consulting->company->Visible) { // company ?>
	<tr<?php echo $consulting->company->RowAttributes ?>>
		<td class="ewTableHeader">公司</td>
		<td<?php echo $consulting->company->CellAttributes() ?>>
<div<?php echo $consulting->company->ViewAttributes() ?>><?php echo $consulting->company->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consulting->phone->Visible) { // phone ?>
	<tr<?php echo $consulting->phone->RowAttributes ?>>
		<td class="ewTableHeader">电话</td>
		<td<?php echo $consulting->phone->CellAttributes() ?>>
<div<?php echo $consulting->phone->ViewAttributes() ?>><?php echo $consulting->phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consulting->content->Visible) { // content ?>
	<tr<?php echo $consulting->content->RowAttributes ?>>
		<td class="ewTableHeader">内容</td>
		<td<?php echo $consulting->content->CellAttributes() ?>>
<div<?php echo $consulting->content->ViewAttributes() ?>><?php echo $consulting->content->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($consulting->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($consulting_view->Pager)) $consulting_view->Pager = new cPrevNextPager($consulting_view->lStartRec, $consulting_view->lDisplayRecs, $consulting_view->lTotalRecs) ?>
<?php if ($consulting_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($consulting_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_view->PageUrl() ?>start=<?php echo $consulting_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($consulting_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_view->PageUrl() ?>start=<?php echo $consulting_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $consulting_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($consulting_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_view->PageUrl() ?>start=<?php echo $consulting_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($consulting_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $consulting_view->PageUrl() ?>start=<?php echo $consulting_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $consulting_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($consulting_view->sSrchWhere == "0=101") { ?>
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
<p>
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
class cconsulting_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'consulting';

	// Page Object Name
	var $PageObjName = 'consulting_view';

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
	function cconsulting_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["consulting"] = new cconsulting();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consulting', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $consulting;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $consulting;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$consulting->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$consulting->CurrentAction = "I"; // Display form
			switch ($consulting->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("consultinglist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($consulting->id->CurrentValue) == strval($rs->fields('id'))) {
								$consulting->setStartRecordNumber($this->lStartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->lStartRec++;
								$rs->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						$this->setMessage("没有数据"); // Set no record message
						$sReturnUrl = "consultinglist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "consultinglist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$consulting->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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

		// content
		$consulting->content->CellCssStyle = "";
		$consulting->content->CellCssClass = "";
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

			// content
			$consulting->content->ViewValue = $consulting->content->CurrentValue;
			$consulting->content->CssStyle = "";
			$consulting->content->CssClass = "";
			$consulting->content->ViewCustomAttributes = "";

			// id
			$consulting->id->HrefValue = "";

			// title
			$consulting->title->HrefValue = "";

			// company
			$consulting->company->HrefValue = "";

			// phone
			$consulting->phone->HrefValue = "";

			// content
			$consulting->content->HrefValue = "";
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
}
?>
