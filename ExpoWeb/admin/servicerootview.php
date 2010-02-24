<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "servicerootinfo.php" ?>
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
$serviceroot_view = new cserviceroot_view();
$Page =& $serviceroot_view;

// Page init processing
$serviceroot_view->Page_Init();

// Page main processing
$serviceroot_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($serviceroot->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var serviceroot_view = new ew_Page("serviceroot_view");

// page properties
serviceroot_view.PageID = "view"; // page ID
var EW_PAGE_ID = serviceroot_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
serviceroot_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
serviceroot_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
serviceroot_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
serviceroot_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Serviceroot
<br><br>
<?php if ($serviceroot->Export == "") { ?>
<a href="servicerootlist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $serviceroot->AddUrl() ?>">添加</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $serviceroot->EditUrl() ?>">编辑</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $serviceroot->CopyUrl() ?>">复制</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $serviceroot->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $serviceroot_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($serviceroot->id->Visible) { // id ?>
	<tr<?php echo $serviceroot->id->RowAttributes ?>>
		<td class="ewTableHeader">根类型ID</td>
		<td<?php echo $serviceroot->id->CellAttributes() ?>>
<div<?php echo $serviceroot->id->ViewAttributes() ?>><?php echo $serviceroot->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($serviceroot->rootname->Visible) { // rootname ?>
	<tr<?php echo $serviceroot->rootname->RowAttributes ?>>
		<td class="ewTableHeader">根类型名</td>
		<td<?php echo $serviceroot->rootname->CellAttributes() ?>>
<div<?php echo $serviceroot->rootname->ViewAttributes() ?>><?php echo $serviceroot->rootname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($serviceroot->rootorder->Visible) { // rootorder ?>
	<tr<?php echo $serviceroot->rootorder->RowAttributes ?>>
		<td class="ewTableHeader">根类型排序</td>
		<td<?php echo $serviceroot->rootorder->CellAttributes() ?>>
<div<?php echo $serviceroot->rootorder->ViewAttributes() ?>><?php echo $serviceroot->rootorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($serviceroot->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($serviceroot_view->Pager)) $serviceroot_view->Pager = new cPrevNextPager($serviceroot_view->lStartRec, $serviceroot_view->lDisplayRecs, $serviceroot_view->lTotalRecs) ?>
<?php if ($serviceroot_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($serviceroot_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_view->PageUrl() ?>start=<?php echo $serviceroot_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($serviceroot_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_view->PageUrl() ?>start=<?php echo $serviceroot_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $serviceroot_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($serviceroot_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_view->PageUrl() ?>start=<?php echo $serviceroot_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($serviceroot_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $serviceroot_view->PageUrl() ?>start=<?php echo $serviceroot_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $serviceroot_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($serviceroot_view->sSrchWhere == "0=101") { ?>
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
<?php if ($serviceroot->Export == "") { ?>
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
class cserviceroot_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'serviceroot';

	// Page Object Name
	var $PageObjName = 'serviceroot_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $serviceroot;
		if ($serviceroot->UseTokenInUrl) $PageUrl .= "t=" . $serviceroot->TableVar . "&"; // add page token
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
		global $objForm, $serviceroot;
		if ($serviceroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($serviceroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($serviceroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cserviceroot_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["serviceroot"] = new cserviceroot();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'serviceroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $serviceroot;
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
		global $serviceroot;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$serviceroot->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$serviceroot->CurrentAction = "I"; // Display form
			switch ($serviceroot->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("servicerootlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($serviceroot->id->CurrentValue) == strval($rs->fields('id'))) {
								$serviceroot->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "servicerootlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "servicerootlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$serviceroot->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $serviceroot;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$serviceroot->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$serviceroot->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $serviceroot->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$serviceroot->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$serviceroot->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$serviceroot->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $serviceroot;

		// Call Recordset Selecting event
		$serviceroot->Recordset_Selecting($serviceroot->CurrentFilter);

		// Load list page SQL
		$sSql = $serviceroot->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$serviceroot->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $serviceroot;
		$sFilter = $serviceroot->KeyFilter();

		// Call Row Selecting event
		$serviceroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$serviceroot->CurrentFilter = $sFilter;
		$sSql = $serviceroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$serviceroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $serviceroot;
		$serviceroot->id->setDbValue($rs->fields('id'));
		$serviceroot->rootname->setDbValue($rs->fields('rootname'));
		$serviceroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $serviceroot;

		// Call Row_Rendering event
		$serviceroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$serviceroot->id->CellCssStyle = "";
		$serviceroot->id->CellCssClass = "";

		// rootname
		$serviceroot->rootname->CellCssStyle = "";
		$serviceroot->rootname->CellCssClass = "";

		// rootorder
		$serviceroot->rootorder->CellCssStyle = "";
		$serviceroot->rootorder->CellCssClass = "";
		if ($serviceroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$serviceroot->id->ViewValue = $serviceroot->id->CurrentValue;
			$serviceroot->id->CssStyle = "";
			$serviceroot->id->CssClass = "";
			$serviceroot->id->ViewCustomAttributes = "";

			// rootname
			$serviceroot->rootname->ViewValue = $serviceroot->rootname->CurrentValue;
			$serviceroot->rootname->CssStyle = "";
			$serviceroot->rootname->CssClass = "";
			$serviceroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$serviceroot->rootorder->ViewValue = $serviceroot->rootorder->CurrentValue;
			$serviceroot->rootorder->CssStyle = "";
			$serviceroot->rootorder->CssClass = "";
			$serviceroot->rootorder->ViewCustomAttributes = "";

			// id
			$serviceroot->id->HrefValue = "";

			// rootname
			$serviceroot->rootname->HrefValue = "";

			// rootorder
			$serviceroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$serviceroot->Row_Rendered();
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
