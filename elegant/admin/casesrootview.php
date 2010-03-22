<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesrootinfo.php" ?>
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
$casesroot_view = new ccasesroot_view();
$Page =& $casesroot_view;

// Page init processing
$casesroot_view->Page_Init();

// Page main processing
$casesroot_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($casesroot->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var casesroot_view = new ew_Page("casesroot_view");

// page properties
casesroot_view.PageID = "view"; // page ID
var EW_PAGE_ID = casesroot_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
casesroot_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
casesroot_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
casesroot_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casesroot_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">�鿴 ��: Casesroot
<br><br>
<?php if ($casesroot->Export == "") { ?>
<a href="casesrootlist.php">�ص��б�</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $casesroot->AddUrl() ?>">����</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $casesroot->EditUrl() ?>">�༭</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $casesroot->CopyUrl() ?>">����</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('�����Ҫɾ����?');" href="<?php echo $casesroot->DeleteUrl() ?>">ɾ��</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $casesroot_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($casesroot->id->Visible) { // id ?>
	<tr<?php echo $casesroot->id->RowAttributes ?>>
		<td class="ewTableHeader">��������ID</td>
		<td<?php echo $casesroot->id->CellAttributes() ?>>
<div<?php echo $casesroot->id->ViewAttributes() ?>><?php echo $casesroot->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($casesroot->rootname->Visible) { // rootname ?>
	<tr<?php echo $casesroot->rootname->RowAttributes ?>>
		<td class="ewTableHeader">��������</td>
		<td<?php echo $casesroot->rootname->CellAttributes() ?>>
<div<?php echo $casesroot->rootname->ViewAttributes() ?>><?php echo $casesroot->rootname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($casesroot->rootorder->Visible) { // rootorder ?>
	<tr<?php echo $casesroot->rootorder->RowAttributes ?>>
		<td class="ewTableHeader">��������</td>
		<td<?php echo $casesroot->rootorder->CellAttributes() ?>>
<div<?php echo $casesroot->rootorder->ViewAttributes() ?>><?php echo $casesroot->rootorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($casesroot->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($casesroot_view->Pager)) $casesroot_view->Pager = new cPrevNextPager($casesroot_view->lStartRec, $casesroot_view->lDisplayRecs, $casesroot_view->lTotalRecs) ?>
<?php if ($casesroot_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">ҳ&nbsp;</span></td>
<!--first page button-->
	<?php if ($casesroot_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_view->PageUrl() ?>start=<?php echo $casesroot_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="��һҳ" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="��һҳ" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($casesroot_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_view->PageUrl() ?>start=<?php echo $casesroot_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="��һҳ" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="��һҳ" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $casesroot_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($casesroot_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_view->PageUrl() ?>start=<?php echo $casesroot_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="��һҳ" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="��һҳ" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($casesroot_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $casesroot_view->PageUrl() ?>start=<?php echo $casesroot_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="���ҳ" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="���ҳ" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;�ܹ� <?php echo $casesroot_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($casesroot_view->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">�����������ؼ���</span>
	<?php } else { ?>
	<span class="phpmaker">û������</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<p>
<?php if ($casesroot->Export == "") { ?>
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
class ccasesroot_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'casesroot';

	// Page Object Name
	var $PageObjName = 'casesroot_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $casesroot;
		if ($casesroot->UseTokenInUrl) $PageUrl .= "t=" . $casesroot->TableVar . "&"; // add page token
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
		global $objForm, $casesroot;
		if ($casesroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($casesroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($casesroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccasesroot_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["casesroot"] = new ccasesroot();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'casesroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $casesroot;
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
		global $casesroot;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$casesroot->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$casesroot->CurrentAction = "I"; // Display form
			switch ($casesroot->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("û������"); // Set no record message
						$this->Page_Terminate("casesrootlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($casesroot->id->CurrentValue) == strval($rs->fields('id'))) {
								$casesroot->setStartRecordNumber($this->lStartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->lStartRec++;
								$rs->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						$this->setMessage("û������"); // Set no record message
						$sReturnUrl = "casesrootlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "casesrootlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$casesroot->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $casesroot;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$casesroot->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$casesroot->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $casesroot->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$casesroot->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$casesroot->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$casesroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $casesroot;

		// Call Recordset Selecting event
		$casesroot->Recordset_Selecting($casesroot->CurrentFilter);

		// Load list page SQL
		$sSql = $casesroot->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$casesroot->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $casesroot;
		$sFilter = $casesroot->KeyFilter();

		// Call Row Selecting event
		$casesroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$casesroot->CurrentFilter = $sFilter;
		$sSql = $casesroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$casesroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $casesroot;
		$casesroot->id->setDbValue($rs->fields('id'));
		$casesroot->rootname->setDbValue($rs->fields('rootname'));
		$casesroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $casesroot;

		// Call Row_Rendering event
		$casesroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$casesroot->id->CellCssStyle = "";
		$casesroot->id->CellCssClass = "";

		// rootname
		$casesroot->rootname->CellCssStyle = "";
		$casesroot->rootname->CellCssClass = "";

		// rootorder
		$casesroot->rootorder->CellCssStyle = "";
		$casesroot->rootorder->CellCssClass = "";
		if ($casesroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$casesroot->id->ViewValue = $casesroot->id->CurrentValue;
			$casesroot->id->CssStyle = "";
			$casesroot->id->CssClass = "";
			$casesroot->id->ViewCustomAttributes = "";

			// rootname
			$casesroot->rootname->ViewValue = $casesroot->rootname->CurrentValue;
			$casesroot->rootname->CssStyle = "";
			$casesroot->rootname->CssClass = "";
			$casesroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$casesroot->rootorder->ViewValue = $casesroot->rootorder->CurrentValue;
			$casesroot->rootorder->CssStyle = "";
			$casesroot->rootorder->CssClass = "";
			$casesroot->rootorder->ViewCustomAttributes = "";

			// id
			$casesroot->id->HrefValue = "";

			// rootname
			$casesroot->rootname->HrefValue = "";

			// rootorder
			$casesroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$casesroot->Row_Rendered();
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