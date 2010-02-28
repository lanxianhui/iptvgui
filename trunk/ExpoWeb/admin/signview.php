<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "signinfo.php" ?>
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
$sign_view = new csign_view();
$Page =& $sign_view;

// Page init processing
$sign_view->Page_Init();

// Page main processing
$sign_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($sign->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sign_view = new ew_Page("sign_view");

// page properties
sign_view.PageID = "view"; // page ID
var EW_PAGE_ID = sign_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
sign_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
sign_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
sign_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sign_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Sign
<br><br>
<?php if ($sign->Export == "") { ?>
<a href="signlist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $sign->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $sign_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($sign->id->Visible) { // id ?>
	<tr<?php echo $sign->id->RowAttributes ?>>
		<td class="ewTableHeader">报名ID</td>
		<td<?php echo $sign->id->CellAttributes() ?>>
<div<?php echo $sign->id->ViewAttributes() ?>><?php echo $sign->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sign->username->Visible) { // username ?>
	<tr<?php echo $sign->username->RowAttributes ?>>
		<td class="ewTableHeader">报名人姓名</td>
		<td<?php echo $sign->username->CellAttributes() ?>>
<div<?php echo $sign->username->ViewAttributes() ?>><?php echo $sign->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sign->email->Visible) { // email ?>
	<tr<?php echo $sign->email->RowAttributes ?>>
		<td class="ewTableHeader">报名Email</td>
		<td<?php echo $sign->email->CellAttributes() ?>>
<div<?php echo $sign->email->ViewAttributes() ?>><?php echo $sign->email->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sign->company->Visible) { // company ?>
	<tr<?php echo $sign->company->RowAttributes ?>>
		<td class="ewTableHeader">报名单位</td>
		<td<?php echo $sign->company->CellAttributes() ?>>
<div<?php echo $sign->company->ViewAttributes() ?>><?php echo $sign->company->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sign->contact->Visible) { // contact ?>
	<tr<?php echo $sign->contact->RowAttributes ?>>
		<td class="ewTableHeader">联系方式</td>
		<td<?php echo $sign->contact->CellAttributes() ?>>
<div<?php echo $sign->contact->ViewAttributes() ?>><?php echo $sign->contact->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sign->mobile->Visible) { // mobile ?>
	<tr<?php echo $sign->mobile->RowAttributes ?>>
		<td class="ewTableHeader">手机号码</td>
		<td<?php echo $sign->mobile->CellAttributes() ?>>
<div<?php echo $sign->mobile->ViewAttributes() ?>><?php echo $sign->mobile->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sign->phone->Visible) { // phone ?>
	<tr<?php echo $sign->phone->RowAttributes ?>>
		<td class="ewTableHeader">固定电话</td>
		<td<?php echo $sign->phone->CellAttributes() ?>>
<div<?php echo $sign->phone->ViewAttributes() ?>><?php echo $sign->phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sign->address->Visible) { // address ?>
	<tr<?php echo $sign->address->RowAttributes ?>>
		<td class="ewTableHeader">所在地址</td>
		<td<?php echo $sign->address->CellAttributes() ?>>
<div<?php echo $sign->address->ViewAttributes() ?>><?php echo $sign->address->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($sign->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($sign_view->Pager)) $sign_view->Pager = new cPrevNextPager($sign_view->lStartRec, $sign_view->lDisplayRecs, $sign_view->lTotalRecs) ?>
<?php if ($sign_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($sign_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $sign_view->PageUrl() ?>start=<?php echo $sign_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($sign_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $sign_view->PageUrl() ?>start=<?php echo $sign_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $sign_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($sign_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $sign_view->PageUrl() ?>start=<?php echo $sign_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($sign_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $sign_view->PageUrl() ?>start=<?php echo $sign_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $sign_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($sign_view->sSrchWhere == "0=101") { ?>
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
<?php if ($sign->Export == "") { ?>
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
class csign_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'sign';

	// Page Object Name
	var $PageObjName = 'sign_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sign;
		if ($sign->UseTokenInUrl) $PageUrl .= "t=" . $sign->TableVar . "&"; // add page token
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
		global $objForm, $sign;
		if ($sign->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($sign->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sign->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function csign_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["sign"] = new csign();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sign', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $sign;
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
		global $sign;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$sign->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$sign->CurrentAction = "I"; // Display form
			switch ($sign->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("signlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($sign->id->CurrentValue) == strval($rs->fields('id'))) {
								$sign->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "signlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "signlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$sign->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $sign;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$sign->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$sign->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $sign->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$sign->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$sign->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$sign->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $sign;

		// Call Recordset Selecting event
		$sign->Recordset_Selecting($sign->CurrentFilter);

		// Load list page SQL
		$sSql = $sign->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$sign->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sign;
		$sFilter = $sign->KeyFilter();

		// Call Row Selecting event
		$sign->Row_Selecting($sFilter);

		// Load sql based on filter
		$sign->CurrentFilter = $sFilter;
		$sSql = $sign->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$sign->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $sign;
		$sign->id->setDbValue($rs->fields('id'));
		$sign->username->setDbValue($rs->fields('username'));
		$sign->email->setDbValue($rs->fields('email'));
		$sign->company->setDbValue($rs->fields('company'));
		$sign->contact->setDbValue($rs->fields('contact'));
		$sign->mobile->setDbValue($rs->fields('mobile'));
		$sign->phone->setDbValue($rs->fields('phone'));
		$sign->address->setDbValue($rs->fields('address'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $sign;

		// Call Row_Rendering event
		$sign->Row_Rendering();

		// Common render codes for all row types
		// id

		$sign->id->CellCssStyle = "";
		$sign->id->CellCssClass = "";

		// username
		$sign->username->CellCssStyle = "";
		$sign->username->CellCssClass = "";

		// email
		$sign->email->CellCssStyle = "";
		$sign->email->CellCssClass = "";

		// company
		$sign->company->CellCssStyle = "";
		$sign->company->CellCssClass = "";

		// contact
		$sign->contact->CellCssStyle = "";
		$sign->contact->CellCssClass = "";

		// mobile
		$sign->mobile->CellCssStyle = "";
		$sign->mobile->CellCssClass = "";

		// phone
		$sign->phone->CellCssStyle = "";
		$sign->phone->CellCssClass = "";

		// address
		$sign->address->CellCssStyle = "";
		$sign->address->CellCssClass = "";
		if ($sign->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$sign->id->ViewValue = $sign->id->CurrentValue;
			$sign->id->CssStyle = "";
			$sign->id->CssClass = "";
			$sign->id->ViewCustomAttributes = "";

			// username
			$sign->username->ViewValue = $sign->username->CurrentValue;
			$sign->username->CssStyle = "";
			$sign->username->CssClass = "";
			$sign->username->ViewCustomAttributes = "";

			// email
			$sign->email->ViewValue = $sign->email->CurrentValue;
			$sign->email->CssStyle = "";
			$sign->email->CssClass = "";
			$sign->email->ViewCustomAttributes = "";

			// company
			$sign->company->ViewValue = $sign->company->CurrentValue;
			$sign->company->CssStyle = "";
			$sign->company->CssClass = "";
			$sign->company->ViewCustomAttributes = "";

			// contact
			$sign->contact->ViewValue = $sign->contact->CurrentValue;
			$sign->contact->CssStyle = "";
			$sign->contact->CssClass = "";
			$sign->contact->ViewCustomAttributes = "";

			// mobile
			$sign->mobile->ViewValue = $sign->mobile->CurrentValue;
			$sign->mobile->CssStyle = "";
			$sign->mobile->CssClass = "";
			$sign->mobile->ViewCustomAttributes = "";

			// phone
			$sign->phone->ViewValue = $sign->phone->CurrentValue;
			$sign->phone->CssStyle = "";
			$sign->phone->CssClass = "";
			$sign->phone->ViewCustomAttributes = "";

			// address
			$sign->address->ViewValue = $sign->address->CurrentValue;
			$sign->address->CssStyle = "";
			$sign->address->CssClass = "";
			$sign->address->ViewCustomAttributes = "";

			// id
			$sign->id->HrefValue = "";

			// username
			$sign->username->HrefValue = "";

			// email
			$sign->email->HrefValue = "";

			// company
			$sign->company->HrefValue = "";

			// contact
			$sign->contact->HrefValue = "";

			// mobile
			$sign->mobile->HrefValue = "";

			// phone
			$sign->phone->HrefValue = "";

			// address
			$sign->address->HrefValue = "";
		}

		// Call Row Rendered event
		$sign->Row_Rendered();
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
