<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "serviceinfo.php" ?>
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
$service_view = new cservice_view();
$Page =& $service_view;

// Page init processing
$service_view->Page_Init();

// Page main processing
$service_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($service->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var service_view = new ew_Page("service_view");

// page properties
service_view.PageID = "view"; // page ID
var EW_PAGE_ID = service_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
service_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
service_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
service_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
service_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Service
<br><br>
<?php if ($service->Export == "") { ?>
<a href="servicelist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->AddUrl() ?>">添加</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->EditUrl() ?>">编辑</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->CopyUrl() ?>">复制</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $service->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $service_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($service->id->Visible) { // id ?>
	<tr<?php echo $service->id->RowAttributes ?>>
		<td class="ewTableHeader">服务ID</td>
		<td<?php echo $service->id->CellAttributes() ?>>
<div<?php echo $service->id->ViewAttributes() ?>><?php echo $service->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->servicename->Visible) { // servicename ?>
	<tr<?php echo $service->servicename->RowAttributes ?>>
		<td class="ewTableHeader">服务名称</td>
		<td<?php echo $service->servicename->CellAttributes() ?>>
<div<?php echo $service->servicename->ViewAttributes() ?>><?php echo $service->servicename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->pubtime->Visible) { // pubtime ?>
	<tr<?php echo $service->pubtime->RowAttributes ?>>
		<td class="ewTableHeader">发布时间</td>
		<td<?php echo $service->pubtime->CellAttributes() ?>>
<div<?php echo $service->pubtime->ViewAttributes() ?>><?php echo $service->pubtime->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->servicedesc->Visible) { // servicedesc ?>
	<tr<?php echo $service->servicedesc->RowAttributes ?>>
		<td class="ewTableHeader">服务描述</td>
		<td<?php echo $service->servicedesc->CellAttributes() ?>>
<div<?php echo $service->servicedesc->ViewAttributes() ?>><?php echo $service->servicedesc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->rootid->Visible) { // rootid ?>
	<tr<?php echo $service->rootid->RowAttributes ?>>
		<td class="ewTableHeader">根类型</td>
		<td<?php echo $service->rootid->CellAttributes() ?>>
<div<?php echo $service->rootid->ViewAttributes() ?>><?php echo $service->rootid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->catid->Visible) { // catid ?>
	<tr<?php echo $service->catid->RowAttributes ?>>
		<td class="ewTableHeader">服务类型</td>
		<td<?php echo $service->catid->CellAttributes() ?>>
<div<?php echo $service->catid->ViewAttributes() ?>><?php echo $service->catid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->servicepic->Visible) { // servicepic ?>
	<tr<?php echo $service->servicepic->RowAttributes ?>>
		<td class="ewTableHeader">服务图片</td>
		<td<?php echo $service->servicepic->CellAttributes() ?>>
<?php if ($service->servicepic->HrefValue <> "") { ?>
<?php if (!is_null($service->servicepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $service->servicepic->Upload->DbValue ?>" border=0<?php echo $service->servicepic->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($service->servicepic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $service->servicepic->Upload->DbValue ?>" border=0<?php echo $service->servicepic->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($service->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($service_view->Pager)) $service_view->Pager = new cPrevNextPager($service_view->lStartRec, $service_view->lDisplayRecs, $service_view->lTotalRecs) ?>
<?php if ($service_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($service_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $service_view->PageUrl() ?>start=<?php echo $service_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($service_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $service_view->PageUrl() ?>start=<?php echo $service_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $service_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($service_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $service_view->PageUrl() ?>start=<?php echo $service_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($service_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $service_view->PageUrl() ?>start=<?php echo $service_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $service_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($service_view->sSrchWhere == "0=101") { ?>
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
<?php if ($service->Export == "") { ?>
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
class cservice_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'service';

	// Page Object Name
	var $PageObjName = 'service_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $service;
		if ($service->UseTokenInUrl) $PageUrl .= "t=" . $service->TableVar . "&"; // add page token
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
		global $objForm, $service;
		if ($service->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservice_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["service"] = new cservice();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'service', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $service;
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
		global $service;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$service->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$service->CurrentAction = "I"; // Display form
			switch ($service->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("servicelist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($service->id->CurrentValue) == strval($rs->fields('id'))) {
								$service->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "servicelist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "servicelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$service->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $service;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$service->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$service->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $service->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$service->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $service;

		// Call Recordset Selecting event
		$service->Recordset_Selecting($service->CurrentFilter);

		// Load list page SQL
		$sSql = $service->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$service->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $service;
		$sFilter = $service->KeyFilter();

		// Call Row Selecting event
		$service->Row_Selecting($sFilter);

		// Load sql based on filter
		$service->CurrentFilter = $sFilter;
		$sSql = $service->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$service->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $service;
		$service->id->setDbValue($rs->fields('id'));
		$service->servicename->setDbValue($rs->fields('servicename'));
		$service->pubtime->setDbValue($rs->fields('pubtime'));
		$service->servicedesc->setDbValue($rs->fields('servicedesc'));
		$service->rootid->setDbValue($rs->fields('rootid'));
		$service->catid->setDbValue($rs->fields('catid'));
		$service->servicepic->Upload->DbValue = $rs->fields('servicepic');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $service;

		// Call Row_Rendering event
		$service->Row_Rendering();

		// Common render codes for all row types
		// id

		$service->id->CellCssStyle = "";
		$service->id->CellCssClass = "";

		// servicename
		$service->servicename->CellCssStyle = "";
		$service->servicename->CellCssClass = "";

		// pubtime
		$service->pubtime->CellCssStyle = "";
		$service->pubtime->CellCssClass = "";

		// servicedesc
		$service->servicedesc->CellCssStyle = "";
		$service->servicedesc->CellCssClass = "";

		// rootid
		$service->rootid->CellCssStyle = "";
		$service->rootid->CellCssClass = "";

		// catid
		$service->catid->CellCssStyle = "";
		$service->catid->CellCssClass = "";

		// servicepic
		$service->servicepic->CellCssStyle = "";
		$service->servicepic->CellCssClass = "";
		if ($service->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$service->id->ViewValue = $service->id->CurrentValue;
			$service->id->CssStyle = "";
			$service->id->CssClass = "";
			$service->id->ViewCustomAttributes = "";

			// servicename
			$service->servicename->ViewValue = $service->servicename->CurrentValue;
			$service->servicename->CssStyle = "";
			$service->servicename->CssClass = "";
			$service->servicename->ViewCustomAttributes = "";

			// pubtime
			$service->pubtime->ViewValue = $service->pubtime->CurrentValue;
			$service->pubtime->ViewValue = ew_FormatDateTime($service->pubtime->ViewValue, 5);
			$service->pubtime->CssStyle = "";
			$service->pubtime->CssClass = "";
			$service->pubtime->ViewCustomAttributes = "";

			// servicedesc
			$service->servicedesc->ViewValue = $service->servicedesc->CurrentValue;
			$service->servicedesc->CssStyle = "";
			$service->servicedesc->CssClass = "";
			$service->servicedesc->ViewCustomAttributes = "";

			// rootid
			if (strval($service->rootid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `rootname` FROM `serviceroot` WHERE `id` = " . ew_AdjustSql($service->rootid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$service->rootid->ViewValue = $rswrk->fields('rootname');
					$rswrk->Close();
				} else {
					$service->rootid->ViewValue = $service->rootid->CurrentValue;
				}
			} else {
				$service->rootid->ViewValue = NULL;
			}
			$service->rootid->CssStyle = "";
			$service->rootid->CssClass = "";
			$service->rootid->ViewCustomAttributes = "";

			// catid
			if (strval($service->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `servicecat` WHERE `id` = " . ew_AdjustSql($service->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$service->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$service->catid->ViewValue = $service->catid->CurrentValue;
				}
			} else {
				$service->catid->ViewValue = NULL;
			}
			$service->catid->CssStyle = "";
			$service->catid->CssClass = "";
			$service->catid->ViewCustomAttributes = "";

			// servicepic
			if (!is_null($service->servicepic->Upload->DbValue)) {
				$service->servicepic->ViewValue = $service->servicepic->Upload->DbValue;
				$service->servicepic->ImageAlt = "";
			} else {
				$service->servicepic->ViewValue = "";
			}
			$service->servicepic->CssStyle = "";
			$service->servicepic->CssClass = "";
			$service->servicepic->ViewCustomAttributes = "";

			// id
			$service->id->HrefValue = "";

			// servicename
			$service->servicename->HrefValue = "";

			// pubtime
			$service->pubtime->HrefValue = "";

			// servicedesc
			$service->servicedesc->HrefValue = "";

			// rootid
			$service->rootid->HrefValue = "";

			// catid
			$service->catid->HrefValue = "";

			// servicepic
			$service->servicepic->HrefValue = "";
		}

		// Call Row Rendered event
		$service->Row_Rendered();
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
