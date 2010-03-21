<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "teaminfo.php" ?>
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
$team_view = new cteam_view();
$Page =& $team_view;

// Page init processing
$team_view->Page_Init();

// Page main processing
$team_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($team->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var team_view = new ew_Page("team_view");

// page properties
team_view.PageID = "view"; // page ID
var EW_PAGE_ID = team_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
team_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
team_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
team_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
team_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: Team
<br><br>
<?php if ($team->Export == "") { ?>
<a href="teamlist.php">回到列表</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $team->AddUrl() ?>">添加</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $team->EditUrl() ?>">编辑</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $team->CopyUrl() ?>">复制</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('你真的要删除吗?');" href="<?php echo $team->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $team_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($team->id->Visible) { // id ?>
	<tr<?php echo $team->id->RowAttributes ?>>
		<td class="ewTableHeader">成员ID</td>
		<td<?php echo $team->id->CellAttributes() ?>>
<div<?php echo $team->id->ViewAttributes() ?>><?php echo $team->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($team->teamname->Visible) { // teamname ?>
	<tr<?php echo $team->teamname->RowAttributes ?>>
		<td class="ewTableHeader">成员名称</td>
		<td<?php echo $team->teamname->CellAttributes() ?>>
<div<?php echo $team->teamname->ViewAttributes() ?>><?php echo $team->teamname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($team->teampic->Visible) { // teampic ?>
	<tr<?php echo $team->teampic->RowAttributes ?>>
		<td class="ewTableHeader">成员图片</td>
		<td<?php echo $team->teampic->CellAttributes() ?>>
<?php if ($team->teampic->HrefValue <> "") { ?>
<?php if (!is_null($team->teampic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $team->teampic->Upload->DbValue ?>" border=0<?php echo $team->teampic->ViewAttributes() ?>>
<?php } elseif (!in_array($team->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($team->teampic->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $team->teampic->Upload->DbValue ?>" border=0<?php echo $team->teampic->ViewAttributes() ?>>
<?php } elseif (!in_array($team->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($team->teamjobs->Visible) { // teamjobs ?>
	<tr<?php echo $team->teamjobs->RowAttributes ?>>
		<td class="ewTableHeader">成员职位</td>
		<td<?php echo $team->teamjobs->CellAttributes() ?>>
<div<?php echo $team->teamjobs->ViewAttributes() ?>><?php echo $team->teamjobs->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($team->teamdesc->Visible) { // teamdesc ?>
	<tr<?php echo $team->teamdesc->RowAttributes ?>>
		<td class="ewTableHeader">成员描述</td>
		<td<?php echo $team->teamdesc->CellAttributes() ?>>
<div<?php echo $team->teamdesc->ViewAttributes() ?>><?php echo $team->teamdesc->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($team->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($team_view->Pager)) $team_view->Pager = new cPrevNextPager($team_view->lStartRec, $team_view->lDisplayRecs, $team_view->lTotalRecs) ?>
<?php if ($team_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">页&nbsp;</span></td>
<!--first page button-->
	<?php if ($team_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $team_view->PageUrl() ?>start=<?php echo $team_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="第一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="第一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($team_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $team_view->PageUrl() ?>start=<?php echo $team_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="上一页" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="上一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $team_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($team_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $team_view->PageUrl() ?>start=<?php echo $team_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="下一页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="下一页" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($team_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $team_view->PageUrl() ?>start=<?php echo $team_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="最后页" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="最后页" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;总共 <?php echo $team_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($team_view->sSrchWhere == "0=101") { ?>
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
<?php if ($team->Export == "") { ?>
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
class cteam_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'team';

	// Page Object Name
	var $PageObjName = 'team_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $team;
		if ($team->UseTokenInUrl) $PageUrl .= "t=" . $team->TableVar . "&"; // add page token
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
		global $objForm, $team;
		if ($team->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($team->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($team->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cteam_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["team"] = new cteam();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'team', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $team;
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
		global $team;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$team->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$team->CurrentAction = "I"; // Display form
			switch ($team->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("没有数据"); // Set no record message
						$this->Page_Terminate("teamlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($team->id->CurrentValue) == strval($rs->fields('id'))) {
								$team->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "teamlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "teamlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$team->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $team;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$team->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$team->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $team->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$team->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$team->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$team->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $team;

		// Call Recordset Selecting event
		$team->Recordset_Selecting($team->CurrentFilter);

		// Load list page SQL
		$sSql = $team->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$team->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $team;
		$sFilter = $team->KeyFilter();

		// Call Row Selecting event
		$team->Row_Selecting($sFilter);

		// Load sql based on filter
		$team->CurrentFilter = $sFilter;
		$sSql = $team->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$team->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $team;
		$team->id->setDbValue($rs->fields('id'));
		$team->teamname->setDbValue($rs->fields('teamname'));
		$team->teampic->Upload->DbValue = $rs->fields('teampic');
		$team->teamjobs->setDbValue($rs->fields('teamjobs'));
		$team->teamdesc->setDbValue($rs->fields('teamdesc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $team;

		// Call Row_Rendering event
		$team->Row_Rendering();

		// Common render codes for all row types
		// id

		$team->id->CellCssStyle = "";
		$team->id->CellCssClass = "";

		// teamname
		$team->teamname->CellCssStyle = "";
		$team->teamname->CellCssClass = "";

		// teampic
		$team->teampic->CellCssStyle = "";
		$team->teampic->CellCssClass = "";

		// teamjobs
		$team->teamjobs->CellCssStyle = "";
		$team->teamjobs->CellCssClass = "";

		// teamdesc
		$team->teamdesc->CellCssStyle = "";
		$team->teamdesc->CellCssClass = "";
		if ($team->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$team->id->ViewValue = $team->id->CurrentValue;
			$team->id->CssStyle = "";
			$team->id->CssClass = "";
			$team->id->ViewCustomAttributes = "";

			// teamname
			$team->teamname->ViewValue = $team->teamname->CurrentValue;
			$team->teamname->CssStyle = "";
			$team->teamname->CssClass = "";
			$team->teamname->ViewCustomAttributes = "";

			// teampic
			if (!is_null($team->teampic->Upload->DbValue)) {
				$team->teampic->ViewValue = $team->teampic->Upload->DbValue;
				$team->teampic->ImageAlt = "";
			} else {
				$team->teampic->ViewValue = "";
			}
			$team->teampic->CssStyle = "";
			$team->teampic->CssClass = "";
			$team->teampic->ViewCustomAttributes = "";

			// teamjobs
			$team->teamjobs->ViewValue = $team->teamjobs->CurrentValue;
			$team->teamjobs->CssStyle = "";
			$team->teamjobs->CssClass = "";
			$team->teamjobs->ViewCustomAttributes = "";

			// teamdesc
			$team->teamdesc->ViewValue = $team->teamdesc->CurrentValue;
			$team->teamdesc->CssStyle = "";
			$team->teamdesc->CssClass = "";
			$team->teamdesc->ViewCustomAttributes = "";

			// id
			$team->id->HrefValue = "";

			// teamname
			$team->teamname->HrefValue = "";

			// teampic
			$team->teampic->HrefValue = "";

			// teamjobs
			$team->teamjobs->HrefValue = "";

			// teamdesc
			$team->teamdesc->HrefValue = "";
		}

		// Call Row Rendered event
		$team->Row_Rendered();
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
