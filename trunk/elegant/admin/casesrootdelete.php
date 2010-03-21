<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "casesrootinfo.php" ?>
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
$casesroot_delete = new ccasesroot_delete();
$Page =& $casesroot_delete;

// Page init processing
$casesroot_delete->Page_Init();

// Page main processing
$casesroot_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var casesroot_delete = new ew_Page("casesroot_delete");

// page properties
casesroot_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = casesroot_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
casesroot_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
casesroot_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
casesroot_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
casesroot_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $casesroot_delete->LoadRecordset();
$casesroot_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($casesroot_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$casesroot_delete->Page_Terminate("casesrootlist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Casesroot<br><br>
<a href="<?php echo $casesroot->getReturnUrl() ?>">返回</a></span></p>
<?php $casesroot_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="casesroot">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($casesroot_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $casesroot->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">案例根类ID</td>
		<td valign="top">根类型名</td>
		<td valign="top">根类排序</td>
	</tr>
	</thead>
	<tbody>
<?php
$casesroot_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$casesroot_delete->lRecCnt++;

	// Set row properties
	$casesroot->CssClass = "";
	$casesroot->CssStyle = "";
	$casesroot->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$casesroot_delete->LoadRowValues($rs);

	// Render row
	$casesroot_delete->RenderRow();
?>
	<tr<?php echo $casesroot->RowAttributes() ?>>
		<td<?php echo $casesroot->id->CellAttributes() ?>>
<div<?php echo $casesroot->id->ViewAttributes() ?>><?php echo $casesroot->id->ListViewValue() ?></div></td>
		<td<?php echo $casesroot->rootname->CellAttributes() ?>>
<div<?php echo $casesroot->rootname->ViewAttributes() ?>><?php echo $casesroot->rootname->ListViewValue() ?></div></td>
		<td<?php echo $casesroot->rootorder->CellAttributes() ?>>
<div<?php echo $casesroot->rootorder->ViewAttributes() ?>><?php echo $casesroot->rootorder->ListViewValue() ?></div></td>
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
class ccasesroot_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'casesroot';

	// Page Object Name
	var $PageObjName = 'casesroot_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $casesroot;
		if ($casesroot->UseTokenInUrl) $PageUrl .= "t=" . $casesroot->TableVar . "&"; // add page token
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
		global $objForm, $casesroot;
		if ($casesroot->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($casesroot->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($casesroot->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccasesroot_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["casesroot"] = new ccasesroot();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'casesroot', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $casesroot;
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
		global $casesroot;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$casesroot->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($casesroot->id->QueryStringValue))
				$this->Page_Terminate("casesrootlist.php"); // Prevent SQL injection, exit
			$sKey .= $casesroot->id->QueryStringValue;
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
			$this->Page_Terminate("casesrootlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("casesrootlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in casesroot class, casesrootinfo.php

		$casesroot->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$casesroot->CurrentAction = $_POST["a_delete"];
		} else {
			$casesroot->CurrentAction = "D"; // Delete record directly
		}
		switch ($casesroot->CurrentAction) {
			case "D": // Delete
				$casesroot->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($casesroot->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $casesroot;
		$DeleteRows = TRUE;
		$sWrkFilter = $casesroot->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in casesroot class, casesrootinfo.php

		$casesroot->CurrentFilter = $sWrkFilter;
		$sSql = $casesroot->SQL();
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
				$DeleteRows = $casesroot->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($casesroot->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($casesroot->CancelMessage <> "") {
				$this->setMessage($casesroot->CancelMessage);
				$casesroot->CancelMessage = "";
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
				$casesroot->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $casesroot;

		// Call Recordset Selecting event
		$casesroot->Recordset_Selecting($casesroot->CurrentFilter);

		// Load list page SQL
		$sSql = $casesroot->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$casesroot->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $casesroot;
		$sFilter = $casesroot->KeyFilter();

		// Call Row Selecting event
		$casesroot->Row_Selecting($sFilter);

		// Load sql based on filter
		$casesroot->CurrentFilter = $sFilter;
		$sSql = $casesroot->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$casesroot->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $casesroot;
		$casesroot->id->setDbValue($rs->fields('id'));
		$casesroot->rootname->setDbValue($rs->fields('rootname'));
		$casesroot->rootorder->setDbValue($rs->fields('rootorder'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $casesroot;

		// Call Row_Rendering event
		$casesroot->Row_Rendering();

		// Common render codes for all row types
		// id

		$casesroot->id->CellCssStyle = "";
		$casesroot->id->CellCssClass = "";

		// rootname
		$casesroot->rootname->CellCssStyle = "";
		$casesroot->rootname->CellCssClass = "";

		// rootorder
		$casesroot->rootorder->CellCssStyle = "";
		$casesroot->rootorder->CellCssClass = "";
		if ($casesroot->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$casesroot->id->ViewValue = $casesroot->id->CurrentValue;
			$casesroot->id->CssStyle = "";
			$casesroot->id->CssClass = "";
			$casesroot->id->ViewCustomAttributes = "";

			// rootname
			$casesroot->rootname->ViewValue = $casesroot->rootname->CurrentValue;
			$casesroot->rootname->CssStyle = "";
			$casesroot->rootname->CssClass = "";
			$casesroot->rootname->ViewCustomAttributes = "";

			// rootorder
			$casesroot->rootorder->ViewValue = $casesroot->rootorder->CurrentValue;
			$casesroot->rootorder->CssStyle = "";
			$casesroot->rootorder->CssClass = "";
			$casesroot->rootorder->ViewCustomAttributes = "";

			// id
			$casesroot->id->HrefValue = "";

			// rootname
			$casesroot->rootname->HrefValue = "";

			// rootorder
			$casesroot->rootorder->HrefValue = "";
		}

		// Call Row Rendered event
		$casesroot->Row_Rendered();
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
