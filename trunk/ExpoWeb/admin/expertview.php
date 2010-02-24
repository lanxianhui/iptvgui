<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "expertinfo.php" ?>
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
$expert_view = new cexpert_view();
$Page =& $expert_view;

// Page init processing
$expert_view->Page_Init();

// Page main processing
$expert_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($expert->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expert_view = new ew_Page("expert_view");

// page properties
expert_view.PageID = "view"; // page ID
var EW_PAGE_ID = expert_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expert_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expert_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expert_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expert_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Expert
<br><br>
<?php if ($expert->Export == "") { ?>
<a href="expertlist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $expert->AddUrl() ?>">添加</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $expert->EditUrl() ?>">编辑</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $expert->CopyUrl() ?>">复制</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $expert->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $expert_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expert->id->Visible) { // id ?>
	<tr<?php echo $expert->id->RowAttributes ?>>
		<td class="ewTableHeader">专家ID</td>
		<td<?php echo $expert->id->CellAttributes() ?>>
<div<?php echo $expert->id->ViewAttributes() ?>><?php echo $expert->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expert->username->Visible) { // username ?>
	<tr<?php echo $expert->username->RowAttributes ?>>
		<td class="ewTableHeader">专家姓名</td>
		<td<?php echo $expert->username->CellAttributes() ?>>
<div<?php echo $expert->username->ViewAttributes() ?>><?php echo $expert->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expert->title->Visible) { // title ?>
	<tr<?php echo $expert->title->RowAttributes ?>>
		<td class="ewTableHeader">专家头衔</td>
		<td<?php echo $expert->title->CellAttributes() ?>>
<div<?php echo $expert->title->ViewAttributes() ?>><?php echo $expert->title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expert->userpic->Visible) { // userpic ?>
	<tr<?php echo $expert->userpic->RowAttributes ?>>
		<td class="ewTableHeader">专家头像</td>
		<td<?php echo $expert->userpic->CellAttributes() ?>>
<?php if ($expert->userpic->HrefValue <> "") { ?>
<?php if (!is_null($expert->userpic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $expert->userpic->Upload->DbValue ?>" border=0<?php echo $expert->userpic->ViewAttributes() ?>>
<?php } elseif (!in_array($expert->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($expert->userpic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $expert->userpic->Upload->DbValue ?>" border=0<?php echo $expert->userpic->ViewAttributes() ?>>
<?php } elseif (!in_array($expert->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($expert->userdesc->Visible) { // userdesc ?>
	<tr<?php echo $expert->userdesc->RowAttributes ?>>
		<td class="ewTableHeader">专家描述</td>
		<td<?php echo $expert->userdesc->CellAttributes() ?>>
<div<?php echo $expert->userdesc->ViewAttributes() ?>><?php echo $expert->userdesc->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($expert->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expert_view->Pager)) $expert_view->Pager = new cPrevNextPager($expert_view->lStartRec, $expert_view->lDisplayRecs, $expert_view->lTotalRecs) ?>
<?php if ($expert_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($expert_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expert_view->PageUrl() ?>start=<?php echo $expert_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expert_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expert_view->PageUrl() ?>start=<?php echo $expert_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expert_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expert_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expert_view->PageUrl() ?>start=<?php echo $expert_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expert_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expert_view->PageUrl() ?>start=<?php echo $expert_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $expert_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($expert_view->sSrchWhere == "0=101") { ?>
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
<?php if ($expert->Export == "") { ?>
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
class cexpert_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'expert';

	// Page Object Name
	var $PageObjName = 'expert_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expert;
		if ($expert->UseTokenInUrl) $PageUrl .= "t=" . $expert->TableVar . "&"; // add page token
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
		global $objForm, $expert;
		if ($expert->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($expert->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expert->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cexpert_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["expert"] = new cexpert();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expert', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $expert;
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
		global $expert;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$expert->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$expert->CurrentAction = "I"; // Display form
			switch ($expert->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("expertlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($expert->id->CurrentValue) == strval($rs->fields('id'))) {
								$expert->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "expertlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "expertlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$expert->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $expert;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$expert->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$expert->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $expert->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$expert->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$expert->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$expert->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expert;

		// Call Recordset Selecting event
		$expert->Recordset_Selecting($expert->CurrentFilter);

		// Load list page SQL
		$sSql = $expert->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$expert->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expert;
		$sFilter = $expert->KeyFilter();

		// Call Row Selecting event
		$expert->Row_Selecting($sFilter);

		// Load sql based on filter
		$expert->CurrentFilter = $sFilter;
		$sSql = $expert->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$expert->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $expert;
		$expert->id->setDbValue($rs->fields('id'));
		$expert->username->setDbValue($rs->fields('username'));
		$expert->title->setDbValue($rs->fields('title'));
		$expert->userpic->Upload->DbValue = $rs->fields('userpic');
		$expert->userdesc->setDbValue($rs->fields('userdesc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $expert;

		// Call Row_Rendering event
		$expert->Row_Rendering();

		// Common render codes for all row types
		// id

		$expert->id->CellCssStyle = "";
		$expert->id->CellCssClass = "";

		// username
		$expert->username->CellCssStyle = "";
		$expert->username->CellCssClass = "";

		// title
		$expert->title->CellCssStyle = "";
		$expert->title->CellCssClass = "";

		// userpic
		$expert->userpic->CellCssStyle = "";
		$expert->userpic->CellCssClass = "";

		// userdesc
		$expert->userdesc->CellCssStyle = "";
		$expert->userdesc->CellCssClass = "";
		if ($expert->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expert->id->ViewValue = $expert->id->CurrentValue;
			$expert->id->CssStyle = "";
			$expert->id->CssClass = "";
			$expert->id->ViewCustomAttributes = "";

			// username
			$expert->username->ViewValue = $expert->username->CurrentValue;
			$expert->username->CssStyle = "";
			$expert->username->CssClass = "";
			$expert->username->ViewCustomAttributes = "";

			// title
			$expert->title->ViewValue = $expert->title->CurrentValue;
			$expert->title->CssStyle = "";
			$expert->title->CssClass = "";
			$expert->title->ViewCustomAttributes = "";

			// userpic
			if (!is_null($expert->userpic->Upload->DbValue)) {
				$expert->userpic->ViewValue = $expert->userpic->Upload->DbValue;
				$expert->userpic->ImageWidth = 160;
				$expert->userpic->ImageHeight = 200;
				$expert->userpic->ImageAlt = "";
			} else {
				$expert->userpic->ViewValue = "";
			}
			$expert->userpic->CssStyle = "";
			$expert->userpic->CssClass = "";
			$expert->userpic->ViewCustomAttributes = "";

			// userdesc
			$expert->userdesc->ViewValue = $expert->userdesc->CurrentValue;
			$expert->userdesc->CssStyle = "";
			$expert->userdesc->CssClass = "";
			$expert->userdesc->ViewCustomAttributes = "";

			// id
			$expert->id->HrefValue = "";

			// username
			$expert->username->HrefValue = "";

			// title
			$expert->title->HrefValue = "";

			// userpic
			$expert->userpic->HrefValue = "";

			// userdesc
			$expert->userdesc->HrefValue = "";
		}

		// Call Row Rendered event
		$expert->Row_Rendered();
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
