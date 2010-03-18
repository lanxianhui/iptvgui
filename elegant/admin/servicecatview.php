<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicecatinfo.php" ?>
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
$servicecat_view = new cservicecat_view();
$Page =& $servicecat_view;

// Page init processing
$servicecat_view->Page_Init();

// Page main processing
$servicecat_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($servicecat->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var servicecat_view = new ew_Page("servicecat_view");

// page properties
servicecat_view.PageID = "view"; // page ID
var EW_PAGE_ID = servicecat_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
servicecat_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
servicecat_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
servicecat_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Servicecat
<br><br>
<?php if ($servicecat->Export == "") { ?>
<a href="servicecatlist.php">回到列表</a>&nbsp;
<a href="<?php echo $servicecat->AddUrl() ?>">添加</a>&nbsp;
<a href="<?php echo $servicecat->EditUrl() ?>">编辑</a>&nbsp;
<a href="<?php echo $servicecat->CopyUrl() ?>">复制</a>&nbsp;
<a href="<?php echo $servicecat->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
</span></p>
<?php $servicecat_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($servicecat->id->Visible) { // id ?>
	<tr<?php echo $servicecat->id->RowAttributes ?>>
		<td class="ewTableHeader">类型ID</td>
		<td<?php echo $servicecat->id->CellAttributes() ?>>
<div<?php echo $servicecat->id->ViewAttributes() ?>><?php echo $servicecat->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($servicecat->catname->Visible) { // catname ?>
	<tr<?php echo $servicecat->catname->RowAttributes ?>>
		<td class="ewTableHeader">类型名字</td>
		<td<?php echo $servicecat->catname->CellAttributes() ?>>
<div<?php echo $servicecat->catname->ViewAttributes() ?>><?php echo $servicecat->catname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($servicecat->rootid->Visible) { // rootid ?>
	<tr<?php echo $servicecat->rootid->RowAttributes ?>>
		<td class="ewTableHeader">所属根类型</td>
		<td<?php echo $servicecat->rootid->CellAttributes() ?>>
<div<?php echo $servicecat->rootid->ViewAttributes() ?>><?php echo $servicecat->rootid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($servicecat->catdesc->Visible) { // catdesc ?>
	<tr<?php echo $servicecat->catdesc->RowAttributes ?>>
		<td class="ewTableHeader">类型描述</td>
		<td<?php echo $servicecat->catdesc->CellAttributes() ?>>
<div<?php echo $servicecat->catdesc->ViewAttributes() ?>><?php echo $servicecat->catdesc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($servicecat->catorder->Visible) { // catorder ?>
	<tr<?php echo $servicecat->catorder->RowAttributes ?>>
		<td class="ewTableHeader">类型排序</td>
		<td<?php echo $servicecat->catorder->CellAttributes() ?>>
<div<?php echo $servicecat->catorder->ViewAttributes() ?>><?php echo $servicecat->catorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
class cservicecat_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'servicecat';

	// Page Object Name
	var $PageObjName = 'servicecat_view';

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
	function cservicecat_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["servicecat"] = new cservicecat();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'servicecat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $servicecat;

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
		global $servicecat;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$servicecat->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "servicecatlist.php"; // Return to list
			}

			// Get action
			$servicecat->CurrentAction = "I"; // Display form
			switch ($servicecat->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("没有数据"); // Set no record message
						$sReturnUrl = "servicecatlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "servicecatlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$servicecat->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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

		// catdesc
		$servicecat->catdesc->CellCssStyle = "";
		$servicecat->catdesc->CellCssClass = "";

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
			if (strval($servicecat->rootid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `rootname` FROM `srviceroot` WHERE `id` = " . ew_AdjustSql($servicecat->rootid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$servicecat->rootid->ViewValue = $rswrk->fields('rootname');
					$rswrk->Close();
				} else {
					$servicecat->rootid->ViewValue = $servicecat->rootid->CurrentValue;
				}
			} else {
				$servicecat->rootid->ViewValue = NULL;
			}
			$servicecat->rootid->CssStyle = "";
			$servicecat->rootid->CssClass = "";
			$servicecat->rootid->ViewCustomAttributes = "";

			// catdesc
			$servicecat->catdesc->ViewValue = $servicecat->catdesc->CurrentValue;
			$servicecat->catdesc->CssStyle = "";
			$servicecat->catdesc->CssClass = "";
			$servicecat->catdesc->ViewCustomAttributes = "";

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

			// catdesc
			$servicecat->catdesc->HrefValue = "";

			// catorder
			$servicecat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$servicecat->Row_Rendered();
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
