<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newscatinfo.php" ?>
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
$newscat_delete = new cnewscat_delete();
$Page =& $newscat_delete;

// Page init processing
$newscat_delete->Page_Init();

// Page main processing
$newscat_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var newscat_delete = new ew_Page("newscat_delete");

// page properties
newscat_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = newscat_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
newscat_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
newscat_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
newscat_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $newscat_delete->LoadRecordset();
$newscat_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($newscat_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$newscat_delete->Page_Terminate("newscatlist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Newscat<br><br>
<a href="<?php echo $newscat->getReturnUrl() ?>">返回</a></span></p>
<?php $newscat_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="newscat">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($newscat_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $newscat->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">类型ID</td>
		<td valign="top">类型名称</td>
		<td valign="top">类型排序</td>
	</tr>
	</thead>
	<tbody>
<?php
$newscat_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$newscat_delete->lRecCnt++;

	// Set row properties
	$newscat->CssClass = "";
	$newscat->CssStyle = "";
	$newscat->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$newscat_delete->LoadRowValues($rs);

	// Render row
	$newscat_delete->RenderRow();
?>
	<tr<?php echo $newscat->RowAttributes() ?>>
		<td<?php echo $newscat->id->CellAttributes() ?>>
<div<?php echo $newscat->id->ViewAttributes() ?>><?php echo $newscat->id->ListViewValue() ?></div></td>
		<td<?php echo $newscat->catname->CellAttributes() ?>>
<div<?php echo $newscat->catname->ViewAttributes() ?>><?php echo $newscat->catname->ListViewValue() ?></div></td>
		<td<?php echo $newscat->catorder->CellAttributes() ?>>
<div<?php echo $newscat->catorder->ViewAttributes() ?>><?php echo $newscat->catorder->ListViewValue() ?></div></td>
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
class cnewscat_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'newscat';

	// Page Object Name
	var $PageObjName = 'newscat_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $newscat;
		if ($newscat->UseTokenInUrl) $PageUrl .= "t=" . $newscat->TableVar . "&"; // add page token
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
		global $objForm, $newscat;
		if ($newscat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($newscat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($newscat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnewscat_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["newscat"] = new cnewscat();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'newscat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $newscat;

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
		global $newscat;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$newscat->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($newscat->id->QueryStringValue))
				$this->Page_Terminate("newscatlist.php"); // Prevent SQL injection, exit
			$sKey .= $newscat->id->QueryStringValue;
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
			$this->Page_Terminate("newscatlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("newscatlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in newscat class, newscatinfo.php

		$newscat->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$newscat->CurrentAction = $_POST["a_delete"];
		} else {
			$newscat->CurrentAction = "I"; // Display record
		}
		switch ($newscat->CurrentAction) {
			case "D": // Delete
				$newscat->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($newscat->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $newscat;
		$DeleteRows = TRUE;
		$sWrkFilter = $newscat->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in newscat class, newscatinfo.php

		$newscat->CurrentFilter = $sWrkFilter;
		$sSql = $newscat->SQL();
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
				$DeleteRows = $newscat->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($newscat->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($newscat->CancelMessage <> "") {
				$this->setMessage($newscat->CancelMessage);
				$newscat->CancelMessage = "";
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
				$newscat->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $newscat;

		// Call Recordset Selecting event
		$newscat->Recordset_Selecting($newscat->CurrentFilter);

		// Load list page SQL
		$sSql = $newscat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$newscat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $newscat;
		$sFilter = $newscat->KeyFilter();

		// Call Row Selecting event
		$newscat->Row_Selecting($sFilter);

		// Load sql based on filter
		$newscat->CurrentFilter = $sFilter;
		$sSql = $newscat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$newscat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $newscat;
		$newscat->id->setDbValue($rs->fields('id'));
		$newscat->catname->setDbValue($rs->fields('catname'));
		$newscat->catorder->setDbValue($rs->fields('catorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $newscat;

		// Call Row_Rendering event
		$newscat->Row_Rendering();

		// Common render codes for all row types
		// id

		$newscat->id->CellCssStyle = "";
		$newscat->id->CellCssClass = "";

		// catname
		$newscat->catname->CellCssStyle = "";
		$newscat->catname->CellCssClass = "";

		// catorder
		$newscat->catorder->CellCssStyle = "";
		$newscat->catorder->CellCssClass = "";
		if ($newscat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$newscat->id->ViewValue = $newscat->id->CurrentValue;
			$newscat->id->CssStyle = "";
			$newscat->id->CssClass = "";
			$newscat->id->ViewCustomAttributes = "";

			// catname
			$newscat->catname->ViewValue = $newscat->catname->CurrentValue;
			$newscat->catname->CssStyle = "";
			$newscat->catname->CssClass = "";
			$newscat->catname->ViewCustomAttributes = "";

			// catorder
			$newscat->catorder->ViewValue = $newscat->catorder->CurrentValue;
			$newscat->catorder->CssStyle = "";
			$newscat->catorder->CssClass = "";
			$newscat->catorder->ViewCustomAttributes = "";

			// id
			$newscat->id->HrefValue = "";

			// catname
			$newscat->catname->HrefValue = "";

			// catorder
			$newscat->catorder->HrefValue = "";
		}

		// Call Row Rendered event
		$newscat->Row_Rendered();
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
