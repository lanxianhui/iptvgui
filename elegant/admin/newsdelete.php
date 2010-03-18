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
$news_delete = new cnews_delete();
$Page =& $news_delete;

// Page init processing
$news_delete->Page_Init();

// Page main processing
$news_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var news_delete = new ew_Page("news_delete");

// page properties
news_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = news_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
news_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
news_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
news_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
$rs = $news_delete->LoadRecordset();
$news_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($news_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$news_delete->Page_Terminate("newslist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: News<br><br>
<a href="<?php echo $news->getReturnUrl() ?>">返回</a></span></p>
<?php $news_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="news">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($news_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $news->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">新闻ID</td>
		<td valign="top">新闻标题</td>
		<td valign="top">新闻类型</td>
		<td valign="top">发布时间</td>
	</tr>
	</thead>
	<tbody>
<?php
$news_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$news_delete->lRecCnt++;

	// Set row properties
	$news->CssClass = "";
	$news->CssStyle = "";
	$news->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$news_delete->LoadRowValues($rs);

	// Render row
	$news_delete->RenderRow();
?>
	<tr<?php echo $news->RowAttributes() ?>>
		<td<?php echo $news->id->CellAttributes() ?>>
<div<?php echo $news->id->ViewAttributes() ?>><?php echo $news->id->ListViewValue() ?></div></td>
		<td<?php echo $news->newstitle->CellAttributes() ?>>
<div<?php echo $news->newstitle->ViewAttributes() ?>><?php echo $news->newstitle->ListViewValue() ?></div></td>
		<td<?php echo $news->catid->CellAttributes() ?>>
<div<?php echo $news->catid->ViewAttributes() ?>><?php echo $news->catid->ListViewValue() ?></div></td>
		<td<?php echo $news->pubtime->CellAttributes() ?>>
<div<?php echo $news->pubtime->ViewAttributes() ?>><?php echo $news->pubtime->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="   确认删除   ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cnews_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'news';

	// Page Object Name
	var $PageObjName = 'news_delete';

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
	function cnews_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["news"] = new cnews();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $news;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$news->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($news->id->QueryStringValue))
				$this->Page_Terminate("newslist.php"); // Prevent SQL injection, exit
			$sKey .= $news->id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("newslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("newslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in news class, newsinfo.php

		$news->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$news->CurrentAction = $_POST["a_delete"];
		} else {
			$news->CurrentAction = "I"; // Display record
		}
		switch ($news->CurrentAction) {
			case "D": // Delete
				$news->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($news->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $news;
		$DeleteRows = TRUE;
		$sWrkFilter = $news->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in news class, newsinfo.php

		$news->CurrentFilter = $sWrkFilter;
		$sSql = $news->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("没有数据"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $news->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($news->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($news->CancelMessage <> "") {
				$this->setMessage($news->CancelMessage);
				$news->CancelMessage = "";
			} else {
				$this->setMessage("已取消");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$news->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $news;

		// Call Recordset Selecting event
		$news->Recordset_Selecting($news->CurrentFilter);

		// Load list page SQL
		$sSql = $news->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$news->Recordset_Selected($rs);
		return $rs;
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

		// pubtime
		$news->pubtime->CellCssStyle = "";
		$news->pubtime->CellCssClass = "";
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

			// pubtime
			$news->pubtime->ViewValue = $news->pubtime->CurrentValue;
			$news->pubtime->ViewValue = ew_FormatDateTime($news->pubtime->ViewValue, 5);
			$news->pubtime->CssStyle = "";
			$news->pubtime->CssClass = "";
			$news->pubtime->ViewCustomAttributes = "";

			// id
			$news->id->HrefValue = "";

			// newstitle
			$news->newstitle->HrefValue = "";

			// catid
			$news->catid->HrefValue = "";

			// pubtime
			$news->pubtime->HrefValue = "";
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
