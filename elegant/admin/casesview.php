<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesinfo.php" ?>
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
$cases_view = new ccases_view();
$Page =& $cases_view;

// Page init processing
$cases_view->Page_Init();

// Page main processing
$cases_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cases->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cases_view = new ew_Page("cases_view");

// page properties
cases_view.PageID = "view"; // page ID
var EW_PAGE_ID = cases_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cases_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
cases_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
cases_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cases_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Cases
<br><br>
<?php if ($cases->Export == "") { ?>
<a href="caseslist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cases->AddUrl() ?>">添加</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cases->EditUrl() ?>">编辑</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cases->CopyUrl() ?>">复制</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $cases->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $cases_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cases->id->Visible) { // id ?>
	<tr<?php echo $cases->id->RowAttributes ?>>
		<td class="ewTableHeader">案例ID</td>
		<td<?php echo $cases->id->CellAttributes() ?>>
<div<?php echo $cases->id->ViewAttributes() ?>><?php echo $cases->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->casetitle->Visible) { // casetitle ?>
	<tr<?php echo $cases->casetitle->RowAttributes ?>>
		<td class="ewTableHeader">案例标题</td>
		<td<?php echo $cases->casetitle->CellAttributes() ?>>
<div<?php echo $cases->casetitle->ViewAttributes() ?>><?php echo $cases->casetitle->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->rootid->Visible) { // rootid ?>
	<tr<?php echo $cases->rootid->RowAttributes ?>>
		<td class="ewTableHeader">案例根类</td>
		<td<?php echo $cases->rootid->CellAttributes() ?>>
<div<?php echo $cases->rootid->ViewAttributes() ?>><?php echo $cases->rootid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->catid->Visible) { // catid ?>
	<tr<?php echo $cases->catid->RowAttributes ?>>
		<td class="ewTableHeader">案例类型</td>
		<td<?php echo $cases->catid->CellAttributes() ?>>
<div<?php echo $cases->catid->ViewAttributes() ?>><?php echo $cases->catid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->casedesc->Visible) { // casedesc ?>
	<tr<?php echo $cases->casedesc->RowAttributes ?>>
		<td class="ewTableHeader">案例描述</td>
		<td<?php echo $cases->casedesc->CellAttributes() ?>>
<div<?php echo $cases->casedesc->ViewAttributes() ?>><?php echo $cases->casedesc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cases->casepic1->Visible) { // casepic1 ?>
	<tr<?php echo $cases->casepic1->RowAttributes ?>>
		<td class="ewTableHeader">案例图片1</td>
		<td<?php echo $cases->casepic1->CellAttributes() ?>>
<?php if ($cases->casepic1->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic1->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic1->Upload->DbValue ?>" border=0<?php echo $cases->casepic1->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic1->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic1->Upload->DbValue ?>" border=0<?php echo $cases->casepic1->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casepic2->Visible) { // casepic2 ?>
	<tr<?php echo $cases->casepic2->RowAttributes ?>>
		<td class="ewTableHeader">案例图片2</td>
		<td<?php echo $cases->casepic2->CellAttributes() ?>>
<?php if ($cases->casepic2->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic2->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic2->Upload->DbValue ?>" border=0<?php echo $cases->casepic2->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic2->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic2->Upload->DbValue ?>" border=0<?php echo $cases->casepic2->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casepic3->Visible) { // casepic3 ?>
	<tr<?php echo $cases->casepic3->RowAttributes ?>>
		<td class="ewTableHeader">案例图片3</td>
		<td<?php echo $cases->casepic3->CellAttributes() ?>>
<?php if ($cases->casepic3->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic3->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic3->Upload->DbValue ?>" border=0<?php echo $cases->casepic3->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic3->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic3->Upload->DbValue ?>" border=0<?php echo $cases->casepic3->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casepic4->Visible) { // casepic4 ?>
	<tr<?php echo $cases->casepic4->RowAttributes ?>>
		<td class="ewTableHeader">案例图片4</td>
		<td<?php echo $cases->casepic4->CellAttributes() ?>>
<?php if ($cases->casepic4->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic4->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic4->Upload->DbValue ?>" border=0<?php echo $cases->casepic4->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic4->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic4->Upload->DbValue ?>" border=0<?php echo $cases->casepic4->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casepic5->Visible) { // casepic5 ?>
	<tr<?php echo $cases->casepic5->RowAttributes ?>>
		<td class="ewTableHeader">案例图片5</td>
		<td<?php echo $cases->casepic5->CellAttributes() ?>>
<?php if ($cases->casepic5->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic5->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic5->Upload->DbValue ?>" border=0<?php echo $cases->casepic5->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic5->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic5->Upload->DbValue ?>" border=0<?php echo $cases->casepic5->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casepic6->Visible) { // casepic6 ?>
	<tr<?php echo $cases->casepic6->RowAttributes ?>>
		<td class="ewTableHeader">案例图片6</td>
		<td<?php echo $cases->casepic6->CellAttributes() ?>>
<?php if ($cases->casepic6->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic6->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic6->Upload->DbValue ?>" border=0<?php echo $cases->casepic6->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic6->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic6->Upload->DbValue ?>" border=0<?php echo $cases->casepic6->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casepic7->Visible) { // casepic7 ?>
	<tr<?php echo $cases->casepic7->RowAttributes ?>>
		<td class="ewTableHeader">案例图片7</td>
		<td<?php echo $cases->casepic7->CellAttributes() ?>>
<?php if ($cases->casepic7->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic7->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic7->Upload->DbValue ?>" border=0<?php echo $cases->casepic7->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic7->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic7->Upload->DbValue ?>" border=0<?php echo $cases->casepic7->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->casepic8->Visible) { // casepic8 ?>
	<tr<?php echo $cases->casepic8->RowAttributes ?>>
		<td class="ewTableHeader">案例图片8</td>
		<td<?php echo $cases->casepic8->CellAttributes() ?>>
<?php if ($cases->casepic8->HrefValue <> "") { ?>
<?php if (!is_null($cases->casepic8->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic8->Upload->DbValue ?>" border=0<?php echo $cases->casepic8->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cases->casepic8->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $cases->casepic8->Upload->DbValue ?>" border=0<?php echo $cases->casepic8->ViewAttributes() ?>>
<?php } elseif (!in_array($cases->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cases->caseorder->Visible) { // caseorder ?>
	<tr<?php echo $cases->caseorder->RowAttributes ?>>
		<td class="ewTableHeader">案例排序</td>
		<td<?php echo $cases->caseorder->CellAttributes() ?>>
<div<?php echo $cases->caseorder->ViewAttributes() ?>><?php echo $cases->caseorder->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($cases->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($cases_view->Pager)) $cases_view->Pager = new cPrevNextPager($cases_view->lStartRec, $cases_view->lDisplayRecs, $cases_view->lTotalRecs) ?>
<?php if ($cases_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($cases_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $cases_view->PageUrl() ?>start=<?php echo $cases_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($cases_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $cases_view->PageUrl() ?>start=<?php echo $cases_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cases_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($cases_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $cases_view->PageUrl() ?>start=<?php echo $cases_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($cases_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $cases_view->PageUrl() ?>start=<?php echo $cases_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $cases_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($cases_view->sSrchWhere == "0=101") { ?>
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
<?php if ($cases->Export == "") { ?>
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
class ccases_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'cases';

	// Page Object Name
	var $PageObjName = 'cases_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cases;
		if ($cases->UseTokenInUrl) $PageUrl .= "t=" . $cases->TableVar . "&"; // add page token
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
		global $objForm, $cases;
		if ($cases->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cases->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cases->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccases_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["cases"] = new ccases();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cases', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cases;
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
		global $cases;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$cases->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$cases->CurrentAction = "I"; // Display form
			switch ($cases->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("caseslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($cases->id->CurrentValue) == strval($rs->fields('id'))) {
								$cases->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "caseslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "caseslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$cases->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $cases;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$cases->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$cases->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $cases->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$cases->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$cases->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$cases->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cases;

		// Call Recordset Selecting event
		$cases->Recordset_Selecting($cases->CurrentFilter);

		// Load list page SQL
		$sSql = $cases->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cases->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cases;
		$sFilter = $cases->KeyFilter();

		// Call Row Selecting event
		$cases->Row_Selecting($sFilter);

		// Load sql based on filter
		$cases->CurrentFilter = $sFilter;
		$sSql = $cases->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cases->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cases;
		$cases->id->setDbValue($rs->fields('id'));
		$cases->casetitle->setDbValue($rs->fields('casetitle'));
		$cases->rootid->setDbValue($rs->fields('rootid'));
		$cases->catid->setDbValue($rs->fields('catid'));
		$cases->casedesc->setDbValue($rs->fields('casedesc'));
		$cases->casepic1->Upload->DbValue = $rs->fields('casepic1');
		$cases->casepic2->Upload->DbValue = $rs->fields('casepic2');
		$cases->casepic3->Upload->DbValue = $rs->fields('casepic3');
		$cases->casepic4->Upload->DbValue = $rs->fields('casepic4');
		$cases->casepic5->Upload->DbValue = $rs->fields('casepic5');
		$cases->casepic6->Upload->DbValue = $rs->fields('casepic6');
		$cases->casepic7->Upload->DbValue = $rs->fields('casepic7');
		$cases->casepic8->Upload->DbValue = $rs->fields('casepic8');
		$cases->caseorder->setDbValue($rs->fields('caseorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cases;

		// Call Row_Rendering event
		$cases->Row_Rendering();

		// Common render codes for all row types
		// id

		$cases->id->CellCssStyle = "";
		$cases->id->CellCssClass = "";

		// casetitle
		$cases->casetitle->CellCssStyle = "";
		$cases->casetitle->CellCssClass = "";

		// rootid
		$cases->rootid->CellCssStyle = "";
		$cases->rootid->CellCssClass = "";

		// catid
		$cases->catid->CellCssStyle = "";
		$cases->catid->CellCssClass = "";

		// casedesc
		$cases->casedesc->CellCssStyle = "";
		$cases->casedesc->CellCssClass = "";

		// casepic1
		$cases->casepic1->CellCssStyle = "";
		$cases->casepic1->CellCssClass = "";

		// casepic2
		$cases->casepic2->CellCssStyle = "";
		$cases->casepic2->CellCssClass = "";

		// casepic3
		$cases->casepic3->CellCssStyle = "";
		$cases->casepic3->CellCssClass = "";

		// casepic4
		$cases->casepic4->CellCssStyle = "";
		$cases->casepic4->CellCssClass = "";

		// casepic5
		$cases->casepic5->CellCssStyle = "";
		$cases->casepic5->CellCssClass = "";

		// casepic6
		$cases->casepic6->CellCssStyle = "";
		$cases->casepic6->CellCssClass = "";

		// casepic7
		$cases->casepic7->CellCssStyle = "";
		$cases->casepic7->CellCssClass = "";

		// casepic8
		$cases->casepic8->CellCssStyle = "";
		$cases->casepic8->CellCssClass = "";

		// caseorder
		$cases->caseorder->CellCssStyle = "";
		$cases->caseorder->CellCssClass = "";
		if ($cases->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cases->id->ViewValue = $cases->id->CurrentValue;
			$cases->id->CssStyle = "";
			$cases->id->CssClass = "";
			$cases->id->ViewCustomAttributes = "";

			// casetitle
			$cases->casetitle->ViewValue = $cases->casetitle->CurrentValue;
			$cases->casetitle->CssStyle = "";
			$cases->casetitle->CssClass = "";
			$cases->casetitle->ViewCustomAttributes = "";

			// rootid
			if (strval($cases->rootid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `rootname` FROM `casesroot` WHERE `id` = " . ew_AdjustSql($cases->rootid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cases->rootid->ViewValue = $rswrk->fields('rootname');
					$rswrk->Close();
				} else {
					$cases->rootid->ViewValue = $cases->rootid->CurrentValue;
				}
			} else {
				$cases->rootid->ViewValue = NULL;
			}
			$cases->rootid->CssStyle = "";
			$cases->rootid->CssClass = "";
			$cases->rootid->ViewCustomAttributes = "";

			// catid
			if (strval($cases->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `casescat` WHERE `id` = " . ew_AdjustSql($cases->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cases->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$cases->catid->ViewValue = $cases->catid->CurrentValue;
				}
			} else {
				$cases->catid->ViewValue = NULL;
			}
			$cases->catid->CssStyle = "";
			$cases->catid->CssClass = "";
			$cases->catid->ViewCustomAttributes = "";

			// casedesc
			$cases->casedesc->ViewValue = $cases->casedesc->CurrentValue;
			$cases->casedesc->CssStyle = "";
			$cases->casedesc->CssClass = "";
			$cases->casedesc->ViewCustomAttributes = "";

			// casepic1
			if (!is_null($cases->casepic1->Upload->DbValue)) {
				$cases->casepic1->ViewValue = $cases->casepic1->Upload->DbValue;
				$cases->casepic1->ImageAlt = "";
			} else {
				$cases->casepic1->ViewValue = "";
			}
			$cases->casepic1->CssStyle = "";
			$cases->casepic1->CssClass = "";
			$cases->casepic1->ViewCustomAttributes = "";

			// casepic2
			if (!is_null($cases->casepic2->Upload->DbValue)) {
				$cases->casepic2->ViewValue = $cases->casepic2->Upload->DbValue;
				$cases->casepic2->ImageAlt = "";
			} else {
				$cases->casepic2->ViewValue = "";
			}
			$cases->casepic2->CssStyle = "";
			$cases->casepic2->CssClass = "";
			$cases->casepic2->ViewCustomAttributes = "";

			// casepic3
			if (!is_null($cases->casepic3->Upload->DbValue)) {
				$cases->casepic3->ViewValue = $cases->casepic3->Upload->DbValue;
				$cases->casepic3->ImageAlt = "";
			} else {
				$cases->casepic3->ViewValue = "";
			}
			$cases->casepic3->CssStyle = "";
			$cases->casepic3->CssClass = "";
			$cases->casepic3->ViewCustomAttributes = "";

			// casepic4
			if (!is_null($cases->casepic4->Upload->DbValue)) {
				$cases->casepic4->ViewValue = $cases->casepic4->Upload->DbValue;
				$cases->casepic4->ImageAlt = "";
			} else {
				$cases->casepic4->ViewValue = "";
			}
			$cases->casepic4->CssStyle = "";
			$cases->casepic4->CssClass = "";
			$cases->casepic4->ViewCustomAttributes = "";

			// casepic5
			if (!is_null($cases->casepic5->Upload->DbValue)) {
				$cases->casepic5->ViewValue = $cases->casepic5->Upload->DbValue;
				$cases->casepic5->ImageAlt = "";
			} else {
				$cases->casepic5->ViewValue = "";
			}
			$cases->casepic5->CssStyle = "";
			$cases->casepic5->CssClass = "";
			$cases->casepic5->ViewCustomAttributes = "";

			// casepic6
			if (!is_null($cases->casepic6->Upload->DbValue)) {
				$cases->casepic6->ViewValue = $cases->casepic6->Upload->DbValue;
				$cases->casepic6->ImageAlt = "";
			} else {
				$cases->casepic6->ViewValue = "";
			}
			$cases->casepic6->CssStyle = "";
			$cases->casepic6->CssClass = "";
			$cases->casepic6->ViewCustomAttributes = "";

			// casepic7
			if (!is_null($cases->casepic7->Upload->DbValue)) {
				$cases->casepic7->ViewValue = $cases->casepic7->Upload->DbValue;
				$cases->casepic7->ImageAlt = "";
			} else {
				$cases->casepic7->ViewValue = "";
			}
			$cases->casepic7->CssStyle = "";
			$cases->casepic7->CssClass = "";
			$cases->casepic7->ViewCustomAttributes = "";

			// casepic8
			if (!is_null($cases->casepic8->Upload->DbValue)) {
				$cases->casepic8->ViewValue = $cases->casepic8->Upload->DbValue;
				$cases->casepic8->ImageAlt = "";
			} else {
				$cases->casepic8->ViewValue = "";
			}
			$cases->casepic8->CssStyle = "";
			$cases->casepic8->CssClass = "";
			$cases->casepic8->ViewCustomAttributes = "";

			// caseorder
			$cases->caseorder->ViewValue = $cases->caseorder->CurrentValue;
			$cases->caseorder->CssStyle = "";
			$cases->caseorder->CssClass = "";
			$cases->caseorder->ViewCustomAttributes = "";

			// id
			$cases->id->HrefValue = "";

			// casetitle
			$cases->casetitle->HrefValue = "";

			// rootid
			$cases->rootid->HrefValue = "";

			// catid
			$cases->catid->HrefValue = "";

			// casedesc
			$cases->casedesc->HrefValue = "";

			// casepic1
			$cases->casepic1->HrefValue = "";

			// casepic2
			$cases->casepic2->HrefValue = "";

			// casepic3
			$cases->casepic3->HrefValue = "";

			// casepic4
			$cases->casepic4->HrefValue = "";

			// casepic5
			$cases->casepic5->HrefValue = "";

			// casepic6
			$cases->casepic6->HrefValue = "";

			// casepic7
			$cases->casepic7->HrefValue = "";

			// casepic8
			$cases->casepic8->HrefValue = "";

			// caseorder
			$cases->caseorder->HrefValue = "";
		}

		// Call Row Rendered event
		$cases->Row_Rendered();
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
