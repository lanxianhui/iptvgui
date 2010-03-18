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
$cases_view = new ccases_view();
$Page =& $cases_view;

// Page init processing
$cases_view->Page_Init();

// Page main processing
$cases_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cases->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cases_view = new ew_Page("cases_view");

// page properties
cases_view.PageID = "view"; // page ID
var EW_PAGE_ID = cases_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cases_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cases_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cases_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Cases
<br><br>
<?php if ($cases->Export == "") { ?>
<a href="caseslist.php">回到列表</a>&nbsp;
<a href="<?php echo $cases->AddUrl() ?>">添加</a>&nbsp;
<a href="<?php echo $cases->EditUrl() ?>">编辑</a>&nbsp;
<a href="<?php echo $cases->CopyUrl() ?>">复制</a>&nbsp;
<a href="<?php echo $cases->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
</span></p>
<?php $cases_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cases->id->Visible) { // id ?>
	<tr<?php echo $cases->id->RowAttributes ?>>
		<td class="ewTableHeader">案例ID</td>
		<td<?php echo $cases->id->CellAttributes() ?>>
<div<?php echo $cases->id->ViewAttributes() ?>><?php echo $cases->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->casetitle->Visible) { // casetitle ?>
	<tr<?php echo $cases->casetitle->RowAttributes ?>>
		<td class="ewTableHeader">案例标题</td>
		<td<?php echo $cases->casetitle->CellAttributes() ?>>
<div<?php echo $cases->casetitle->ViewAttributes() ?>><?php echo $cases->casetitle->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic->Visible) { // casepic ?>
	<tr<?php echo $cases->casepic->RowAttributes ?>>
		<td class="ewTableHeader">案例图片</td>
		<td<?php echo $cases->casepic->CellAttributes() ?>>
<?php if ($cases->casepic->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic->Upload->DbValue ?>" border=0<?php echo $cases->casepic->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic->Upload->DbValue ?>" border=0<?php echo $cases->casepic->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casedesc->Visible) { // casedesc ?>
	<tr<?php echo $cases->casedesc->RowAttributes ?>>
		<td class="ewTableHeader">案例描述</td>
		<td<?php echo $cases->casedesc->CellAttributes() ?>>
<div<?php echo $cases->casedesc->ViewAttributes() ?>><?php echo $cases->casedesc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->catid->Visible) { // catid ?>
	<tr<?php echo $cases->catid->RowAttributes ?>>
		<td class="ewTableHeader">案例类型</td>
		<td<?php echo $cases->catid->CellAttributes() ?>>
<div<?php echo $cases->catid->ViewAttributes() ?>><?php echo $cases->catid->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
class ccases_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'cases';

	// Page Object Name
	var $PageObjName = 'cases_view';

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
	function ccases_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["cases"] = new ccases();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cases', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cases;

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
		global $cases;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$cases->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "caseslist.php"; // Return to list
			}

			// Get action
			$cases->CurrentAction = "I"; // Display form
			switch ($cases->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("没有数据"); // Set no record message
						$sReturnUrl = "caseslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "caseslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$cases->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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

		// casepic
		$cases->casepic->CellCssStyle = "";
		$cases->casepic->CellCssClass = "";

		// casedesc
		$cases->casedesc->CellCssStyle = "";
		$cases->casedesc->CellCssClass = "";

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

			// casepic
			if (!is_null($cases->casepic->Upload->DbValue)) {
				$cases->casepic->ViewValue = $cases->casepic->Upload->DbValue;
				$cases->casepic->ImageAlt = "";
			} else {
				$cases->casepic->ViewValue = "";
			}
			$cases->casepic->CssStyle = "";
			$cases->casepic->CssClass = "";
			$cases->casepic->ViewCustomAttributes = "";

			// casedesc
			$cases->casedesc->ViewValue = $cases->casedesc->CurrentValue;
			$cases->casedesc->CssStyle = "";
			$cases->casedesc->CssClass = "";
			$cases->casedesc->ViewCustomAttributes = "";

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

			// casepic
			$cases->casepic->HrefValue = "";

			// casedesc
			$cases->casedesc->HrefValue = "";

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
}
?>
