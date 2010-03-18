<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newsinfo.php" ?>
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
$news_view = new cnews_view();
$Page =& $news_view;

// Page init processing
$news_view->Page_Init();

// Page main processing
$news_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($news->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var news_view = new ew_Page("news_view");

// page properties
news_view.PageID = "view"; // page ID
var EW_PAGE_ID = news_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
news_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
news_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
news_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">查看 表: News
<br><br>
<?php if ($news->Export == "") { ?>
<a href="newslist.php">回到列表</a>&nbsp;
<a href="<?php echo $news->AddUrl() ?>">添加</a>&nbsp;
<a href="<?php echo $news->EditUrl() ?>">编辑</a>&nbsp;
<a href="<?php echo $news->CopyUrl() ?>">复制</a>&nbsp;
<a href="<?php echo $news->DeleteUrl() ?>">删除</a>&nbsp;
<?php } ?>
</span></p>
<?php $news_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($news->id->Visible) { // id ?>
	<tr<?php echo $news->id->RowAttributes ?>>
		<td class="ewTableHeader">新闻ID</td>
		<td<?php echo $news->id->CellAttributes() ?>>
<div<?php echo $news->id->ViewAttributes() ?>><?php echo $news->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->newstitle->Visible) { // newstitle ?>
	<tr<?php echo $news->newstitle->RowAttributes ?>>
		<td class="ewTableHeader">新闻标题</td>
		<td<?php echo $news->newstitle->CellAttributes() ?>>
<div<?php echo $news->newstitle->ViewAttributes() ?>><?php echo $news->newstitle->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->catid->Visible) { // catid ?>
	<tr<?php echo $news->catid->RowAttributes ?>>
		<td class="ewTableHeader">新闻类型</td>
		<td<?php echo $news->catid->CellAttributes() ?>>
<div<?php echo $news->catid->ViewAttributes() ?>><?php echo $news->catid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->newsdesc->Visible) { // newsdesc ?>
	<tr<?php echo $news->newsdesc->RowAttributes ?>>
		<td class="ewTableHeader">新闻内容</td>
		<td<?php echo $news->newsdesc->CellAttributes() ?>>
<div<?php echo $news->newsdesc->ViewAttributes() ?>><?php echo $news->newsdesc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->pubtime->Visible) { // pubtime ?>
	<tr<?php echo $news->pubtime->RowAttributes ?>>
		<td class="ewTableHeader">发布时间</td>
		<td<?php echo $news->pubtime->CellAttributes() ?>>
<div<?php echo $news->pubtime->ViewAttributes() ?>><?php echo $news->pubtime->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->newsimg->Visible) { // newsimg ?>
	<tr<?php echo $news->newsimg->RowAttributes ?>>
		<td class="ewTableHeader">新闻图片</td>
		<td<?php echo $news->newsimg->CellAttributes() ?>>
<?php if ($news->newsimg->HrefValue <> "") { ?>
<?php if (!is_null($news->newsimg->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $news->newsimg->Upload->DbValue ?>" border=0<?php echo $news->newsimg->ViewAttributes() ?>>
<?php } elseif (!in_array($news->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($news->newsimg->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, EW_UPLOAD_DEST_PATH) . $news->newsimg->Upload->DbValue ?>" border=0<?php echo $news->newsimg->ViewAttributes() ?>>
<?php } elseif (!in_array($news->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($news->Export == "") { ?>
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
class cnews_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'news';

	// Page Object Name
	var $PageObjName = 'news_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $news;
		if ($news->UseTokenInUrl) $PageUrl .= "t=" . $news->TableVar . "&"; // add page token
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
		global $objForm, $news;
		if ($news->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($news->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($news->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnews_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["news"] = new cnews();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'news', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $news;

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
		global $news;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$news->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "newslist.php"; // Return to list
			}

			// Get action
			$news->CurrentAction = "I"; // Display form
			switch ($news->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("没有数据"); // Set no record message
						$sReturnUrl = "newslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "newslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$news->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $news;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$news->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$news->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $news->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$news->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $news;
		$sFilter = $news->KeyFilter();

		// Call Row Selecting event
		$news->Row_Selecting($sFilter);

		// Load sql based on filter
		$news->CurrentFilter = $sFilter;
		$sSql = $news->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$news->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $news;
		$news->id->setDbValue($rs->fields('id'));
		$news->newstitle->setDbValue($rs->fields('newstitle'));
		$news->catid->setDbValue($rs->fields('catid'));
		$news->newsdesc->setDbValue($rs->fields('newsdesc'));
		$news->pubtime->setDbValue($rs->fields('pubtime'));
		$news->newsimg->Upload->DbValue = $rs->fields('newsimg');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $news;

		// Call Row_Rendering event
		$news->Row_Rendering();

		// Common render codes for all row types
		// id

		$news->id->CellCssStyle = "";
		$news->id->CellCssClass = "";

		// newstitle
		$news->newstitle->CellCssStyle = "";
		$news->newstitle->CellCssClass = "";

		// catid
		$news->catid->CellCssStyle = "";
		$news->catid->CellCssClass = "";

		// newsdesc
		$news->newsdesc->CellCssStyle = "";
		$news->newsdesc->CellCssClass = "";

		// pubtime
		$news->pubtime->CellCssStyle = "";
		$news->pubtime->CellCssClass = "";

		// newsimg
		$news->newsimg->CellCssStyle = "";
		$news->newsimg->CellCssClass = "";
		if ($news->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$news->id->ViewValue = $news->id->CurrentValue;
			$news->id->CssStyle = "";
			$news->id->CssClass = "";
			$news->id->ViewCustomAttributes = "";

			// newstitle
			$news->newstitle->ViewValue = $news->newstitle->CurrentValue;
			$news->newstitle->CssStyle = "";
			$news->newstitle->CssClass = "";
			$news->newstitle->ViewCustomAttributes = "";

			// catid
			if (strval($news->catid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `catname` FROM `newscat` WHERE `id` = " . ew_AdjustSql($news->catid->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$news->catid->ViewValue = $rswrk->fields('catname');
					$rswrk->Close();
				} else {
					$news->catid->ViewValue = $news->catid->CurrentValue;
				}
			} else {
				$news->catid->ViewValue = NULL;
			}
			$news->catid->CssStyle = "";
			$news->catid->CssClass = "";
			$news->catid->ViewCustomAttributes = "";

			// newsdesc
			$news->newsdesc->ViewValue = $news->newsdesc->CurrentValue;
			$news->newsdesc->CssStyle = "";
			$news->newsdesc->CssClass = "";
			$news->newsdesc->ViewCustomAttributes = "";

			// pubtime
			$news->pubtime->ViewValue = $news->pubtime->CurrentValue;
			$news->pubtime->ViewValue = ew_FormatDateTime($news->pubtime->ViewValue, 5);
			$news->pubtime->CssStyle = "";
			$news->pubtime->CssClass = "";
			$news->pubtime->ViewCustomAttributes = "";

			// newsimg
			if (!is_null($news->newsimg->Upload->DbValue)) {
				$news->newsimg->ViewValue = $news->newsimg->Upload->DbValue;
				$news->newsimg->ImageAlt = "";
			} else {
				$news->newsimg->ViewValue = "";
			}
			$news->newsimg->CssStyle = "";
			$news->newsimg->CssClass = "";
			$news->newsimg->ViewCustomAttributes = "";

			// id
			$news->id->HrefValue = "";

			// newstitle
			$news->newstitle->HrefValue = "";

			// catid
			$news->catid->HrefValue = "";

			// newsdesc
			$news->newsdesc->HrefValue = "";

			// pubtime
			$news->pubtime->HrefValue = "";

			// newsimg
			$news->newsimg->HrefValue = "";
		}

		// Call Row Rendered event
		$news->Row_Rendered();
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
