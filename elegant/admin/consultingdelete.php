<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "consultinginfo.php" ?>
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
$consulting_delete = new cconsulting_delete();
$Page =& $consulting_delete;

// Page init processing
$consulting_delete->Page_Init();

// Page main processing
$consulting_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var consulting_delete = new ew_Page("consulting_delete");

// page properties
consulting_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = consulting_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
consulting_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
consulting_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
consulting_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consulting_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $consulting_delete->LoadRecordset();
$consulting_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($consulting_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$consulting_delete->Page_Terminate("consultinglist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Consulting<br><br>
<a href="<?php echo $consulting->getReturnUrl() ?>">返回</a></span></p>
<?php $consulting_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="consulting">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($consulting_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $consulting->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">咨询ID</td>
		<td valign="top">称呼</td>
		<td valign="top">公司</td>
		<td valign="top">电话</td>
	</tr>
	</thead>
	<tbody>
<?php
$consulting_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$consulting_delete->lRecCnt++;

	// Set row properties
	$consulting->CssClass = "";
	$consulting->CssStyle = "";
	$consulting->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$consulting_delete->LoadRowValues($rs);

	// Render row
	$consulting_delete->RenderRow();
?>
	<tr<?php echo $consulting->RowAttributes() ?>>
		<td<?php echo $consulting->id->CellAttributes() ?>>
<div<?php echo $consulting->id->ViewAttributes() ?>><?php echo $consulting->id->ListViewValue() ?></div></td>
		<td<?php echo $consulting->title->CellAttributes() ?>>
<div<?php echo $consulting->title->ViewAttributes() ?>><?php echo $consulting->title->ListViewValue() ?></div></td>
		<td<?php echo $consulting->company->CellAttributes() ?>>
<div<?php echo $consulting->company->ViewAttributes() ?>><?php echo $consulting->company->ListViewValue() ?></div></td>
		<td<?php echo $consulting->phone->CellAttributes() ?>>
<div<?php echo $consulting->phone->ViewAttributes() ?>><?php echo $consulting->phone->ListViewValue() ?></div></td>
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
class cconsulting_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'consulting';

	// Page Object Name
	var $PageObjName = 'consulting_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consulting;
		if ($consulting->UseTokenInUrl) $PageUrl .= "t=" . $consulting->TableVar . "&"; // add page token
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
		global $objForm, $consulting;
		if ($consulting->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($consulting->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consulting->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cconsulting_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["consulting"] = new cconsulting();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consulting', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $consulting;
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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $consulting;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$consulting->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($consulting->id->QueryStringValue))
				$this->Page_Terminate("consultinglist.php"); // Prevent SQL injection, exit
			$sKey .= $consulting->id->QueryStringValue;
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
			$this->Page_Terminate("consultinglist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("consultinglist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in consulting class, consultinginfo.php

		$consulting->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$consulting->CurrentAction = $_POST["a_delete"];
		} else {
			$consulting->CurrentAction = "D"; // Delete record directly
		}
		switch ($consulting->CurrentAction) {
			case "D": // Delete
				$consulting->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($consulting->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $consulting;
		$DeleteRows = TRUE;
		$sWrkFilter = $consulting->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in consulting class, consultinginfo.php

		$consulting->CurrentFilter = $sWrkFilter;
		$sSql = $consulting->SQL();
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
				$DeleteRows = $consulting->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($consulting->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($consulting->CancelMessage <> "") {
				$this->setMessage($consulting->CancelMessage);
				$consulting->CancelMessage = "";
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
				$consulting->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $consulting;

		// Call Recordset Selecting event
		$consulting->Recordset_Selecting($consulting->CurrentFilter);

		// Load list page SQL
		$sSql = $consulting->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$consulting->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $consulting;
		$sFilter = $consulting->KeyFilter();

		// Call Row Selecting event
		$consulting->Row_Selecting($sFilter);

		// Load sql based on filter
		$consulting->CurrentFilter = $sFilter;
		$sSql = $consulting->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$consulting->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $consulting;
		$consulting->id->setDbValue($rs->fields('id'));
		$consulting->title->setDbValue($rs->fields('title'));
		$consulting->company->setDbValue($rs->fields('company'));
		$consulting->phone->setDbValue($rs->fields('phone'));
		$consulting->content->setDbValue($rs->fields('content'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $consulting;

		// Call Row_Rendering event
		$consulting->Row_Rendering();

		// Common render codes for all row types
		// id

		$consulting->id->CellCssStyle = "";
		$consulting->id->CellCssClass = "";

		// title
		$consulting->title->CellCssStyle = "";
		$consulting->title->CellCssClass = "";

		// company
		$consulting->company->CellCssStyle = "";
		$consulting->company->CellCssClass = "";

		// phone
		$consulting->phone->CellCssStyle = "";
		$consulting->phone->CellCssClass = "";
		if ($consulting->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consulting->id->ViewValue = $consulting->id->CurrentValue;
			$consulting->id->CssStyle = "";
			$consulting->id->CssClass = "";
			$consulting->id->ViewCustomAttributes = "";

			// title
			$consulting->title->ViewValue = $consulting->title->CurrentValue;
			$consulting->title->CssStyle = "";
			$consulting->title->CssClass = "";
			$consulting->title->ViewCustomAttributes = "";

			// company
			$consulting->company->ViewValue = $consulting->company->CurrentValue;
			$consulting->company->CssStyle = "";
			$consulting->company->CssClass = "";
			$consulting->company->ViewCustomAttributes = "";

			// phone
			$consulting->phone->ViewValue = $consulting->phone->CurrentValue;
			$consulting->phone->CssStyle = "";
			$consulting->phone->CssClass = "";
			$consulting->phone->ViewCustomAttributes = "";

			// id
			$consulting->id->HrefValue = "";

			// title
			$consulting->title->HrefValue = "";

			// company
			$consulting->company->HrefValue = "";

			// phone
			$consulting->phone->HrefValue = "";
		}

		// Call Row Rendered event
		$consulting->Row_Rendered();
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
