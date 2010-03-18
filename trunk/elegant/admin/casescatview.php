<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casescatinfo.php" ?>
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
$casescat_view = new ccasescat_view();
$Page =& $casescat_view;

// Page init processing
$casescat_view->Page_Init();

// Page main processing
$casescat_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($casescat->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var casescat_view = new ew_Page("casescat_view");

// page properties
casescat_view.PageID = "view"; // page ID
var EW_PAGE_ID = casescat_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
casescat_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
casescat_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casescat_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Casescat
<br><br>
<?php if ($casescat->Export == "") { ?>
<a href="casescatlist.php">回到列表</a>&nbsp;
<a href="<?php echo $casescat->AddUrl() ?>">添加</a>&nbsp;
<a href="<?php echo $casescat->EditUrl() ?>">编辑</a>&nbsp;
<a href="<?php echo $casescat->CopyUrl() ?>">复制</a>&nbsp;
<a href="<?php echo $casescat->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
</span></p>
<?php $casescat_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($casescat->id->Visible) { // id ?>
	<tr<?php echo $casescat->id->RowAttributes ?>>
		<td class="ewTableHeader">类型ID</td>
		<td<?php echo $casescat->id->CellAttributes() ?>>
<div<?php echo $casescat->id->ViewAttributes() ?>><?php echo $casescat->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($casescat->catname->Visible) { // catname ?>
	<tr<?php echo $casescat->catname->RowAttributes ?>>
		<td class="ewTableHeader">类型名称</td>
		<td<?php echo $casescat->catname->CellAttributes() ?>>
<div<?php echo $casescat->catname->ViewAttributes() ?>><?php echo $casescat->catname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($casescat->catorder->Visible) { // catorder ?>
	<tr<?php echo $casescat->catorder->RowAttributes ?>>
		<td class="ewTableHeader">类型排序</td>
		<td<?php echo $casescat->catorder->CellAttributes() ?>>
<div<?php echo $casescat->catorder->ViewAttributes() ?>><?php echo $casescat->catorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($casescat->Export == "") { ?>
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
class ccasescat_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'casescat';

	// Page Object Name
	var $PageObjName = 'casescat_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $casescat;
		if ($casescat->UseTokenInUrl) $PageUrl .= "t=" . $casescat->TableVar . "&"; // add page token
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
		global $objForm, $casescat;
		if ($casescat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($casescat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($casescat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccasescat_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["casescat"] = new ccasescat();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'casescat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $casescat;

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
		global $casescat;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$casescat->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "casescatlist.php"; // Return to list
			}

			// Get action
			$casescat->CurrentAction = "I"; // Display form
			switch ($casescat->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("没有数据"); // Set no record message
						$sReturnUrl = "casescatlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "casescatlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$casescat->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $casescat;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$casescat->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$casescat->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $casescat->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$casescat->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$casescat->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$casescat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $casescat;
		$sFilter = $casescat->KeyFilter();

		// Call Row Selecting event
		$casescat->Row_Selecting($sFilter);

		// Load sql based on filter
		$casescat->CurrentFilter = $sFilter;
		$sSql = $casescat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$casescat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $casescat;
		$casescat->id->setDbValue($rs->fields('id'));
		$casescat->catname->setDbValue($rs->fields('catname'));
		$casescat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $casescat;

		// Call Row_Rendering event
		$casescat->Row_Rendering();

		// Common render codes for all row types
		// id

		$casescat->id->CellCssStyle = "";
		$casescat->id->CellCssClass = "";

		// catname
		$casescat->catname->CellCssStyle = "";
		$casescat->catname->CellCssClass = "";

		// catorder
		$casescat->catorder->CellCssStyle = "";
		$casescat->catorder->CellCssClass = "";
		if ($casescat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$casescat->id->ViewValue = $casescat->id->CurrentValue;
			$casescat->id->CssStyle = "";
			$casescat->id->CssClass = "";
			$casescat->id->ViewCustomAttributes = "";

			// catname
			$casescat->catname->ViewValue = $casescat->catname->CurrentValue;
			$casescat->catname->CssStyle = "";
			$casescat->catname->CssClass = "";
			$casescat->catname->ViewCustomAttributes = "";

			// catorder
			$casescat->catorder->ViewValue = $casescat->catorder->CurrentValue;
			$casescat->catorder->CssStyle = "";
			$casescat->catorder->CssClass = "";
			$casescat->catorder->ViewCustomAttributes = "";

			// id
			$casescat->id->HrefValue = "";

			// catname
			$casescat->catname->HrefValue = "";

			// catorder
			$casescat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$casescat->Row_Rendered();
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
