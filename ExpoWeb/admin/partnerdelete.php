<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "partnerinfo.php" ?>
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
$partner_delete = new cpartner_delete();
$Page =& $partner_delete;

// Page init processing
$partner_delete->Page_Init();

// Page main processing
$partner_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var partner_delete = new ew_Page("partner_delete");

// page properties
partner_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = partner_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
partner_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
partner_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
partner_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
partner_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $partner_delete->LoadRecordset();
$partner_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($partner_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$partner_delete->Page_Terminate("partnerlist.php"); // Return to list
}
?>
<p><span class="phpmaker">删除 表: Partner<br><br>
<a href="<?php echo $partner->getReturnUrl() ?>">返回</a></span></p>
<?php $partner_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="partner">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($partner_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $partner->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">合作伙伴ID</td>
		<td valign="top">合作伙伴名</td>
	</tr>
	</thead>
	<tbody>
<?php
$partner_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$partner_delete->lRecCnt++;

	// Set row properties
	$partner->CssClass = "";
	$partner->CssStyle = "";
	$partner->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$partner_delete->LoadRowValues($rs);

	// Render row
	$partner_delete->RenderRow();
?>
	<tr<?php echo $partner->RowAttributes() ?>>
		<td<?php echo $partner->id->CellAttributes() ?>>
<div<?php echo $partner->id->ViewAttributes() ?>><?php echo $partner->id->ListViewValue() ?></div></td>
		<td<?php echo $partner->pname->CellAttributes() ?>>
<div<?php echo $partner->pname->ViewAttributes() ?>><?php echo $partner->pname->ListViewValue() ?></div></td>
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
class cpartner_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'partner';

	// Page Object Name
	var $PageObjName = 'partner_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $partner;
		if ($partner->UseTokenInUrl) $PageUrl .= "t=" . $partner->TableVar . "&"; // add page token
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
		global $objForm, $partner;
		if ($partner->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($partner->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($partner->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cpartner_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["partner"] = new cpartner();

		// Initialize other table object
		$GLOBALS['admin'] = new cadmin();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'partner', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $partner;
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
		global $partner;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$partner->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($partner->id->QueryStringValue))
				$this->Page_Terminate("partnerlist.php"); // Prevent SQL injection, exit
			$sKey .= $partner->id->QueryStringValue;
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
			$this->Page_Terminate("partnerlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("partnerlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in partner class, partnerinfo.php

		$partner->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$partner->CurrentAction = $_POST["a_delete"];
		} else {
			$partner->CurrentAction = "D"; // Delete record directly
		}
		switch ($partner->CurrentAction) {
			case "D": // Delete
				$partner->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("删除成功"); // Set up success message
					$this->Page_Terminate($partner->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $partner;
		$DeleteRows = TRUE;
		$sWrkFilter = $partner->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in partner class, partnerinfo.php

		$partner->CurrentFilter = $sWrkFilter;
		$sSql = $partner->SQL();
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
				$DeleteRows = $partner->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($partner->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($partner->CancelMessage <> "") {
				$this->setMessage($partner->CancelMessage);
				$partner->CancelMessage = "";
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
				$partner->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $partner;

		// Call Recordset Selecting event
		$partner->Recordset_Selecting($partner->CurrentFilter);

		// Load list page SQL
		$sSql = $partner->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$partner->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $partner;
		$sFilter = $partner->KeyFilter();

		// Call Row Selecting event
		$partner->Row_Selecting($sFilter);

		// Load sql based on filter
		$partner->CurrentFilter = $sFilter;
		$sSql = $partner->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$partner->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $partner;
		$partner->id->setDbValue($rs->fields('id'));
		$partner->pname->setDbValue($rs->fields('pname'));
		$partner->paddress->setDbValue($rs->fields('paddress'));
		$partner->pimage->Upload->DbValue = $rs->fields('pimage');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $partner;

		// Call Row_Rendering event
		$partner->Row_Rendering();

		// Common render codes for all row types
		// id

		$partner->id->CellCssStyle = "";
		$partner->id->CellCssClass = "";

		// pname
		$partner->pname->CellCssStyle = "";
		$partner->pname->CellCssClass = "";
		if ($partner->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$partner->id->ViewValue = $partner->id->CurrentValue;
			$partner->id->CssStyle = "";
			$partner->id->CssClass = "";
			$partner->id->ViewCustomAttributes = "";

			// pname
			$partner->pname->ViewValue = $partner->pname->CurrentValue;
			$partner->pname->CssStyle = "";
			$partner->pname->CssClass = "";
			$partner->pname->ViewCustomAttributes = "";

			// id
			$partner->id->HrefValue = "";

			// pname
			$partner->pname->HrefValue = "";
		}

		// Call Row Rendered event
		$partner->Row_Rendered();
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
