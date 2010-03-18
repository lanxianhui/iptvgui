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
$srviceroot_view = new csrviceroot_view();
$Page =& $srviceroot_view;

// Page init processing
$srviceroot_view->Page_Init();

// Page main processing
$srviceroot_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($srviceroot->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var srviceroot_view = new ew_Page("srviceroot_view");

// page properties
srviceroot_view.PageID = "view"; // page ID
var EW_PAGE_ID = srviceroot_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
srviceroot_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
srviceroot_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
srviceroot_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Srviceroot
<br><br>
<?php if ($srviceroot->Export == "") { ?>
<a href="srvicerootlist.php">回到列表</a>&nbsp;
<a href="<?php echo $srviceroot->AddUrl() ?>">添加</a>&nbsp;
<a href="<?php echo $srviceroot->EditUrl() ?>">编辑</a>&nbsp;
<a href="<?php echo $srviceroot->CopyUrl() ?>">复制</a>&nbsp;
<a href="<?php echo $srviceroot->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
</span></p>
<?php $srviceroot_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($srviceroot->id->Visible) { // id ?>
	<tr<?php echo $srviceroot->id->RowAttributes ?>>
		<td class="ewTableHeader">根ID</td>
		<td<?php echo $srviceroot->id->CellAttributes() ?>>
<div<?php echo $srviceroot->id->ViewAttributes() ?>><?php echo $srviceroot->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($srviceroot->rootname->Visible) { // rootname ?>
	<tr<?php echo $srviceroot->rootname->RowAttributes ?>>
		<td class="ewTableHeader">根类型名</td>
		<td<?php echo $srviceroot->rootname->CellAttributes() ?>>
<div<?php echo $srviceroot->rootname->ViewAttributes() ?>><?php echo $srviceroot->rootname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($srviceroot->rootorder->Visible) { // rootorder ?>
	<tr<?php echo $srviceroot->rootorder->RowAttributes ?>>
		<td class="ewTableHeader">根类型排序</td>
		<td<?php echo $srviceroot->rootorder->CellAttributes() ?>>
<div<?php echo $srviceroot->rootorder->ViewAttributes() ?>><?php echo $srviceroot->rootorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
class csrviceroot_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'srviceroot';

	// Page Object Name
	var $PageObjName = 'srviceroot_view';

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
	function csrviceroot_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["srviceroot"] = new csrviceroot();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'srviceroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $srviceroot;

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
		global $srviceroot;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$srviceroot->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "srvicerootlist.php"; // Return to list
			}

			// Get action
			$srviceroot->CurrentAction = "I"; // Display form
			switch ($srviceroot->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("没有数据"); // Set no record message
						$sReturnUrl = "srvicerootlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "srvicerootlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$srviceroot->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
}
?>
