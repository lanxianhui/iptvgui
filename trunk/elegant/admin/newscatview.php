<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newscatinfo.php" ?>
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
$newscat_view = new cnewscat_view();
$Page =& $newscat_view;

// Page init processing
$newscat_view->Page_Init();

// Page main processing
$newscat_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($newscat->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var newscat_view = new ew_Page("newscat_view");

// page properties
newscat_view.PageID = "view"; // page ID
var EW_PAGE_ID = newscat_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
newscat_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
newscat_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
newscat_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Newscat
<br><br>
<?php if ($newscat->Export == "") { ?>
<a href="newscatlist.php">回到列表</a>&nbsp;
<a href="<?php echo $newscat->AddUrl() ?>">添加</a>&nbsp;
<a href="<?php echo $newscat->EditUrl() ?>">编辑</a>&nbsp;
<a href="<?php echo $newscat->CopyUrl() ?>">复制</a>&nbsp;
<a href="<?php echo $newscat->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
</span></p>
<?php $newscat_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($newscat->id->Visible) { // id ?>
	<tr<?php echo $newscat->id->RowAttributes ?>>
		<td class="ewTableHeader">类型ID</td>
		<td<?php echo $newscat->id->CellAttributes() ?>>
<div<?php echo $newscat->id->ViewAttributes() ?>><?php echo $newscat->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($newscat->catname->Visible) { // catname ?>
	<tr<?php echo $newscat->catname->RowAttributes ?>>
		<td class="ewTableHeader">类型名称</td>
		<td<?php echo $newscat->catname->CellAttributes() ?>>
<div<?php echo $newscat->catname->ViewAttributes() ?>><?php echo $newscat->catname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($newscat->catorder->Visible) { // catorder ?>
	<tr<?php echo $newscat->catorder->RowAttributes ?>>
		<td class="ewTableHeader">类型排序</td>
		<td<?php echo $newscat->catorder->CellAttributes() ?>>
<div<?php echo $newscat->catorder->ViewAttributes() ?>><?php echo $newscat->catorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($newscat->Export == "") { ?>
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
class cnewscat_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'newscat';

	// Page Object Name
	var $PageObjName = 'newscat_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $newscat;
		if ($newscat->UseTokenInUrl) $PageUrl .= "t=" . $newscat->TableVar . "&"; // add page token
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
		global $objForm, $newscat;
		if ($newscat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($newscat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($newscat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnewscat_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["newscat"] = new cnewscat();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'newscat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $newscat;

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
		global $newscat;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$newscat->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "newscatlist.php"; // Return to list
			}

			// Get action
			$newscat->CurrentAction = "I"; // Display form
			switch ($newscat->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("没有数据"); // Set no record message
						$sReturnUrl = "newscatlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "newscatlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$newscat->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $newscat;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$newscat->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$newscat->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $newscat->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$newscat->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$newscat->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$newscat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $newscat;
		$sFilter = $newscat->KeyFilter();

		// Call Row Selecting event
		$newscat->Row_Selecting($sFilter);

		// Load sql based on filter
		$newscat->CurrentFilter = $sFilter;
		$sSql = $newscat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$newscat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $newscat;
		$newscat->id->setDbValue($rs->fields('id'));
		$newscat->catname->setDbValue($rs->fields('catname'));
		$newscat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $newscat;

		// Call Row_Rendering event
		$newscat->Row_Rendering();

		// Common render codes for all row types
		// id

		$newscat->id->CellCssStyle = "";
		$newscat->id->CellCssClass = "";

		// catname
		$newscat->catname->CellCssStyle = "";
		$newscat->catname->CellCssClass = "";

		// catorder
		$newscat->catorder->CellCssStyle = "";
		$newscat->catorder->CellCssClass = "";
		if ($newscat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$newscat->id->ViewValue = $newscat->id->CurrentValue;
			$newscat->id->CssStyle = "";
			$newscat->id->CssClass = "";
			$newscat->id->ViewCustomAttributes = "";

			// catname
			$newscat->catname->ViewValue = $newscat->catname->CurrentValue;
			$newscat->catname->CssStyle = "";
			$newscat->catname->CssClass = "";
			$newscat->catname->ViewCustomAttributes = "";

			// catorder
			$newscat->catorder->ViewValue = $newscat->catorder->CurrentValue;
			$newscat->catorder->CssStyle = "";
			$newscat->catorder->CssClass = "";
			$newscat->catorder->ViewCustomAttributes = "";

			// id
			$newscat->id->HrefValue = "";

			// catname
			$newscat->catname->HrefValue = "";

			// catorder
			$newscat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$newscat->Row_Rendered();
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
