<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "friendlinkinfo.php" ?>
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
$friendlink_view = new cfriendlink_view();
$Page =& $friendlink_view;

// Page init processing
$friendlink_view->Page_Init();

// Page main processing
$friendlink_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($friendlink->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var friendlink_view = new ew_Page("friendlink_view");

// page properties
friendlink_view.PageID = "view"; // page ID
var EW_PAGE_ID = friendlink_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
friendlink_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
friendlink_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
friendlink_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
friendlink_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Friendlink
<br><br>
<?php if ($friendlink->Export == "") { ?>
<a href="friendlinklist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $friendlink->AddUrl() ?>">添加</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $friendlink->EditUrl() ?>">编辑</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $friendlink->CopyUrl() ?>">复制</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $friendlink->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $friendlink_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($friendlink->id->Visible) { // id ?>
	<tr<?php echo $friendlink->id->RowAttributes ?>>
		<td class="ewTableHeader">链接ID</td>
		<td<?php echo $friendlink->id->CellAttributes() ?>>
<div<?php echo $friendlink->id->ViewAttributes() ?>><?php echo $friendlink->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($friendlink->linkname->Visible) { // linkname ?>
	<tr<?php echo $friendlink->linkname->RowAttributes ?>>
		<td class="ewTableHeader">链接名称</td>
		<td<?php echo $friendlink->linkname->CellAttributes() ?>>
<div<?php echo $friendlink->linkname->ViewAttributes() ?>><?php echo $friendlink->linkname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($friendlink->linkaddress->Visible) { // linkaddress ?>
	<tr<?php echo $friendlink->linkaddress->RowAttributes ?>>
		<td class="ewTableHeader">链接地址</td>
		<td<?php echo $friendlink->linkaddress->CellAttributes() ?>>
<div<?php echo $friendlink->linkaddress->ViewAttributes() ?>><?php echo $friendlink->linkaddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($friendlink->linkorder->Visible) { // linkorder ?>
	<tr<?php echo $friendlink->linkorder->RowAttributes ?>>
		<td class="ewTableHeader">链接排序</td>
		<td<?php echo $friendlink->linkorder->CellAttributes() ?>>
<div<?php echo $friendlink->linkorder->ViewAttributes() ?>><?php echo $friendlink->linkorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($friendlink->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($friendlink_view->Pager)) $friendlink_view->Pager = new cPrevNextPager($friendlink_view->lStartRec, $friendlink_view->lDisplayRecs, $friendlink_view->lTotalRecs) ?>
<?php if ($friendlink_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($friendlink_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_view->PageUrl() ?>start=<?php echo $friendlink_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($friendlink_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_view->PageUrl() ?>start=<?php echo $friendlink_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $friendlink_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($friendlink_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_view->PageUrl() ?>start=<?php echo $friendlink_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($friendlink_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $friendlink_view->PageUrl() ?>start=<?php echo $friendlink_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $friendlink_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($friendlink_view->sSrchWhere == "0=101") { ?>
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
<?php if ($friendlink->Export == "") { ?>
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
class cfriendlink_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'friendlink';

	// Page Object Name
	var $PageObjName = 'friendlink_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $friendlink;
		if ($friendlink->UseTokenInUrl) $PageUrl .= "t=" . $friendlink->TableVar . "&"; // add page token
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
		global $objForm, $friendlink;
		if ($friendlink->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($friendlink->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($friendlink->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cfriendlink_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["friendlink"] = new cfriendlink();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'friendlink', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $friendlink;
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
		global $friendlink;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$friendlink->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$friendlink->CurrentAction = "I"; // Display form
			switch ($friendlink->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("friendlinklist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($friendlink->id->CurrentValue) == strval($rs->fields('id'))) {
								$friendlink->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "friendlinklist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "friendlinklist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$friendlink->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $friendlink;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$friendlink->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$friendlink->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $friendlink->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$friendlink->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$friendlink->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$friendlink->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $friendlink;

		// Call Recordset Selecting event
		$friendlink->Recordset_Selecting($friendlink->CurrentFilter);

		// Load list page SQL
		$sSql = $friendlink->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$friendlink->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $friendlink;
		$sFilter = $friendlink->KeyFilter();

		// Call Row Selecting event
		$friendlink->Row_Selecting($sFilter);

		// Load sql based on filter
		$friendlink->CurrentFilter = $sFilter;
		$sSql = $friendlink->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$friendlink->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $friendlink;
		$friendlink->id->setDbValue($rs->fields('id'));
		$friendlink->linkname->setDbValue($rs->fields('linkname'));
		$friendlink->linkaddress->setDbValue($rs->fields('linkaddress'));
		$friendlink->linkorder->setDbValue($rs->fields('linkorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $friendlink;

		// Call Row_Rendering event
		$friendlink->Row_Rendering();

		// Common render codes for all row types
		// id

		$friendlink->id->CellCssStyle = "";
		$friendlink->id->CellCssClass = "";

		// linkname
		$friendlink->linkname->CellCssStyle = "";
		$friendlink->linkname->CellCssClass = "";

		// linkaddress
		$friendlink->linkaddress->CellCssStyle = "";
		$friendlink->linkaddress->CellCssClass = "";

		// linkorder
		$friendlink->linkorder->CellCssStyle = "";
		$friendlink->linkorder->CellCssClass = "";
		if ($friendlink->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$friendlink->id->ViewValue = $friendlink->id->CurrentValue;
			$friendlink->id->CssStyle = "";
			$friendlink->id->CssClass = "";
			$friendlink->id->ViewCustomAttributes = "";

			// linkname
			$friendlink->linkname->ViewValue = $friendlink->linkname->CurrentValue;
			$friendlink->linkname->CssStyle = "";
			$friendlink->linkname->CssClass = "";
			$friendlink->linkname->ViewCustomAttributes = "";

			// linkaddress
			$friendlink->linkaddress->ViewValue = $friendlink->linkaddress->CurrentValue;
			$friendlink->linkaddress->CssStyle = "";
			$friendlink->linkaddress->CssClass = "";
			$friendlink->linkaddress->ViewCustomAttributes = "";

			// linkorder
			$friendlink->linkorder->ViewValue = $friendlink->linkorder->CurrentValue;
			$friendlink->linkorder->CssStyle = "";
			$friendlink->linkorder->CssClass = "";
			$friendlink->linkorder->ViewCustomAttributes = "";

			// id
			$friendlink->id->HrefValue = "";

			// linkname
			$friendlink->linkname->HrefValue = "";

			// linkaddress
			$friendlink->linkaddress->HrefValue = "";

			// linkorder
			$friendlink->linkorder->HrefValue = "";
		}

		// Call Row Rendered event
		$friendlink->Row_Rendered();
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
